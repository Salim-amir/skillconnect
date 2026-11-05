<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EvaluationAndProgressModuleTest extends TestCase
{
    use RefreshDatabase;

    protected User $creator;

    protected User $member;

    protected Project $project;

    protected int $memberPivotId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->creator = User::create([
            'name' => 'Creator Evaluasi',
            'email' => 'eval_c@example.com',
            'password' => Hash::make('password123'),
            'role' => 'creator',
        ]);

        $this->member = User::create([
            'name' => 'Member Evaluasi',
            'email' => 'eval_m@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $this->project = Project::create([
            'creator_id' => $this->creator->id,
            'judul_project' => 'Proyek Evaluasi Kinerja',
            'deskripsi' => 'Pengujian progres dan penilaian anggota.',
            'kategori' => 'Web Development',
            'budget' => 3000000,
            'status_project' => 'Berjalan',
        ]);

        $this->memberPivotId = DB::table('project_member')->insertGetId([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'peran' => 'Backend Specialist',
            'nominal_fee' => 1500000,
            'status_keanggotaan' => 'Diterima',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * MOD-09-UT01: test_system_calculates_project_progress_percentage_and_task_statistics
     * Sistem sukses menghitung persentase kemajuan progres proyek dan statistik tugas secara akurat berdasarkan status papan Kanban.
     */
    public function test_system_calculates_project_progress_percentage_and_task_statistics(): void
    {
        // 4 task: 1 Selesai, 1 Sedang Dikerjakan, 1 Belum Dikerjakan, 1 Menunggu Review
        Task::create(['project_id' => $this->project->id, 'user_id' => $this->member->id, 'nama_task' => 'Task 1', 'deadline' => now()->addDays(2), 'status_task' => 'Selesai']);
        Task::create(['project_id' => $this->project->id, 'user_id' => $this->member->id, 'nama_task' => 'Task 2', 'deadline' => now()->addDays(2), 'status_task' => 'Sedang Dikerjakan']);
        Task::create(['project_id' => $this->project->id, 'user_id' => $this->member->id, 'nama_task' => 'Task 3', 'deadline' => now()->addDays(2), 'status_task' => 'Belum Dikerjakan']);
        Task::create(['project_id' => $this->project->id, 'user_id' => $this->member->id, 'nama_task' => 'Task 4', 'deadline' => now()->addDays(2), 'status_task' => 'Menunggu Review']);

        $stats = $this->project->getTaskStatistics();

        $this->assertEquals(4, $stats['total']);
        $this->assertEquals(1, $stats['done']);
        $this->assertEquals(1, $stats['in_progress']);
        $this->assertEquals(1, $stats['todo']);
        $this->assertEquals(1, $stats['review']);
        $this->assertEquals(25.0, $stats['percentage']); // 1 dari 4 = 25%
    }

    /**
     * MOD-09-UT02: test_project_progress_percentage_updates_dynamically_on_task_approval
     * Persentase progres proyek bertambah secara dinamis setiap kali ada tugas yang disetujui (bergeser ke status Done).
     */
    public function test_project_progress_percentage_updates_dynamically_on_task_approval(): void
    {
        $task1 = Task::create(['project_id' => $this->project->id, 'user_id' => $this->member->id, 'nama_task' => 'T1', 'deadline' => now()->addDays(1), 'status_task' => 'Belum Dikerjakan']);
        $task2 = Task::create(['project_id' => $this->project->id, 'user_id' => $this->member->id, 'nama_task' => 'T2', 'deadline' => now()->addDays(1), 'status_task' => 'Menunggu Review']);

        $this->assertEquals(0.0, $this->project->calculateProgress());

        // Creator menyetujui task2 menjadi Selesai (Done)
        $this->actingAs($this->creator)->put('/proyek/'.$this->project->id.'/tasks/'.$task2->id.'/status', [
            'status_task' => 'Selesai',
        ]);

        $this->assertEquals(50.0, $this->project->calculateProgress());

        // Creator menyetujui task1 menjadi Selesai (Done)
        $this->actingAs($this->creator)->put('/proyek/'.$this->project->id.'/tasks/'.$task1->id.'/status', [
            'status_task' => 'Selesai',
        ]);

        $this->assertEquals(100.0, $this->project->calculateProgress());
    }

    /**
     * MOD-09-UT03: test_creator_can_submit_star_rating_and_qualitative_evaluation
     * Project Creator berhasil mengirimkan rating bintang (1–5) serta catatan ulasan kualitatif kepada anggota tim.
     */
    public function test_creator_can_submit_star_rating_and_qualitative_evaluation(): void
    {
        $payload = [
            'nilai_evaluasi' => 5,
            'catatan_evaluasi' => 'Kerja sangat cepat dan kode sangat terstruktur rapi.',
        ];

        $response = $this->actingAs($this->creator)->post('/proyek/'.$this->project->id.'/evaluasi/'.$this->memberPivotId, $payload);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('project_member', [
            'id' => $this->memberPivotId,
            'nilai_evaluasi' => 5,
            'catatan_evaluasi' => 'Kerja sangat cepat dan kode sangat terstruktur rapi.',
        ]);
    }

    /**
     * MOD-09-UT04: test_system_generates_verified_project_history_on_member_public_profile
     * Sistem otomatis membangkitkan dan merekam riwayat proyek terverifikasi ke dalam portofolio profil publik member.
     */
    public function test_system_generates_verified_project_history_on_member_public_profile(): void
    {
        // Proyek diselesaikan
        $this->project->update(['status_project' => 'Selesai']);

        DB::table('project_member')
            ->where('id', $this->memberPivotId)
            ->update([
                'nilai_evaluasi' => 5,
                'catatan_evaluasi' => 'Luar biasa!',
            ]);

        $verifiedProjects = $this->member->getVerifiedProjects();

        $this->assertCount(1, $verifiedProjects);
        $this->assertEquals($this->project->id, $verifiedProjects->first()->id);
        $this->assertEquals(5, $verifiedProjects->first()->pivot->nilai_evaluasi);
    }

    /**
     * MOD-09-UT05: test_evaluation_form_submission_fails_when_rating_or_notes_are_empty
     * Validasi backend menolak pengiriman formulir evaluasi jika atribut rating bintang atau catatan performa dikosongkan.
     */
    public function test_evaluation_form_submission_fails_when_rating_or_notes_are_empty(): void
    {
        $response = $this->actingAs($this->creator)->postJson('/proyek/'.$this->project->id.'/evaluasi/'.$this->memberPivotId, []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['nilai_evaluasi', 'catatan_evaluasi']);
    }
}
