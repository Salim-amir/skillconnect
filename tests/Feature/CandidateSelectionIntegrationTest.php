<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CandidateSelectionIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected User $creator;

    protected User $candidate;

    protected Project $project;

    protected function setUp(): void
    {
        parent::setUp();

        $this->creator = User::create([
            'name' => 'Creator Selection',
            'email' => 'selection_c@example.com',
            'password' => Hash::make('password123'),
            'role' => 'creator',
        ]);

        $this->candidate = User::create([
            'name' => 'Candidate User',
            'email' => 'cand@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $this->project = Project::create([
            'creator_id' => $this->creator->id,
            'judul_project' => 'Proyek Seleksi Tim',
            'deskripsi' => 'Pengujian pemilihan kandidat dan slot posisi.',
            'kategori' => 'Web Development',
            'budget' => 3000000,
            'status_project' => 'Mencari Tim',
        ]);
    }

    /**
     * MOD-06-UT01: test_project_creator_can_invite_candidate_from_recommendations
     * Project Creator berhasil mengirimkan undangan gabung proyek kepada kandidat terpilih dari daftar rekomendasi.
     */
    public function test_project_creator_can_invite_candidate_from_recommendations(): void
    {
        $response = $this->actingAs($this->creator)->post('/proyek/'.$this->project->id.'/undang', [
            'user_id' => $this->candidate->id,
            'peran' => 'Frontend Developer',
            'nominal_fee' => 1000000,
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('project_member', [
            'project_id' => $this->project->id,
            'user_id' => $this->candidate->id,
            'peran' => 'Frontend Developer',
            'status_keanggotaan' => 'Undangan',
        ]);
    }

    /**
     * MOD-06-UT02: test_project_creator_can_approve_incoming_application
     * Status lamaran pelamar berhasil diperbarui menjadi Accepted (disetujui) oleh Project Creator.
     */
    public function test_project_creator_can_approve_incoming_application(): void
    {
        $appId = DB::table('project_member')->insertGetId([
            'project_id' => $this->project->id,
            'user_id' => $this->candidate->id,
            'peran' => 'Backend Developer',
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
        ]);
    }

    /**
     * MOD-06-UT03: test_project_creator_can_reject_incoming_application
     * Status lamaran pelamar berhasil diperbarui menjadi Rejected (ditolak) sesuai tindakan Creator.
     */
    public function test_project_creator_can_reject_incoming_application(): void
    {
        $appId = DB::table('project_member')->insertGetId([
            'project_id' => $this->project->id,
            'user_id' => $this->candidate->id,
            'peran' => 'UI/UX Designer',
            'nominal_fee' => 900000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->creator)->post('/proyek/'.$this->project->id.'/kandidat/'.$appId, [
            'action' => 'tolak',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('project_member', [
            'id' => $appId,
            'status_keanggotaan' => 'Ditolak',
        ]);
    }

    /**
     * MOD-06-UT04: test_system_blocks_candidate_approval_when_position_slot_is_full
     * Sistem otomatis memblokir dan menolak persetujuan kandidat baru jika kuota posisi sudah penuh terpenuhi.
     */
    public function test_system_blocks_candidate_approval_when_position_slot_is_full(): void
    {
        // Isi kuota penuh (misal 3 anggota sudah diterima)
        for ($i = 1; $i <= 3; $i++) {
            $user = User::create([
                'name' => 'Member '.$i,
                'email' => "member{$i}@example.com",
                'password' => bcrypt('password'),
                'role' => 'member',
            ]);

            DB::table('project_member')->insert([
                'project_id' => $this->project->id,
                'user_id' => $user->id,
                'peran' => 'Role '.$i,
                'nominal_fee' => 800000,
                'status_keanggotaan' => 'Diterima',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Kandidat ke-4 melamar (Pending)
        $appId = DB::table('project_member')->insertGetId([
            'project_id' => $this->project->id,
            'user_id' => $this->candidate->id,
            'peran' => 'Extra Role',
            'nominal_fee' => 800000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Creator mencoba menyetujui kandidat ke-4
        $response = $this->actingAs($this->creator)->post('/proyek/'.$this->project->id.'/kandidat/'.$appId, [
            'action' => 'terima',
            'max_slots' => 3,
        ]);

        $response->assertSessionHas('error');
        // Status tetap Pending (tidak berubah ke Diterima)
        $this->assertDatabaseHas('project_member', [
            'id' => $appId,
            'status_keanggotaan' => 'Pending',
        ]);
    }

    /**
     * MOD-06-UT05: test_member_can_accept_project_invitation
     * Anggota/member sukses menerima undangan proyek dan tercatat resmi sebagai bagian dari tim.
     */
    public function test_member_can_accept_project_invitation(): void
    {
        DB::table('project_member')->insert([
            'project_id' => $this->project->id,
            'user_id' => $this->candidate->id,
            'peran' => 'QA Engineer',
            'nominal_fee' => 1000000,
            'status_keanggotaan' => 'Undangan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->candidate)->post('/proyek/'.$this->project->id.'/terima-undangan');

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('project_member', [
            'project_id' => $this->project->id,
            'user_id' => $this->candidate->id,
            'status_keanggotaan' => 'Diterima',
        ]);
    }

    /**
     * MOD-06-UT06: test_system_updates_team_status_and_triggers_dp_when_slots_are_filled
     * Sistem memperbarui status keseluruhan tim menjadi lengkap dan memicu alur pembayaran DP saat seluruh posisi terisi.
     */
    public function test_system_updates_team_status_and_triggers_dp_when_slots_are_filled(): void
    {
        // 2 anggota sudah Diterima
        for ($i = 1; $i <= 2; $i++) {
            $user = User::create([
                'name' => 'Filled Member '.$i,
                'email' => "fmember{$i}@example.com",
                'password' => bcrypt('pw'),
                'role' => 'member',
            ]);

            DB::table('project_member')->insert([
                'project_id' => $this->project->id,
                'user_id' => $user->id,
                'peran' => 'Member '.$i,
                'nominal_fee' => 500000,
                'status_keanggotaan' => 'Diterima',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Anggota ke-3 (kandidat) disetujui, melengkapi kuota 3/3
        $appId = DB::table('project_member')->insertGetId([
            'project_id' => $this->project->id,
            'user_id' => $this->candidate->id,
            'peran' => 'Member 3',
            'nominal_fee' => 500000,
            'status_keanggotaan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAs($this->creator)->post('/proyek/'.$this->project->id.'/kandidat/'.$appId, [
            'action' => 'terima',
            'max_slots' => 3,
        ]);

        // Status project otomatis menjadi 'Tim Terbentuk'
        $this->project->refresh();
        $this->assertEquals('Tim Terbentuk', $this->project->status_project);

        // Terbit tagihan DP di transactions
        $this->assertDatabaseHas('transactions', [
            'project_id' => $this->project->id,
            'user_id' => $this->creator->id,
            'status_pembayaran' => 'pending',
        ]);
    }
}
