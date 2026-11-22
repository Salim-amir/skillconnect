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

class ProjectSearchAndApplicationIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected User $creator;

    protected User $member;

    protected Project $project;

    protected function setUp(): void
    {
        parent::setUp();

        $this->creator = User::create([
            'name' => 'Creator PBL',
            'email' => 'creator@example.com',
            'password' => Hash::make('password123'),
            'role' => 'creator',
        ]);

        $this->member = User::create([
            'name' => 'Member PBL',
            'email' => 'member@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $this->project = Project::create([
            'creator_id' => $this->creator->id,
            'judul_project' => 'Aplikasi Marketplace Jasa',
            'deskripsi' => 'Platform mempertemukan klien dan freelancer terpercaya.',
            'kategori' => 'Web Development',
            'budget' => 5000000,
            'status_project' => 'Mencari Tim',
        ]);
    }

    /**
     * MOD-03-UT01: test_member_can_view_available_project_list
     * Endpoint katalog publik merespons status HTTP 200 dan menampilkan daftar proyek aktif.
     */
    public function test_member_can_view_available_project_list(): void
    {
        $response = $this->actingAs($this->member)->get('/proyek');

        $response->assertStatus(200);
        $response->assertViewHas('projects');
        $this->assertTrue($response->viewData('projects')->pluck('id')->contains($this->project->id));
    }

    /**
     * MOD-03-UT02: test_member_can_search_projects_by_keyword
     * Query pencarian berdasarkan judul proyek berhasil memfilter data dengan presisi.
     */
    public function test_member_can_search_projects_by_keyword(): void
    {
        $anotherProject = Project::create([
            'creator_id' => $this->creator->id,
            'judul_project' => 'Sistem Informasi Rumah Sakit',
            'deskripsi' => 'Aplikasi manajemen rekam medis.',
            'kategori' => 'Desktop',
            'budget' => 8000000,
            'status_project' => 'Mencari Tim',
        ]);

        $response = $this->actingAs($this->member)->get('/proyek?q=Marketplace');

        $response->assertStatus(200);
        $projects = $response->viewData('projects');
        $this->assertTrue($projects->pluck('id')->contains($this->project->id));
        $this->assertFalse($projects->pluck('id')->contains($anotherProject->id));
    }

    /**
     * MOD-03-UT03: test_system_handles_empty_search_result_gracefully
     * Sistem mengembalikan respons array kosong atau pesan "data tidak ditemukan" saat keyword nihil.
     */
    public function test_system_handles_empty_search_result_gracefully(): void
    {
        $response = $this->actingAs($this->member)->get('/proyek?q=KeywordYangPastiTidakAda123XYZ');

        $response->assertStatus(200);
        $projects = $response->viewData('projects');
        $this->assertCount(0, $projects);
    }

    /**
     * MOD-03-UT04: test_member_can_view_project_detail_information
     * Endpoint detail proyek berhasil memuat informasi deskripsi, kategori, dan daftar kebutuhan skill.
     */
    public function test_member_can_view_project_detail_information(): void
    {
        $skill = Skill::create(['nama_skill' => 'Laravel']);
        $this->project->skills()->attach($skill->id);

        $response = $this->actingAs($this->member)->get('/proyek/'.$this->project->id);

        $response->assertStatus(200);
        $response->assertViewHas('project');
        $viewProject = $response->viewData('project');
        $this->assertEquals($this->project->judul_project, $viewProject->judul_project);
        $this->assertEquals($this->project->kategori, $viewProject->kategori);
        $this->assertTrue($viewProject->skills->pluck('nama_skill')->contains('Laravel'));
    }

    /**
     * MOD-03-UT05: test_system_displays_candidate_recommendations_based_on_skills
     * Algoritma rekomendasi berhasil mencocokkan inventaris skill pengguna dengan kebutuhan proyek.
     */
    public function test_system_displays_candidate_recommendations_based_on_skills(): void
    {
        $skill = Skill::create(['nama_skill' => 'React']);
        $this->project->skills()->attach($skill->id);

        $this->member->skills()->attach($skill->id, ['tingkat_keahlian' => 'Advanced']);

        DB::table('project_member')->insert([
            'user_id' => $this->member->id,
            'project_id' => $this->project->id,
            'peran' => 'Frontend Developer',
            'nominal_fee' => 2000000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $service = new ExactSkillMatchingService;
        $candidates = $service->getCandidatesForProject($this->project, 'Frontend Developer');

        $this->assertNotEmpty($candidates);
        $this->assertEquals($this->member->id, $candidates->first()->user_id);
    }

    /**
     * MOD-03-UT06: test_system_calculates_and_displays_skill_matching_percentage
     * Mesin pencocokan menghitung dan merender persentase skor kecocokan skill secara akurat.
     */
    public function test_system_calculates_and_displays_skill_matching_percentage(): void
    {
        $s1 = Skill::create(['nama_skill' => 'PHP']);
        $s2 = Skill::create(['nama_skill' => 'MySQL']);
        $this->project->skills()->attach([$s1->id, $s2->id]);

        $this->member->skills()->attach($s1->id, ['tingkat_keahlian' => 'Intermediate']);

        DB::table('project_member')->insert([
            'user_id' => $this->member->id,
            'project_id' => $this->project->id,
            'peran' => 'Backend Developer',
            'nominal_fee' => 2000000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $service = new ExactSkillMatchingService;
        $candidates = $service->getCandidatesForProject($this->project, 'Backend Developer');

        // 1 dari 2 skill cocok -> 50%
        $this->assertEquals(50, $candidates->first()->match_score);
        $this->assertEquals('Cocok 1 dari 2 Skill', $candidates->first()->match_summary);
    }

    /**
     * MOD-03-UT07: test_member_can_submit_application_to_project
     * Data lamaran kerja berhasil direkam ke dalam tabel applications/project_member dengan status awal Pending.
     */
    public function test_member_can_submit_application_to_project(): void
    {
        $payload = [
            'peran' => 'UI/UX Designer',
            'nominal_fee' => 1500000,
            'pesan' => 'Saya tertarik berkontribusi pada proyek ini.',
            'cv_link' => 'https://drive.google.com/cv-member',
        ];

        $response = $this->actingAs($this->member)->post('/proyek/'.$this->project->id.'/apply', $payload);

        $response->assertRedirect('/proyek/'.$this->project->id);
        $this->assertDatabaseHas('project_member', [
            'user_id' => $this->member->id,
            'project_id' => $this->project->id,
            'peran' => 'UI/UX Designer',
            'status_keanggotaan' => 'Pending',
        ]);
    }

    /**
     * MOD-03-UT08: test_system_prevents_duplicate_application_to_same_project
     * Sistem mencegah pengajuan lamaran ganda (double application) ke posisi proyek yang sama.
     */
    public function test_system_prevents_duplicate_application_to_same_project(): void
    {
        DB::table('project_member')->insert([
            'user_id' => $this->member->id,
            'project_id' => $this->project->id,
            'peran' => 'Backend Developer',
            'nominal_fee' => 1500000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $payload = [
            'peran' => 'Backend Developer',
            'nominal_fee' => 1500000,
            'cv_link' => 'https://drive.google.com/cv-member',
        ];

        $response = $this->actingAs($this->member)->post('/proyek/'.$this->project->id.'/apply', $payload);

        // Harus dicegah (status info/error) dan jumlah record tetap 1
        $count = DB::table('project_member')
            ->where('user_id', $this->member->id)
            ->where('project_id', $this->project->id)
            ->count();

        $this->assertEquals(1, $count);
    }

    /**
     * MOD-03-UT09: test_project_creator_can_view_incoming_applications
     * Pemilik proyek berhasil mengakses daftar pelamar yang masuk untuk divalidasi.
     */
    public function test_project_creator_can_view_incoming_applications(): void
    {
        DB::table('project_member')->insert([
            'user_id' => $this->member->id,
            'project_id' => $this->project->id,
            'peran' => 'Fullstack Developer',
            'nominal_fee' => 2500000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->creator)->get('/proyek/'.$this->project->id);

        $response->assertStatus(200);
        $response->assertViewHas('candidates');
        $this->assertCount(1, $response->viewData('candidates'));
    }

    /**
     * MOD-03-UT10: test_project_creator_can_accept_pending_application
     * Status lamaran pelamar berhasil diperbarui menjadi Accepted oleh Project Creator.
     */
    public function test_project_creator_can_accept_pending_application(): void
    {
        $appId = DB::table('project_member')->insertGetId([
            'user_id' => $this->member->id,
            'project_id' => $this->project->id,
            'peran' => 'Mobile Developer',
            'nominal_fee' => 2000000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->creator)->post('/proyek/'.$this->project->id.'/kandidat/'.$appId, [
            'action' => 'terima',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('project_member', [
            'id' => $appId,
            'status_keanggotaan' => 'Diterima',
        ]);
    }

    /**
     * MOD-03-UT11: test_member_can_track_their_application_status
     * Pengguna dapat melihat riwayat dan status terkini dari lamaran yang telah diajukan.
     */
    public function test_member_can_track_their_application_status(): void
    {
        DB::table('project_member')->insert([
            'user_id' => $this->member->id,
            'project_id' => $this->project->id,
            'peran' => 'Data Analyst',
            'nominal_fee' => 1800000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->member)->get('/proyek/riwayat');

        $response->assertStatus(200);
        $response->assertViewHas('joinedProjects');
        $joined = $response->viewData('joinedProjects');
        $this->assertTrue($joined->pluck('id')->contains($this->project->id));
        $this->assertEquals('Pending', $joined->firstWhere('id', $this->project->id)->status_keanggotaan);
    }
}
