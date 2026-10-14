<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Skill;
use App\Models\Project;
use App\Services\ExactSkillMatchingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class ExactSkillMatchingTest extends TestCase
{
    use RefreshDatabase;

    protected ExactSkillMatchingService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ExactSkillMatchingService();
    }

    /**
     * Test: Rumus Skor Kecocokan dan Format Ringkasan (Cocok X dari Y Skill)
     * Contoh proposal: Proyek butuh Laravel, React, MySQL (3 skill)
     * - User A punya ketiganya: 100%, Cocok 3 dari 3 Skill
     * - User B hanya punya Laravel: 33%, Cocok 1 dari 3 Skill
     * - User C tidak punya satupun: 0%, Cocok 0 dari 3 Skill
     */
    public function test_exact_skill_matching_score_calculation_and_summary(): void
    {
        // 1. Buat Creator dan Proyek
        $creator = User::create([
            'name'     => 'Creator Proyek',
            'email'    => 'creator@example.com',
            'password' => bcrypt('password'),
            'role'     => 'creator',
        ]);

        $project = Project::create([
            'creator_id'     => $creator->id,
            'judul_project'  => 'Platform E-Commerce PBL',
            'deskripsi'      => 'Membangun aplikasi fullstack',
            'kategori'       => 'Web Development',
            'budget'         => 3000000,
            'status_project' => 'Open',
        ]);

        // 2. Buat Skill Proyek: Laravel, React, MySQL
        $skillLaravel = Skill::create(['nama_skill' => 'Laravel']);
        $skillReact   = Skill::create(['nama_skill' => 'React']);
        $skillMySQL   = Skill::create(['nama_skill' => 'MySQL']);

        $project->skills()->attach([$skillLaravel->id, $skillReact->id, $skillMySQL->id]);

        // 3. Buat Pelamar A (Punya 3 skill)
        $userA = User::create([
            'name'     => 'Kandidat Sempurna',
            'email'    => 'a@example.com',
            'password' => bcrypt('password'),
            'role'     => 'member',
        ]);
        $userA->skills()->attach([
            $skillLaravel->id => ['tingkat_keahlian' => 'Advanced'],
            $skillReact->id   => ['tingkat_keahlian' => 'Intermediate'],
            $skillMySQL->id   => ['tingkat_keahlian' => 'Intermediate'],
        ]);

        // 4. Buat Pelamar B (Punya 1 skill: Laravel)
        $userB = User::create([
            'name'     => 'Kandidat Satu Skill',
            'email'    => 'b@example.com',
            'password' => bcrypt('password'),
            'role'     => 'member',
        ]);
        $userB->skills()->attach([
            $skillLaravel->id => ['tingkat_keahlian' => 'Beginner'],
        ]);

        // 5. Buat Pelamar C (Punya skill lain: Flutter, tapi bukan skill proyek)
        $skillFlutter = Skill::create(['nama_skill' => 'Flutter']);
        $userC = User::create([
            'name'     => 'Kandidat Beda Skill',
            'email'    => 'c@example.com',
            'password' => bcrypt('password'),
            'role'     => 'member',
        ]);
        $userC->skills()->attach([
            $skillFlutter->id => ['tingkat_keahlian' => 'Advanced'],
        ]);

        // Daftarkan sebagai pelamar ke proyek
        DB::table('project_member')->insert([
            [
                'user_id'            => $userA->id,
                'project_id'         => $project->id,
                'peran'              => 'Backend Developer',
                'nominal_fee'        => 1200000,
                'status_keanggotaan' => 'Pending',
                'created_at'         => now()->subMinutes(30),
                'updated_at'         => now()->subMinutes(30),
            ],
            [
                'user_id'            => $userB->id,
                'project_id'         => $project->id,
                'peran'              => 'Backend Developer',
                'nominal_fee'        => 1000000,
                'status_keanggotaan' => 'Pending',
                'created_at'         => now()->subMinutes(20),
                'updated_at'         => now()->subMinutes(20),
            ],
            [
                'user_id'            => $userC->id,
                'project_id'         => $project->id,
                'peran'              => 'Backend Developer',
                'nominal_fee'        => 900000,
                'status_keanggotaan' => 'Pending',
                'created_at'         => now()->subMinutes(10),
                'updated_at'         => now()->subMinutes(10),
            ],
        ]);

        // Uji evaluasi dengan filter posisi 'Backend Developer'
        $candidates = $this->service->getCandidatesForProject($project, 'Backend Developer');

        $this->assertCount(3, $candidates);

        // Kandidat peringkat 1 harus User A (100% cocok, 3 dari 3)
        $first = $candidates->first();
        $this->assertEquals($userA->id, $first->user_id);
        $this->assertEquals(3, $first->matching_count);
        $this->assertEquals(100, $first->match_score);
        $this->assertEquals('Cocok 3 dari 3 Skill', $first->match_summary);

        // Kandidat peringkat 2 harus User B (33% cocok, 1 dari 3)
        $second = $candidates->get(1);
        $this->assertEquals($userB->id, $second->user_id);
        $this->assertEquals(1, $second->matching_count);
        $this->assertEquals(33, $second->match_score);
        $this->assertEquals('Cocok 1 dari 3 Skill', $second->match_summary);

        // Kandidat peringkat 3 harus User C (0% cocok, 0 dari 3)
        $third = $candidates->get(2);
        $this->assertEquals($userC->id, $third->user_id);
        $this->assertEquals(0, $third->matching_count);
        $this->assertEquals(0, $third->match_score);
        $this->assertEquals('Cocok 0 dari 3 Skill', $third->match_summary);
    }

    /**
     * Test: Urutan Default Sebelum Filter Posisi Dipilih (Berdasarkan Waktu Pendaftaran / New)
     */
    public function test_default_sorting_by_registration_time_when_no_filter(): void
    {
        $creator = User::create([
            'name'     => 'Creator',
            'email'    => 'creator2@example.com',
            'password' => bcrypt('password'),
            'role'     => 'creator',
        ]);

        $project = Project::create([
            'creator_id'     => $creator->id,
            'judul_project'  => 'Proyek PBL Mobile',
            'deskripsi'      => 'Test',
            'kategori'       => 'Mobile',
            'budget'         => 2000000,
            'status_project' => 'Open',
        ]);

        $u1 = User::create(['name' => 'Pendaftar Lama', 'email' => 'u1@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);
        $u2 = User::create(['name' => 'Pendaftar Baru', 'email' => 'u2@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);

        DB::table('project_member')->insert([
            [
                'user_id'            => $u1->id,
                'project_id'         => $project->id,
                'peran'              => 'Frontend Developer',
                'nominal_fee'        => 1000000,
                'status_keanggotaan' => 'Pending',
                'created_at'         => now()->subHours(2),
                'updated_at'         => now()->subHours(2),
            ],
            [
                'user_id'            => $u2->id,
                'project_id'         => $project->id,
                'peran'              => 'UI/UX Designer',
                'nominal_fee'        => 800000,
                'status_keanggotaan' => 'Pending',
                'created_at'         => now()->subMinutes(5), // Lebih baru (new)
                'updated_at'         => now()->subMinutes(5),
            ],
        ]);

        // Default query tanpa filter posisi
        $candidates = $this->service->getCandidatesForProject($project, null);

        $this->assertCount(2, $candidates);
        // Yang mendaftar terbaru harus tampil pertama (new)
        $this->assertEquals($u2->id, $candidates->first()->user_id);
        $this->assertEquals($u1->id, $candidates->last()->user_id);
    }

    /**
     * Test: Filter Posisi Menyaring Sesuai Posisi yang Dipilih
     */
    public function test_filter_by_position_isolates_candidates(): void
    {
        $creator = User::create([
            'name'     => 'Creator 3',
            'email'    => 'creator3@example.com',
            'password' => bcrypt('password'),
            'role'     => 'creator',
        ]);

        $project = Project::create([
            'creator_id'     => $creator->id,
            'judul_project'  => 'Proyek Filter Test',
            'deskripsi'      => 'Test',
            'kategori'       => 'Web',
            'budget'         => 2000000,
            'status_project' => 'Open',
        ]);

        $u1 = User::create(['name' => 'Frontend Guy', 'email' => 'fe@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);
        $u2 = User::create(['name' => 'Backend Guy', 'email' => 'be@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);

        DB::table('project_member')->insert([
            ['user_id' => $u1->id, 'project_id' => $project->id, 'peran' => 'Frontend', 'nominal_fee' => 1000000, 'status_keanggotaan' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $u2->id, 'project_id' => $project->id, 'peran' => 'Backend',  'nominal_fee' => 1000000, 'status_keanggotaan' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $positions = $this->service->getAvailablePositions($project->id);
        $this->assertContains('Frontend', $positions);
        $this->assertContains('Backend', $positions);

        $frontendOnly = $this->service->getCandidatesForProject($project, 'Frontend');
        $this->assertCount(1, $frontendOnly);
        $this->assertEquals('Frontend Guy', $frontendOnly->first()->candidate_name);
    }

    /**
     * Test: Tie-breaker Berdasarkan Tingkat Keahlian (Advanced vs Beginner)
     */
    public function test_tie_breaker_by_skill_proficiency_level(): void
    {
        $creator = User::create(['name' => 'Creator 4', 'email' => 'c4@example.com', 'password' => bcrypt('pw'), 'role' => 'creator']);
        $project = Project::create([
            'creator_id'     => $creator->id,
            'judul_project'  => 'Tie Breaker Project',
            'deskripsi'      => 'Test',
            'kategori'       => 'Web',
            'budget'         => 1000000,
            'status_project' => 'Open',
        ]);

        $skillPhp = Skill::create(['nama_skill' => 'PHP']);
        $project->skills()->attach($skillPhp->id);

        $userAdv = User::create(['name' => 'Senior PHP', 'email' => 'senior@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);
        $userAdv->skills()->attach($skillPhp->id, ['tingkat_keahlian' => 'Advanced']);

        $userBeg = User::create(['name' => 'Junior PHP', 'email' => 'junior@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);
        $userBeg->skills()->attach($skillPhp->id, ['tingkat_keahlian' => 'Beginner']);

        DB::table('project_member')->insert([
            ['user_id' => $userBeg->id, 'project_id' => $project->id, 'peran' => 'Backend', 'nominal_fee' => 500000, 'status_keanggotaan' => 'Pending', 'created_at' => now()->subMinutes(10), 'updated_at' => now()],
            ['user_id' => $userAdv->id, 'project_id' => $project->id, 'peran' => 'Backend', 'nominal_fee' => 500000, 'status_keanggotaan' => 'Pending', 'created_at' => now()->subMinutes(5), 'updated_at' => now()],
        ]);

        $results = $this->service->getCandidatesForProject($project, 'Backend');

        // Keduanya punya 100% kecocokan, tetapi Senior PHP memiliki bobot lebih tinggi (Advanced = 3 vs Beginner = 1)
        $this->assertEquals($userAdv->id, $results->first()->user_id);
    }
}
