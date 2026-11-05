<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TaskBoardAndProofModuleTest extends TestCase
{
    use RefreshDatabase;

    protected User $creator;

    protected User $member;

    protected Project $project;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->creator = User::create([
            'name' => 'Creator Task',
            'email' => 'task_c@example.com',
            'password' => Hash::make('password123'),
            'role' => 'creator',
        ]);

        $this->member = User::create([
            'name' => 'Member Task',
            'email' => 'task_m@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $this->project = Project::create([
            'creator_id' => $this->creator->id,
            'judul_project' => 'Proyek Kanban Task',
            'deskripsi' => 'Pengujian manajemen task board dan review bukti.',
            'kategori' => 'Web Development',
            'budget' => 4000000,
            'status_project' => 'Berjalan',
        ]);

        // Member sudah resmi diterima di tim
        DB::table('project_member')->insert([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'peran' => 'Backend Engineer',
            'nominal_fee' => 2000000,
            'status_keanggotaan' => 'Diterima',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * MOD-08-UT01: test_creator_can_create_and_assign_task_card_to_team_member
     * Project Creator berhasil membuat kartu tugas baru dan menugaskannya kepada anggota tim yang aktif.
     */
    public function test_creator_can_create_and_assign_task_card_to_team_member(): void
    {
        $payload = [
            'nama_task' => 'Setup Database dan Migration',
            'user_id' => $this->member->id,
            'deadline' => now()->addDays(5)->format('Y-m-d'),
        ];

        $response = $this->actingAs($this->creator)->post('/proyek/'.$this->project->id.'/tasks', $payload);

        $response->assertRedirect('/proyek/'.$this->project->id.'/tasks');
        $this->assertDatabaseHas('tasks', [
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'nama_task' => 'Setup Database dan Migration',
            'status_task' => 'Belum Dikerjakan',
        ]);
    }

    /**
     * MOD-08-UT02: test_member_can_update_task_status_to_in_progress
     * Anggota tim (assignee) dapat berhasil memperbarui status tugas menjadi "Sedang Dikerjakan" (In Progress).
     */
    public function test_member_can_update_task_status_to_in_progress(): void
    {
        $task = Task::create([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'nama_task' => 'Implementasi API Auth',
            'deadline' => now()->addDays(3),
            'status_task' => 'Belum Dikerjakan',
        ]);

        $response = $this->actingAs($this->member)->put('/proyek/'.$this->project->id.'/tasks/'.$task->id.'/status', [
            'status_task' => 'Sedang Dikerjakan',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status_task' => 'Sedang Dikerjakan',
        ]);
    }

    /**
     * MOD-08-UT03: test_member_can_submit_task_for_review_with_valid_proof
     * Anggota berhasil mengajukan review tugas dengan mengunggah berkas bukti kerja yang valid.
     */
    public function test_member_can_submit_task_for_review_with_valid_proof(): void
    {
        $task = Task::create([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'nama_task' => 'Slicing UI Dashboard',
            'deadline' => now()->addDays(3),
            'status_task' => 'Sedang Dikerjakan',
        ]);

        $fakeFile = UploadedFile::fake()->create('bukti_kerja.pdf', 500, 'application/pdf');

        $response = $this->actingAs($this->member)->post('/proyek/'.$this->project->id.'/tasks/'.$task->id.'/bukti', [
            'bukti_kerja' => $fakeFile,
        ]);

        $response->assertSessionHas('success');
        $task->refresh();
        $this->assertEquals('Menunggu Review', $task->status_task);
        $this->assertNotNull($task->bukti_kerja);
        Storage::disk('public')->assertExists($task->bukti_kerja);
    }

    /**
     * MOD-08-UT04: test_system_blocks_proof_upload_if_file_exceeds_2mb_or_empty
     * Validasi backend secara otomatis menolak unggahan bukti kerja jika file melebihi batas 2 MB atau kosong (HTTP 422).
     */
    public function test_system_blocks_proof_upload_if_file_exceeds_2mb_or_empty(): void
    {
        $task = Task::create([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'nama_task' => 'Pengujian File Size',
            'deadline' => now()->addDays(3),
            'status_task' => 'Sedang Dikerjakan',
        ]);

        // 1. File kosong / tanpa file
        $responseEmpty = $this->actingAs($this->member)->postJson('/proyek/'.$this->project->id.'/tasks/'.$task->id.'/bukti', []);
        $responseEmpty->assertStatus(422);
        $responseEmpty->assertJsonValidationErrors(['bukti_kerja']);

        // 2. File melebihi batas 2MB (2048 KB), misalnya 3000 KB
        $largeFile = UploadedFile::fake()->create('large_file.pdf', 3000, 'application/pdf');
        $responseLarge = $this->actingAs($this->member)->postJson('/proyek/'.$this->project->id.'/tasks/'.$task->id.'/bukti', [
            'bukti_kerja' => $largeFile,
        ]);
        $responseLarge->assertStatus(422);
        $responseLarge->assertJsonValidationErrors(['bukti_kerja']);
    }

    /**
     * MOD-08-UT05: test_creator_can_approve_task_and_trigger_installment_payout
     * Creator berhasil menyetujui tugas yang direview dan otomatis memicu alur pencairan pembayaran termin.
     */
    public function test_creator_can_approve_task_and_trigger_installment_payout(): void
    {
        $task = Task::create([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'nama_task' => 'Review Task Selesai',
            'deadline' => now()->addDays(2),
            'status_task' => 'Menunggu Review',
        ]);

        $response = $this->actingAs($this->creator)->put('/proyek/'.$this->project->id.'/tasks/'.$task->id.'/status', [
            'status_task' => 'Selesai',
        ]);

        $response->assertSessionHas('success');
        $task->refresh();
        $this->assertEquals('Selesai', $task->status_task);

        // Memicu pencairan pembayaran termin di transactions
        $this->assertDatabaseHas('transactions', [
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'order_id' => 'PAYOUT-TASK-'.$task->id,
            'status_pembayaran' => 'lunas',
        ]);
    }

    /**
     * MOD-08-UT06: test_creator_can_reject_proof_and_provide_revision_notes
     * Creator dapat menolak bukti kerja, mengubah status tugas, dan mencatat catatan revisi kepada member.
     */
    public function test_creator_can_reject_proof_and_provide_revision_notes(): void
    {
        $task = Task::create([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'nama_task' => 'Task Perlu Revisi',
            'deadline' => now()->addDays(2),
            'status_task' => 'Menunggu Review',
        ]);

        $payload = [
            'catatan_revisi' => 'Dokumentasi API belum lengkap pada endpoint logout.',
        ];

        $response = $this->actingAs($this->creator)->post('/proyek/'.$this->project->id.'/tasks/'.$task->id.'/revisi', $payload);

        $response->assertSessionHas('success');
        $task->refresh();
        $this->assertEquals('Sedang Dikerjakan', $task->status_task);
        $this->assertEquals('Dokumentasi API belum lengkap pada endpoint logout.', $task->catatan_revisi);
    }
}
