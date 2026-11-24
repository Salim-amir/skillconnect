<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TeamCollaborationIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected User $creator;

    protected User $member;

    protected User $outsider;

    protected Project $project;

    protected function setUp(): void
    {
        parent::setUp();

        $this->creator = User::create([
            'name' => 'Creator Collab',
            'email' => 'creator_collab@example.com',
            'password' => Hash::make('password123'),
            'role' => 'creator',
        ]);

        $this->member = User::create([
            'name' => 'Member Collab',
            'email' => 'member_collab@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $this->outsider = User::create([
            'name' => 'Outsider User',
            'email' => 'outsider@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $this->project = Project::create([
            'creator_id' => $this->creator->id,
            'judul_project' => 'Proyek Website Kolaborasi',
            'deskripsi' => 'Pengujian fitur kolaborasi tim, tautan sumber daya, dan chat diskusi.',
            'kategori' => 'Web Development',
            'budget' => 5000000,
            'status_project' => 'Berjalan',
        ]);

        // Masukkan member sebagai anggota tim yang diterima
        DB::table('project_member')->insert([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'peran' => 'Fullstack Developer',
            'nominal_fee' => 2500000,
            'status_keanggotaan' => 'Diterima',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Test: Creator atau anggota tim dapat memperbarui tautan kolaborasi (GitHub, Figma, Demo).
     */
    public function test_team_can_update_collaboration_links(): void
    {
        $payload = [
            'github_url' => 'https://github.com/my-team/website-project',
            'figma_url' => 'https://figma.com/design/sample-project',
            'demo_url' => 'https://my-website-preview.vercel.app',
            'docs_url' => 'https://docs.google.com/document/d/sample',
        ];

        $response = $this->actingAs($this->creator)->post('/proyek/'.$this->project->id.'/links', $payload);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('projects', [
            'id' => $this->project->id,
            'github_url' => 'https://github.com/my-team/website-project',
            'figma_url' => 'https://figma.com/design/sample-project',
            'demo_url' => 'https://my-website-preview.vercel.app',
            'docs_url' => 'https://docs.google.com/document/d/sample',
        ]);
    }

    /**
     * Test: Anggota tim dan creator dapat mengirim serta mengambil pesan di ruang obrolan proyek.
     */
    public function test_team_can_send_and_retrieve_chat_messages(): void
    {
        // 1. Member mengirim pesan
        $responseSend = $this->actingAs($this->member)->postJson('/proyek/'.$this->project->id.'/messages', [
            'pesan' => 'Halo tim! Desain dan repositori GitHub sudah saya sinkronkan.',
        ]);

        $responseSend->assertOk();
        $responseSend->assertJsonPath('success', true);
        $this->assertDatabaseHas('project_messages', [
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'pesan' => 'Halo tim! Desain dan repositori GitHub sudah saya sinkronkan.',
        ]);

        // 2. Creator mengambil daftar pesan
        $responseGet = $this->actingAs($this->creator)->getJson('/proyek/'.$this->project->id.'/messages');
        $responseGet->assertOk();
        $responseGet->assertJsonPath('success', true);
        $this->assertCount(1, $responseGet->json('messages'));
        $this->assertEquals('Halo tim! Desain dan repositori GitHub sudah saya sinkronkan.', $responseGet->json('messages.0.pesan'));
    }

    /**
     * Test: Anggota tim dan creator dapat berdiskusi melalui komentar pada task.
     */
    public function test_team_can_comment_on_specific_task(): void
    {
        $task = Task::create([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'nama_task' => 'Integrasi Payment Gateway',
            'deadline' => now()->addDays(4),
            'status_task' => 'Sedang Dikerjakan',
        ]);

        // 1. Member memberikan komentar
        $responseComment = $this->actingAs($this->member)->postJson('/proyek/'.$this->project->id.'/tasks/'.$task->id.'/comments', [
            'komentar' => 'Apakah kita menggunakan mode Sandbox untuk testing terlebih dahulu?',
        ]);

        $responseComment->assertOk();
        $responseComment->assertJsonPath('success', true);
        $this->assertDatabaseHas('task_comments', [
            'task_id' => $task->id,
            'user_id' => $this->member->id,
            'komentar' => 'Apakah kita menggunakan mode Sandbox untuk testing terlebih dahulu?',
        ]);

        // 2. Creator mengambil komentar pada task
        $responseGetComments = $this->actingAs($this->creator)->getJson('/proyek/'.$this->project->id.'/tasks/'.$task->id.'/comments');
        $responseGetComments->assertOk();
        $responseGetComments->assertJsonPath('success', true);
        $this->assertCount(1, $responseGetComments->json('comments'));
        $this->assertEquals('Apakah kita menggunakan mode Sandbox untuk testing terlebih dahulu?', $responseGetComments->json('comments.0.komentar'));
    }

    /**
     * Test: Anggota dapat menyerahkan hasil website berupa Link Demo/Repositori tanpa berkas fisik.
     */
    public function test_member_can_submit_proof_using_demo_link(): void
    {
        $task = Task::create([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'nama_task' => 'Deploy Landing Page ke Vercel',
            'deadline' => now()->addDays(2),
            'status_task' => 'Sedang Dikerjakan',
        ]);

        $payload = [
            'link_demo' => 'https://landing-page-skillconnect.vercel.app',
        ];

        $response = $this->actingAs($this->member)->post('/proyek/'.$this->project->id.'/tasks/'.$task->id.'/bukti', $payload);

        $response->assertSessionHas('success');
        $task->refresh();
        $this->assertEquals('Menunggu Review', $task->status_task);
        $this->assertEquals('https://landing-page-skillconnect.vercel.app', $task->link_demo);
    }

    /**
     * Test: Pengguna luar yang bukan anggota tim dilarang mengakses pesan atau komentar proyek (403).
     */
    public function test_outsider_cannot_access_team_collaboration(): void
    {
        $responseChat = $this->actingAs($this->outsider)->get('/proyek/'.$this->project->id.'/messages');
        $responseChat->assertStatus(403);

        $responseLinks = $this->actingAs($this->outsider)->post('/proyek/'.$this->project->id.'/links', [
            'github_url' => 'https://github.com/hack',
        ]);
        $responseLinks->assertStatus(403);
    }
}
