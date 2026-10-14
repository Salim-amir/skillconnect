<?php

namespace App\Services;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Service Exact Skill Matching (Pencocokan Persesuaian Kategori dan Tag)
 * Sesuai Proposal PBL SkillConnect - Modul Backend (Salim Amir) [MVP 2]
 * 
 * Tanggung Jawab:
 * 1. Menjalankan query exact matching berbasis relational database MySQL
 * 2. Mengambil daftar kandidat pelamar proyek berdasarkan filter posisi
 * 3. Menghitung jumlah kecocokan skill_id dan persentase skor kecocokan
 * 4. Menyusun urutan kandidat:
 *    - Default (tanpa filter posisi): diurutkan berdasarkan waktu pendaftaran terbaru / new
 *    - Dengan filter posisi: diurutkan berdasarkan skor kecocokan tertinggi (Exact Match)
 */
class ExactSkillMatchingService
{
    /**
     * Bobot tingkat keahlian untuk tie-breaker penilaian
     */
    protected array $levelWeights = [
        'Beginner'     => 1,
        'Intermediate' => 2,
        'Advanced'     => 3,
    ];

    /**
     * Dapatkan daftar posisi unik yang dilamar oleh kandidat pada suatu proyek
     */
    public function getAvailablePositions(int $projectId): array
    {
        return DB::table('project_member')
            ->where('project_id', $projectId)
            ->where('peran', '!=', 'Project Creator / Leader')
            ->distinct()
            ->pluck('peran')
            ->toArray();
    }

    /**
     * Ambil dan hitung daftar kandidat pelamar untuk proyek dengan Exact Matching
     *
     * @param Project     $project
     * @param string|null $position
     * @return Collection
     */
    public function getCandidatesForProject(Project $project, ?string $position = null): Collection
    {
        $hasPositionFilter = !empty($position) && $position !== 'Semua';

        // 1. Query dasar pelamar proyek dari database relasional
        $query = DB::table('project_member')
            ->join('users', 'project_member.user_id', '=', 'users.id')
            ->where('project_member.project_id', $project->id)
            ->where('project_member.peran', '!=', 'Project Creator / Leader')
            ->select(
                'project_member.id as application_id',
                'project_member.peran',
                'project_member.nominal_fee',
                'project_member.status_keanggotaan',
                'project_member.created_at as applied_at',
                'users.id as user_id',
                'users.name as candidate_name',
                'users.email as candidate_email',
                'users.portofolio as candidate_portofolio',
                'users.pengalaman as candidate_pengalaman'
            );

        // Jika filter posisi aktif, saring pelamar sesuai posisi tersebut
        if ($hasPositionFilter) {
            $query->where('project_member.peran', $position);
        }

        // Ambil daftar pelamar
        $rawCandidates = $query->orderBy('project_member.created_at', 'desc')->get();

        if ($rawCandidates->isEmpty()) {
            return collect([]);
        }

        // 2. Ambil master kebutuhan skill proyek (Exact Match Tag/ID)
        $projectSkills = $project->skills()->get(['skills.id', 'skills.nama_skill']);
        $projectSkillIds = $projectSkills->pluck('id')->toArray();
        $projectSkillNames = $projectSkills->pluck('nama_skill', 'id')->toArray();
        $totalProjectSkills = count($projectSkillIds);

        $candidateUserIds = $rawCandidates->pluck('user_id')->unique()->toArray();

        // 3. Query skill seluruh kandidat dalam satu query relasional (Eager Query)
        $userSkillsGrouped = DB::table('user_skill')
            ->join('skills', 'user_skill.skill_id', '=', 'skills.id')
            ->whereIn('user_skill.user_id', $candidateUserIds)
            ->select(
                'user_skill.user_id',
                'user_skill.skill_id',
                'user_skill.tingkat_keahlian',
                'skills.nama_skill'
            )
            ->get()
            ->groupBy('user_id');

        // 4. Kalkulasi Exact Match untuk setiap kandidat
        $evaluatedCandidates = $rawCandidates->map(function ($candidate) use (
            $projectSkillIds,
            $projectSkillNames,
            $totalProjectSkills,
            $userSkillsGrouped
        ) {
            $userSkills = $userSkillsGrouped->get($candidate->user_id, collect([]));

            $matchingCount = 0;
            $skillWeightTotal = 0;
            $matchedSkillNames = [];
            $matchedSkillIds = [];

            foreach ($userSkills as $skill) {
                // Exact Match: kesamaan skill_id antara user_skill dan project_skill
                if (in_array($skill->skill_id, $projectSkillIds)) {
                    $matchingCount++;
                    $matchedSkillIds[] = $skill->skill_id;
                    $matchedSkillNames[] = [
                        'id'               => $skill->skill_id,
                        'nama_skill'       => $skill->nama_skill,
                        'tingkat_keahlian' => $skill->tingkat_keahlian,
                        'formatted'        => "{$skill->nama_skill} ({$skill->tingkat_keahlian})",
                    ];

                    $weight = $this->levelWeights[$skill->tingkat_keahlian] ?? 1;
                    $skillWeightTotal += $weight;
                }
            }

            // Rumus Skor Kecocokan: (Jumlah Skill yang Cocok / Jumlah Skill yang Dibutuhkan) * 100%
            $matchScore = $totalProjectSkills > 0
                ? round(($matchingCount / $totalProjectSkills) * 100)
                : 100;

            // Cari skill proyek yang belum dimiliki kandidat (Missing Skills)
            $missingSkills = [];
            foreach ($projectSkillNames as $pId => $pName) {
                if (!in_array($pId, $matchedSkillIds)) {
                    $missingSkills[] = $pName;
                }
            }

            // Lampirkan hasil komputasi Exact Match ke objek kandidat
            $candidate->total_project_skills = $totalProjectSkills;
            $candidate->matching_count       = $matchingCount;
            $candidate->match_score          = $matchScore;
            $candidate->match_summary        = "Cocok {$matchingCount} dari {$totalProjectSkills} Skill";
            $candidate->skill_weight_total   = $skillWeightTotal;
            $candidate->matching_skills      = array_column($matchedSkillNames, 'formatted');
            $candidate->matching_skills_data = $matchedSkillNames;
            $candidate->missing_skills       = $missingSkills;
            $candidate->all_skills           = $userSkills;

            return $candidate;
        });

        // 5. Aturan Pengurutan Sesuai Proposal & User Request:
        // - Sebelum filter posisi diklik (default/semua):
        //   Diurutkan berdasarkan pendaftar terbaru (*new* / pendaftar duluan).
        // - Ketika filter posisi diklik:
        //   Diurutkan berdasarkan skor kecocokan tertinggi (Exact Match: match_score DESC, matching_count DESC, weight DESC)
        if ($hasPositionFilter) {
            return $evaluatedCandidates->sort(function ($a, $b) {
                // 1. Persentase kecocokan tertinggi
                if ($a->match_score !== $b->match_score) {
                    return $b->match_score <=> $a->match_score;
                }
                // 2. Jumlah skill yang cocok terbanyak
                if ($a->matching_count !== $b->matching_count) {
                    return $b->matching_count <=> $a->matching_count;
                }
                // 3. Bobot keahlian tertinggi (Advanced > Intermediate > Beginner)
                if ($a->skill_weight_total !== $b->skill_weight_total) {
                    return $b->skill_weight_total <=> $a->skill_weight_total;
                }
                // 4. Waktu pendaftaran
                return strtotime($b->applied_at) <=> strtotime($a->applied_at);
            })->values();
        }

        // Default: urutkan pendaftar yang masuk lebih awal / terbaru (new)
        return $evaluatedCandidates->sortByDesc('applied_at')->values();
    }

    /**
     * Pencarian Pengguna yang Cocok (Talent Pool) berbasis Exact Match SQL Query
     * Berguna untuk mencari kandidat potensial di luar pelamar (undangan creator)
     *
     * @param Project $project
     * @param int     $minMatchCount
     * @return Collection
     */
    public function searchMatchingTalents(Project $project, int $minMatchCount = 1): Collection
    {
        $projectSkillIds = $project->skills()->pluck('skills.id')->toArray();
        $totalRequired = count($projectSkillIds);

        if (empty($projectSkillIds)) {
            return collect([]);
        }

        // Query relasional menghitung jumlah skill_id yang cocok
        $matchingUsers = DB::table('users')
            ->join('user_skill', 'users.id', '=', 'user_skill.user_id')
            ->whereIn('user_skill.skill_id', $projectSkillIds)
            ->where('users.id', '!=', $project->creator_id)
            ->groupBy(
                'users.id',
                'users.name',
                'users.email',
                'users.role',
                'users.portofolio',
                'users.pengalaman'
            )
            ->havingRaw('COUNT(DISTINCT user_skill.skill_id) >= ?', [$minMatchCount])
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.role',
                'users.portofolio',
                'users.pengalaman',
                DB::raw('COUNT(DISTINCT user_skill.skill_id) as matching_skills_count')
            )
            ->orderByDesc('matching_skills_count')
            ->get();

        return $matchingUsers->map(function ($talent) use ($totalRequired) {
            $talent->match_score = $totalRequired > 0 
                ? round(($talent->matching_skills_count / $totalRequired) * 100) 
                : 100;
            $talent->match_summary = "Cocok {$talent->matching_skills_count} dari {$totalRequired} Skill";
            return $talent;
        });
    }
}
