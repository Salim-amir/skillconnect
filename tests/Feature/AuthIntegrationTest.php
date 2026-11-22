<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * MOD-01-UT01: test_user_can_register_with_valid_data
     * Data pengguna baru berhasil disimpan ke tabel users dengan enkripsi password yang valid.
     */
    public function test_user_can_register_with_valid_data(): void
    {
        $payload = [
            'name' => 'Salim Amir',
            'email' => 'salim@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'member',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'salim@example.com',
            'name' => 'Salim Amir',
            'role' => 'member',
        ]);

        $user = User::where('email', 'salim@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    /**
     * MOD-01-UT02: test_registration_fails_with_duplicate_email
     * Sistem menolak pendaftaran jika email sudah terdaftar di database (unique validation).
     */
    public function test_registration_fails_with_duplicate_email(): void
    {
        User::create([
            'name' => 'Existing User',
            'email' => 'duplicate@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $payload = [
            'name' => 'Another User',
            'email' => 'duplicate@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'member',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    /**
     * MOD-01-UT03: test_registration_fails_when_required_fields_empty
     * Validasi backend menolak request pendaftaran jika kolom wajib kosong (HTTP 422).
     */
    public function test_registration_fails_when_required_fields_empty(): void
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'password', 'role']);
    }

    /**
     * MOD-01-UT04: test_registration_fails_with_invalid_email_format
     * Validasi backend menolak string email yang tidak sesuai format standar RFC.
     */
    public function test_registration_fails_with_invalid_email_format(): void
    {
        $payload = [
            'name' => 'Invalid Email User',
            'email' => 'bukan-format-email-valid',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'member',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    /**
     * MOD-01-UT05: test_registration_fails_on_password_mismatch
     * Pendaftaran digagalkan jika nilai konfirmasi password tidak identik dengan password utama.
     */
    public function test_registration_fails_on_password_mismatch(): void
    {
        $payload = [
            'name' => 'Mismatch Password User',
            'email' => 'mismatch@example.com',
            'password' => 'password123',
            'password_confirmation' => 'bedapassword',
            'role' => 'member',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
    }

    /**
     * MOD-01-UT06: test_user_can_login_with_valid_credentials
     * Pengguna dengan data valid sukses login, menerima token Sanctum, dan status HTTP 200.
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::create([
            'name' => 'Valid Member',
            'email' => 'valid@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'valid@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'access_token',
            'token_type',
            'user',
        ]);
        $this->assertNotEmpty($response->json('access_token'));
    }

    /**
     * MOD-01-UT07: test_login_fails_with_incorrect_password
     * Kombinasi email terdaftar dengan password salah ditolak sistem dengan status HTTP 401.
     */
    public function test_login_fails_with_incorrect_password(): void
    {
        User::create([
            'name' => 'Valid User',
            'email' => 'user@example.com',
            'password' => Hash::make('correctpassword'),
            'role' => 'member',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'user@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
    }

    /**
     * MOD-01-UT08: test_login_fails_with_unregistered_email
     * Sistem menolak proses login apabila email belum terdaftar di dalam database.
     */
    public function test_login_fails_with_unregistered_email(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'tidakada@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(401);
    }

    /**
     * MOD-01-UT09: test_login_fails_when_input_fields_are_empty
     * Backend menolak pengiriman form login kosong dengan pesan error validasi kolom wajib.
     */
    public function test_login_fails_when_input_fields_are_empty(): void
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'password']);
    }

    /**
     * MOD-01-UT10: test_guest_cannot_access_protected_dashboard_routes
     * Middleware keamanan memblokir akses tamu/pengguna belum login ke rute privat (HTTP 401/302).
     */
    public function test_guest_cannot_access_protected_dashboard_routes(): void
    {
        $webResponse = $this->get('/dashboard');
        $webResponse->assertRedirect('/login');

        $apiResponse = $this->getJson('/api/user');
        $apiResponse->assertStatus(401);
    }

    /**
     * MOD-01-UT11: test_authenticated_user_can_logout_successfully
     * Endpoint logout berhasil mencabut dan menghapus token akses aktif dari tabel token.
     */
    public function test_authenticated_user_can_logout_successfully(): void
    {
        $user = User::create([
            'name' => 'Logged In User',
            'email' => 'logout@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/logout');

        $response->assertStatus(200);
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
        ]);
    }

    /**
     * MOD-01-UT12: test_logged_out_user_cannot_re_access_dashboard
     * Sesi token yang telah dicabut gagal digunakan untuk mengakses kembali rute dasbor privat.
     */
    public function test_logged_out_user_cannot_re_access_dashboard(): void
    {
        $user = User::create([
            'name' => 'Revoked User',
            'email' => 'revoked@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $token = $user->createToken('test-token')->plainTextToken;

        // Logout
        $this->withHeader('Authorization', 'Bearer '.$token)->postJson('/api/logout');

        app('auth')->forgetGuards();

        // Re-access protected endpoint
        $response = $this->withHeader('Authorization', 'Bearer '.$token)->getJson('/api/user');
        $response->assertStatus(401);
    }
}
