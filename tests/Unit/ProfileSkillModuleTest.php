<?php

namespace Tests\Unit;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileSkillModuleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * MOD-02-UT01: test_member_can_access_their_profile_page
     * Endpoint GET profil merespons HTTP 200 dan mengembalikan data biodata pengguna yang sedang login.
     */
    public function test_member_can_access_their_profile_page(): void
    {
        $member = User::create([
            'name' => 'Member Test',
            'email' => 'member@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
            'pengalaman' => 'Pengalaman Laravel 2 Tahun',
            'portofolio' => 'https://github.com/membertest',
            'cv_path' => 'https://drive.google.com/cv-member',
        ]);

        $response = $this->actingAs($member)->get('/profile-skill');

        $response->assertStatus(200);
        $response->assertViewHas('user');
        $this->assertEquals($member->id, $response->viewData('user')->id);
    }

    /**
     * MOD-02-UT02: test_member_can_store_initial_profile_data
     * Sistem berhasil menyimpan data input profil baru (pengalaman & portofolio) ke dalam tabel users.
     */
    public function test_member_can_store_initial_profile_data(): void
    {
        $member = User::create([
            'name' => 'New Member',
            'email' => 'newmember@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $payload = [
            'name' => 'New Member Updated',
            'cv_link' => 'https://drive.google.com/new-member-cv',
            'portofolio' => 'https://portfolio.test/newmember',
        ];

        $response = $this->actingAs($member)->post('/profile-skill', $payload);

        $response->assertRedirect('/profile-skill');
        $this->assertDatabaseHas('users', [
            'id' => $member->id,
            'name' => 'New Member Updated',
            'cv_path' => 'https://drive.google.com/new-member-cv',
            'portofolio' => 'https://portfolio.test/newmember',
        ]);
    }

    /**
     * MOD-02-UT03: test_member_can_update_existing_profile_data
     * Data profil pengguna yang sudah ada berhasil diperbarui (update) dengan payload data valid.
     */
    public function test_member_can_update_existing_profile_data(): void
    {
        $member = User::create([
            'name' => 'Existing Member',
            'email' => 'existing@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
            'portofolio' => 'https://old-portfolio.test',
            'cv_path' => 'https://old-cv.test',
        ]);

        $payload = [
            'name' => 'Renamed Member',
            'cv_link' => 'https://drive.google.com/updated-cv',
            'portofolio' => 'https://new-portfolio.test',
        ];

        $response = $this->actingAs($member)->post('/profile-skill', $payload);

        $response->assertRedirect('/profile-skill');
        $this->assertDatabaseHas('users', [
            'id' => $member->id,
            'name' => 'Renamed Member',
            'portofolio' => 'https://new-portfolio.test',
            'cv_path' => 'https://drive.google.com/updated-cv',
        ]);
    }

    /**
     * MOD-02-UT04: test_profile_update_fails_when_required_fields_empty
     * Validasi backend menolak penyimpanan jika kolom atribut profil wajib dikosongkan (HTTP 422).
     */
    public function test_profile_update_fails_when_required_fields_empty(): void
    {
        $member = User::create([
            'name' => 'Empty Test Member',
            'email' => 'empty@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $response = $this->actingAs($member)->postJson('/profile-skill', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'cv_link']);
    }

    /**
     * MOD-02-UT05: test_system_displays_master_skills_catalog
     * Endpoint master skill berhasil menampilkan daftar katalog keahlian baku dari tabel skills.
     */
    public function test_system_displays_master_skills_catalog(): void
    {
        $member = User::create([
            'name' => 'Skill Explorer',
            'email' => 'explorer@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        Skill::firstOrCreate(['nama_skill' => 'Laravel']);
        Skill::firstOrCreate(['nama_skill' => 'React']);
        Skill::firstOrCreate(['nama_skill' => 'MySQL']);

        $response = $this->actingAs($member)->get('/profile-skill');

        $response->assertStatus(200);
        $response->assertViewHas('masterSkills');
        $skills = $response->viewData('masterSkills');
        $this->assertTrue($skills->pluck('nama_skill')->contains('Laravel'));
        $this->assertTrue($skills->pluck('nama_skill')->contains('React'));
        $this->assertTrue($skills->pluck('nama_skill')->contains('MySQL'));
    }

    /**
     * MOD-02-UT06: test_member_can_attach_skill_from_master_list
     * Pengguna dapat memilih dan menghubungkan skill ke profil melalui tabel pivot user_skills.
     */
    public function test_member_can_attach_skill_from_master_list(): void
    {
        $member = User::create([
            'name' => 'Skill Attacher',
            'email' => 'attacher@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $skill = Skill::create(['nama_skill' => 'Flutter']);

        $response = $this->actingAs($member)->post('/profile-skill/add-skill', [
            'skill_id' => $skill->id,
            'tingkat_keahlian' => 'Intermediate',
        ]);

        $response->assertRedirect('/profile-skill');
        $this->assertDatabaseHas('user_skill', [
            'user_id' => $member->id,
            'skill_id' => $skill->id,
            'tingkat_keahlian' => 'Intermediate',
        ]);
    }

    /**
     * MOD-02-UT07: test_member_can_set_skill_proficiency_level
     * Sistem sukses mencatat dan memperbarui tingkat keahlian (tingkat_keahlian) pada skill pengguna.
     */
    public function test_member_can_set_skill_proficiency_level(): void
    {
        $member = User::create([
            'name' => 'Proficiency Member',
            'email' => 'proficiency@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $skill = Skill::create(['nama_skill' => 'Vue.js']);
        $member->skills()->attach($skill->id, ['tingkat_keahlian' => 'Beginner']);

        // Update tingkat keahlian to Advanced
        $response = $this->actingAs($member)->post('/profile-skill/add-skill', [
            'skill_id' => $skill->id,
            'tingkat_keahlian' => 'Advanced',
        ]);

        $response->assertRedirect('/profile-skill');
        $this->assertDatabaseHas('user_skill', [
            'user_id' => $member->id,
            'skill_id' => $skill->id,
            'tingkat_keahlian' => 'Advanced',
        ]);
    }

    /**
     * MOD-02-UT08: test_member_can_detach_skill_from_profile
     * Record skill spesifik berhasil dihapus dari inventaris profil pengguna melalui relasi detach.
     */
    public function test_member_can_detach_skill_from_profile(): void
    {
        $member = User::create([
            'name' => 'Detacher Member',
            'email' => 'detach@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $skill = Skill::create(['nama_skill' => 'Docker']);
        $member->skills()->attach($skill->id, ['tingkat_keahlian' => 'Intermediate']);

        $this->assertDatabaseHas('user_skill', [
            'user_id' => $member->id,
            'skill_id' => $skill->id,
        ]);

        $response = $this->actingAs($member)->delete('/profile-skill/remove-skill/'.$skill->id);

        $response->assertRedirect('/profile-skill');
        $this->assertDatabaseMissing('user_skill', [
            'user_id' => $member->id,
            'skill_id' => $skill->id,
        ]);
    }

    /**
     * MOD-02-UT09: test_system_only_accepts_valid_master_skill_references
     * Validasi menolak penambahan skill kustom di luar ID master skill yang terdaftar di database.
     */
    public function test_system_only_accepts_valid_master_skill_references(): void
    {
        $member = User::create([
            'name' => 'Invalid Skill Test',
            'email' => 'invalids@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $response = $this->actingAs($member)->postJson('/profile-skill/add-skill', [
            'skill_id' => 999999, // ID non-existent
            'tingkat_keahlian' => 'Intermediate',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['skill_id']);
    }
}
