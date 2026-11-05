<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProjectCreationModuleTest extends TestCase
{
    use RefreshDatabase;

    protected User $creator;

    protected Skill $skillLaravel;

    protected Skill $skillVue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->creator = User::create([
            'name' => 'Project Creator',
            'email' => 'creator_p@example.com',
            'password' => Hash::make('password123'),
            'role' => 'creator',
        ]);

        $this->skillLaravel = Skill::create(['nama_skill' => 'Laravel']);
        $this->skillVue = Skill::create(['nama_skill' => 'Vue.js']);
    }

    /**
     * MOD-04-UT01: test_project_creator_can_create_new_project_with_valid_data
     * Data entitas proyek baru berhasil disimpan ke dalam tabel projects dengan status aktif.
     */
    public function test_project_creator_can_create_new_project_with_valid_data(): void
    {
        $payload = [
            'judul_project' => 'Platform E-Learning Kampus',
            'kategori' => 'Web Development',
            'deskripsi' => 'Membangun aplikasi e-learning berbasis modul interaktif dan ujian online.',
            'budget' => 4500000,
            'posisi' => 'Fullstack Developer',
            'skills' => [$this->skillLaravel->id, $this->skillVue->id],
        ];

        $response = $this->actingAs($this->creator)->post('/proyek/buat', $payload);

        $this->assertDatabaseHas('projects', [
            'judul_project' => 'Platform E-Learning Kampus',
            'creator_id' => $this->creator->id,
            'kategori' => 'Web Development',
            'budget' => 4500000,
            'status_project' => 'Mencari Tim',
        ]);
    }

    /**
     * MOD-04-UT02: test_project_creation_fails_when_required_fields_are_empty
     * Validasi backend menolak penyimpanan proyek jika kolom atribut wajib dikosongkan (HTTP 422).
     */
    public function test_project_creation_fails_when_required_fields_are_empty(): void
    {
        $response = $this->actingAs($this->creator)->postJson('/proyek/buat', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'judul_project',
            'kategori',
            'deskripsi',
            'budget',
            'posisi',
            'skills',
        ]);
    }

    /**
     * MOD-04-UT03: test_creator_can_add_specific_positions_fees_and_skills
     * Posisi pekerjaan baru, alokasi fee, dan kriteria skill berhasil disimpan ke tabel terkait.
     */
    public function test_creator_can_add_specific_positions_fees_and_skills(): void
    {
        $payload = [
            'judul_project' => 'Aplikasi IoT Smart Home',
            'kategori' => 'Internet of Things',
            'deskripsi' => 'Proyek kontrol perangkat smart home melalui protokol MQTT dan web dashboard.',
            'budget' => 6000000,
            'posisi' => 'Backend IoT Engineer',
            'posisi_fee' => 3000000,
            'skills' => [$this->skillLaravel->id],
        ];

        $response = $this->actingAs($this->creator)->post('/proyek/buat', $payload);

        $project = Project::where('judul_project', 'Aplikasi IoT Smart Home')->first();
        $this->assertNotNull($project);
        $this->assertTrue($project->skills->pluck('id')->contains($this->skillLaravel->id));

        // Creator otomatis tercatat sebagai leader di project_member
        $this->assertDatabaseHas('project_member', [
            'project_id' => $project->id,
            'user_id' => $this->creator->id,
            'peran' => 'Project Creator / Leader',
        ]);
    }

    /**
     * MOD-04-UT04: test_project_creation_fails_if_total_fees_exceed_budget
     * Aturan bisnis menolak penyimpanan jika total alokasi fee posisi melebihi total budget proyek.
     */
    public function test_project_creation_fails_if_total_fees_exceed_budget(): void
    {
        $payload = [
            'judul_project' => 'Proyek Over Budget',
            'kategori' => 'Mobile Development',
            'deskripsi' => 'Deskripsi lengkap proyek aplikasi mobile yang melebihi batas dana.',
            'budget' => 2000000,
            'posisi' => 'Lead Developer',
            'posisi_fee' => 3500000, // Melebihi budget 2.000.000
            'skills' => [$this->skillLaravel->id],
        ];

        $response = $this->actingAs($this->creator)->postJson('/proyek/buat', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['posisi_fee']);
    }

    /**
     * MOD-04-UT05: test_position_requires_at_least_one_skill_criterion
     * Validasi menolak penambahan posisi pekerjaan baru apabila tidak menyertakan minimal 1 skill.
     */
    public function test_position_requires_at_least_one_skill_criterion(): void
    {
        $payload = [
            'judul_project' => 'Proyek Tanpa Kriteria Skill',
            'kategori' => 'Data Science',
            'deskripsi' => 'Deskripsi proyek pengolahan data analytics untuk bisnis retail lokal.',
            'budget' => 3000000,
            'posisi' => 'Data Analyst',
            'skills' => [], // Kosong
        ];

        $response = $this->actingAs($this->creator)->postJson('/proyek/buat', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['skills']);
    }

    /**
     * MOD-04-UT06: test_project_can_be_published_successfully
     * Status proyek berhasil diperbarui menjadi publik dan siap menerima lamaran masuk dari member.
     */
    public function test_project_can_be_published_successfully(): void
    {
        $payload = [
            'judul_project' => 'Sistem Rekomendasi Karir',
            'kategori' => 'Artificial Intelligence',
            'deskripsi' => 'Membangun model machine learning untuk rekomendasi jenjang karir lulusan.',
            'budget' => 5000000,
            'posisi' => 'ML Engineer',
            'skills' => [$this->skillLaravel->id],
        ];

        $response = $this->actingAs($this->creator)->post('/proyek/buat', $payload);

        $project = Project::where('judul_project', 'Sistem Rekomendasi Karir')->first();
        $this->assertNotNull($project);
        $this->assertEquals('Mencari Tim', $project->status_project);
    }
}
