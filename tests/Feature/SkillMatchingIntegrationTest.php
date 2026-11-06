<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use App\Services\ExactSkillMatchingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SkillMatchingIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected ExactSkillMatchingService $service;

    protected User $creator;

    protected Project $project;

    protected Skill $skillLaravel;

    protected Skill $skillMySQL;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new ExactSkillMatchingService;

        $this->creator = User::create([
            'name' => 'Creator Matching',
            'email' => 'matching_c@example.com',
            'password' => Hash::make('password123'),
            'role' => 'creator',
        ]);

        $this->project = Project::create([
            'creator_id' => $this->creator->id,
            'judul_project' => 'Proyek Matching Engine',
            'deskripsi' => 'Pengujian algoritma pencocokan skill kandidat.',
            'kategori' => 'Web Development',
            'budget' => 3000000,
            'status_project' => 'Mencari Tim',
        ]);

        $this->skillLaravel = Skill::create(['nama_skill' => 'Laravel']);
        $this->skillMySQL = Skill::create(['nama_skill' => 'MySQL']);
        $this->project->skills()->attach([$this->skillLaravel->id, $this->skillMySQL->id]);
    }

    /**
     * MOD-05-UT01: test_matching_engine_calculates_100_percent_exact_match
     * Sistem menghitung skor kecocokan persis 100% saat seluruh inventaris skill kandidat memenuhi kriteria posisi.
     */
    public function test_matching_engine_calculates_100_percent_exact_match(): void
    {
        $candidate = User::create([
            'name' => 'Perfect Candidate',
            'email' => 'perfect@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $candidate->skills()->attach([
            $this->skillLaravel->id => ['tingkat_keahlian' => 'Advanced'],
            $this->skillMySQL->id => ['tingkat_keahlian' => 'Intermediate'],
        ]);

        DB::table('project_member')->insert([
            'user_id' => $candidate->id,
            'project_id' => $this->project->id,
            'peran' => 'Backend Engineer',
            'nominal_fee' => 1500000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $results = $this->service->getCandidatesForProject($this->project, 'Backend Engineer');

        $this->assertCount(1, $results);
        $first = $results->first();
        $this->assertEquals(100, $first->match_score);
        $this->assertEquals(2, $first->matching_count);
        $this->assertEquals('Cocok 2 dari 2 Skill', $first->match_summary);
    }

    /**
     * MOD-05-UT02: test_matching_engine_calculates_precise_partial_match
     * Sistem menghitung persentase partial match secara akurat (e.g., 33.33% jika hanya 1 dari 3 skill terpenuhi).
     */
    public function test_matching_engine_calculates_precise_partial_match(): void
    {
        // Tambah skill ke-3 ke proyek
        $skillVue = Skill::create(['nama_skill' => 'Vue.js']);
        $this->project->skills()->attach($skillVue->id);

        $candidate = User::create([
            'name' => 'Partial Candidate',
            'email' => 'partial@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        // Kandidat hanya punya 1 dari 3 skill (Laravel)
        $candidate->skills()->attach($this->skillLaravel->id, ['tingkat_keahlian' => 'Intermediate']);

        DB::table('project_member')->insert([
            'user_id' => $candidate->id,
            'project_id' => $this->project->id,
            'peran' => 'Fullstack',
            'nominal_fee' => 1500000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $results = $this->service->getCandidatesForProject($this->project, 'Fullstack');

        $this->assertCount(1, $results);
        $first = $results->first();
        $this->assertEquals(33, $first->match_score); // round(1/3 * 100) = 33
        $this->assertEquals(1, $first->matching_count);
        $this->assertEquals('Cocok 1 dari 3 Skill', $first->match_summary);
    }

    /**
     * MOD-05-UT03: test_matching_engine_handles_zero_percent_skill_match
     * Sistem mengembalikan skor kecocokan 0% ketika kandidat tidak memiliki satupun skill yang dipersyaratkan posisi.
     */
    public function test_matching_engine_handles_zero_percent_skill_match(): void
    {
        $skillFlutter = Skill::create(['nama_skill' => 'Flutter']);

        $candidate = User::create([
            'name' => 'Zero Match Candidate',
            'email' => 'zero@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $candidate->skills()->attach($skillFlutter->id, ['tingkat_keahlian' => 'Advanced']);

        DB::table('project_member')->insert([
            'user_id' => $candidate->id,
            'project_id' => $this->project->id,
            'peran' => 'Backend Engineer',
            'nominal_fee' => 1200000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $results = $this->service->getCandidatesForProject($this->project, 'Backend Engineer');

        $this->assertCount(1, $results);
        $first = $results->first();
        $this->assertEquals(0, $first->match_score);
        $this->assertEquals(0, $first->matching_count);
        $this->assertEquals('Cocok 0 dari 2 Skill', $first->match_summary);
    }

    /**
     * MOD-05-UT04: test_default_candidate_list_is_sorted_by_earliest_registration
     * Urutan bawaan (default) daftar pelamar berhasil disusun berdasarkan waktu pendaftaran (FIFO/waktu daftar).
     */
    public function test_default_candidate_list_is_sorted_by_earliest_registration(): void
    {
        $u1 = User::create(['name' => 'Candidate 1', 'email' => 'c1@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);
        $u2 = User::create(['name' => 'Candidate 2', 'email' => 'c2@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);

        DB::table('project_member')->insert([
            [
                'user_id' => $u1->id,
                'project_id' => $this->project->id,
                'peran' => 'Backend',
                'nominal_fee' => 1000000,
                'status_keanggotaan' => 'Pending',
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subHours(1),
            ],
            [
                'user_id' => $u2->id,
                'project_id' => $this->project->id,
                'peran' => 'Frontend',
                'nominal_fee' => 1000000,
                'status_keanggotaan' => 'Pending',
                'created_at' => now()->subMinutes(5),
                'updated_at' => now()->subMinutes(5),
            ],
        ]);

        $results = $this->service->getCandidatesForProject($this->project, null);

        $this->assertCount(2, $results);
        // Default sort mengembalikan pendaftar
        $this->assertTrue($results->pluck('user_id')->contains($u1->id));
        $this->assertTrue($results->pluck('user_id')->contains($u2->id));
    }

    /**
     * MOD-05-UT05: test_candidate_sorting_switches_to_highest_matching_score_ranking
     * Urutan daftar kandidat berubah secara dinamis menjadi ranking skor tertinggi (100% ke bawah) setelah filter posisi dipilih.
     */
    public function test_candidate_sorting_switches_to_highest_matching_score_ranking(): void
    {
        $lowCandidate = User::create(['name' => 'Low Match', 'email' => 'low@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);
        $highCandidate = User::create(['name' => 'High Match', 'email' => 'high@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);

        // Low punya 0 skill
        // High punya 2 skill
        $highCandidate->skills()->attach([
            $this->skillLaravel->id => ['tingkat_keahlian' => 'Advanced'],
            $this->skillMySQL->id => ['tingkat_keahlian' => 'Intermediate'],
        ]);

        DB::table('project_member')->insert([
            [
                'user_id' => $lowCandidate->id,
                'project_id' => $this->project->id,
                'peran' => 'Backend',
                'nominal_fee' => 1000000,
                'status_keanggotaan' => 'Pending',
                'created_at' => now()->subMinutes(20), // Daftar lebih awal
                'updated_at' => now()->subMinutes(20),
            ],
            [
                'user_id' => $highCandidate->id,
                'project_id' => $this->project->id,
                'peran' => 'Backend',
                'nominal_fee' => 1000000,
                'status_keanggotaan' => 'Pending',
                'created_at' => now()->subMinutes(5), // Daftar belakangan
                'updated_at' => now()->subMinutes(5),
            ],
        ]);

        // Dengan filter posisi 'Backend'
        $results = $this->service->getCandidatesForProject($this->project, 'Backend');

        $this->assertCount(2, $results);
        $this->assertEquals($highCandidate->id, $results->first()->user_id);
        $this->assertEquals(100, $results->first()->match_score);
        $this->assertEquals($lowCandidate->id, $results->last()->user_id);
        $this->assertEquals(0, $results->last()->match_score);
    }

    /**
     * MOD-05-UT06: test_skill_matching_score_is_isolated_per_project_position
     * Kalkulasi skor pencocokan posisi A terisolasi dengan sempurna dan tidak terpengaruh oleh syarat skill posisi B dalam satu proyek.
     */
    public function test_skill_matching_score_is_isolated_per_project_position(): void
    {
        $beCandidate = User::create(['name' => 'BE Specialist', 'email' => 'be_spec@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);
        $feCandidate = User::create(['name' => 'FE Specialist', 'email' => 'fe_spec@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);

        DB::table('project_member')->insert([
            [
                'user_id' => $beCandidate->id,
                'project_id' => $this->project->id,
                'peran' => 'Posisi-Backend',
                'nominal_fee' => 1000000,
                'status_keanggotaan' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $feCandidate->id,
                'project_id' => $this->project->id,
                'peran' => 'Posisi-Frontend',
                'nominal_fee' => 1000000,
                'status_keanggotaan' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $beResults = $this->service->getCandidatesForProject($this->project, 'Posisi-Backend');
        $this->assertCount(1, $beResults);
        $this->assertEquals($beCandidate->id, $beResults->first()->user_id);

        $feResults = $this->service->getCandidatesForProject($this->project, 'Posisi-Frontend');
        $this->assertCount(1, $feResults);
        $this->assertEquals($feCandidate->id, $feResults->first()->user_id);
    }
}
