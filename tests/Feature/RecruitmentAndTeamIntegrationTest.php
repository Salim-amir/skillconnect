<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RecruitmentAndTeamIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected User $creator;

    protected User $member;

    protected Project $project;

    protected function setUp(): void
    {
        parent::setUp();

        $this->creator = User::create([
            'name' => 'Creator Team',
            'email' => 'team_c@example.com',
            'password' => Hash::make('password123'),
            'role' => 'creator',
        ]);

        $this->member = User::create([
            'name' => 'Member Candidate',
            'email' => 'team_m@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $this->project = Project::create([
            'creator_id' => $this->creator->id,
            'judul_project' => 'Proyek PBL Rekrutmen',
            'deskripsi' => 'Pengujian modul rekrutmen dan pembentukan tim.',
            'kategori' => 'Web Development',
            'budget' => 3500000,
            'status_project' => 'Mencari Tim',
        ]);
    }

    /**
     * MOD-07-UT01: test_creator_can_view_filtered_applicant_list_by_position
     * Project Creator berhasil mengakses dan memfilter daftar pelamar masuk secara spesifik berdasarkan parameter posisi.
     */
    public function test_creator_can_view_filtered_applicant_list_by_position(): void
    {
        $backendApplicant = User::create(['name' => 'Backend Candidate', 'email' => 'be_cand@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);
        $frontendApplicant = User::create(['name' => 'Frontend Candidate', 'email' => 'fe_cand@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);

        DB::table('project_member')->insert([
            ['user_id' => $backendApplicant->id, 'project_id' => $this->project->id, 'peran' => 'Backend Developer', 'nominal_fee' => 1000000, 'status_keanggotaan' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $frontendApplicant->id, 'project_id' => $this->project->id, 'peran' => 'Frontend Developer', 'nominal_fee' => 1000000, 'status_keanggotaan' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $response = $this->actingAs($this->creator)->get('/proyek/'.$this->project->id.'?posisi=Backend+Developer');

        $response->assertStatus(200);
        $candidates = $response->viewData('candidates');
        $this->assertCount(1, $candidates);
        $this->assertEquals($backendApplicant->id, $candidates->first()->user_id);
    }

    /**
     * MOD-07-UT02: test_creator_can_approve_application_and_confirm_team_membership
     * Creator sukses menyetujui lamaran member dengan posisi Backend dan mengonfirmasi keanggotaan resmi tim.
     */
    public function test_creator_can_approve_application_and_confirm_team_membership(): void
    {
        $appId = DB::table('project_member')->insertGetId([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'peran' => 'Backend',
            'nominal_fee' => 1200000,
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
            'peran' => 'Backend',
        ]);
    }

    /**
     * MOD-07-UT03: test_member_can_view_and_accept_project_invitation
     * Member dapat melihat notifikasi undangan dan sukses menerima tawaran proyek dari Project Creator.
     */
    public function test_member_can_view_and_accept_project_invitation(): void
    {
        DB::table('project_member')->insert([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'peran' => 'DevOps Engineer',
            'nominal_fee' => 1500000,
            'status_keanggotaan' => 'Undangan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->member)->post('/proyek/'.$this->project->id.'/terima-undangan');

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('project_member', [
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'status_keanggotaan' => 'Diterima',
        ]);
    }

    /**
     * MOD-07-UT04: test_creator_can_remove_team_member_before_project_starts
     * Creator diizinkan mengeluarkan anggota dari daftar tim aktif sebelum status pengerjaan proyek dimulai.
     */
    public function test_creator_can_remove_team_member_before_project_starts(): void
    {
        DB::table('project_member')->insert([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'peran' => 'UI Designer',
            'nominal_fee' => 800000,
            'status_keanggotaan' => 'Diterima',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->creator)->delete('/proyek/'.$this->project->id.'/anggota/'.$this->member->id);

        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('project_member', [
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
        ]);
    }

    /**
     * MOD-07-UT05: test_project_status_updates_to_formed_and_triggers_dp_invoice
     * Sistem otomatis mengubah status proyek menjadi "Tim Terbentuk" dan memicu tagihan DP saat kuota terpenuhi (3/3).
     */
    public function test_project_status_updates_to_formed_and_triggers_dp_invoice(): void
    {
        // 2 anggota sudah Diterima
        for ($i = 1; $i <= 2; $i++) {
            $user = User::create(['name' => 'Member T'.$i, 'email' => "mt{$i}@example.com", 'password' => bcrypt('pw'), 'role' => 'member']);
            DB::table('project_member')->insert([
                'project_id' => $this->project->id,
                'user_id' => $user->id,
                'peran' => 'Role '.$i,
                'nominal_fee' => 500000,
                'status_keanggotaan' => 'Diterima',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Anggota ke-3 disetujui
        $appId = DB::table('project_member')->insertGetId([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'peran' => 'Role 3',
            'nominal_fee' => 500000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAs($this->creator)->post('/proyek/'.$this->project->id.'/kandidat/'.$appId, [
            'action' => 'terima',
            'max_slots' => 3,
        ]);

        $this->project->refresh();
        $this->assertEquals('Tim Terbentuk', $this->project->status_project);
        $this->assertDatabaseHas('transactions', [
            'project_id' => $this->project->id,
            'user_id' => $this->creator->id,
        ]);
    }

    /**
     * MOD-07-UT06: test_unregistered_users_have_restricted_access_to_workspace
     * Pengguna berstatus Pending atau bukan anggota tim memiliki hak akses terbatas (restricted) ke ruang kerja proyek.
     */
    public function test_unregistered_users_have_restricted_access_to_workspace(): void
    {
        $nonMember = User::create(['name' => 'Non Member', 'email' => 'non_member@example.com', 'password' => bcrypt('pw'), 'role' => 'member']);

        // User bukan anggota mengakses task board (workspace proyek)
        $response = $this->actingAs($nonMember)->get('/proyek/'.$this->project->id.'/tasks');

        $response->assertStatus(403);
    }
}
