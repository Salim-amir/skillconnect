<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'],
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:member,creator',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'email.regex' => 'Pendaftaran hanya diperbolehkan menggunakan email @gmail.com.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'role.required' => 'Pilih peran akun Anda.',
            'role.in' => 'Peran yang dipilih tidak valid.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Menyimpan role 'member' atau 'creator' secara dinamis
        ]);

        // Buat tautan verifikasi email bertanda tangan (signed URL)
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())]
        );

        try {
            $user->sendEmailVerificationNotification();
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email verifikasi: '.$e->getMessage());
        }

        if ($request->expectsJson()) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Registrasi berhasil! Silakan verifikasi email @gmail.com Anda.',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 201);
        }

        // Hapus memori intended URL agar murni mengarah ke halaman login
        if ($request->hasSession()) {
            $request->session()->forget('url.intended');
        }

        $redirect = redirect('/?role='.$request->role.'#masuk')
            ->with('success', 'Registrasi berhasil! Tautan verifikasi telah dikirim ke email @gmail.com Anda. Silakan verifikasi sebelum masuk.');

        if (config('mail.default') === 'log') {
            $redirect->with('verification_url', $verificationUrl);
        }

        return $redirect;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'login_role' => 'nullable|in:member,creator,admin',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Autentikasi kredensial email & password
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($request->expectsJson()) {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'message' => 'Login berhasil',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                ], 200);
            }

            $requestedRole = $request->input('login_role', 'member');

            // Pengecekan kesesuaian role akun secara ketat (strict)
            if ($user->role !== $requestedRole) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $roleLabels = [
                    'admin'   => 'Administrator',
                    'creator' => 'Creator',
                    'member'  => 'Member',
                ];

                $actualRoleLabel = $roleLabels[$user->role] ?? ucfirst($user->role);

                if ($user->role === 'admin') {
                    $errorMessage = 'Akun ini adalah Administrator. Silakan gunakan tab Admin untuk masuk.';
                } else {
                    $errorMessage = 'Akun ini terdaftar sebagai ' . $actualRoleLabel . '. Silakan gunakan tab ' . $actualRoleLabel . ' untuk masuk.';
                }

                return redirect('/?role=' . $requestedRole . '#masuk')
                    ->withErrors(['email' => $errorMessage])
                    ->withInput($request->only('email', 'login_role'));
            }

            // Pastikan email sudah terverifikasi sebelum masuk
            if (!$user->hasVerifiedEmail()) {
                $unverifiedEmail = $user->email;
                $verificationUrl = URL::temporarySignedRoute(
                    'verification.verify',
                    now()->addMinutes(60),
                    ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())]
                );

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $redirect = redirect('/?role=' . $requestedRole . '#masuk')
                    ->withErrors(['email' => 'Email Anda belum diverifikasi. Silakan klik tautan verifikasi yang dikirim ke email @gmail.com Anda.'])
                    ->with('unverified_email', $unverifiedEmail)
                    ->withInput($request->only('email', 'login_role'));

                if (config('mail.default') === 'log') {
                    $redirect->with('verification_url', $verificationUrl);
                }

                return $redirect;
            }

            $request->session()->regenerate();

            return redirect()->intended('/dashboard')->with('success', 'Login berhasil! Selamat datang kembali.');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Email atau kata sandi yang Anda masukkan salah.',
            ], 401);
        }

        // Hapus intended URL agar tidak terjebak loop saat login gagal
        if ($request->hasSession()) {
            $request->session()->forget('url.intended');
        }

        $requestedRole = $request->input('login_role', 'member');

        return redirect('/'.($requestedRole ? '?role='.$requestedRole : '').'#masuk')
            ->withErrors(['email' => 'Email atau kata sandi yang Anda masukkan salah.'])
            ->withInput($request->only('email', 'login_role'));
    }

    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect('/#masuk')->withErrors(['email' => 'Tautan verifikasi email tidak valid atau sudah kedaluwarsa.']);
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect('/?role='.$user->role.'#masuk')
            ->with('success', 'Email Anda berhasil diverifikasi! Silakan masuk dengan akun Anda.');
    }

    public function resendVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect('/#masuk')->withErrors(['email' => 'Alamat email tidak ditemukan.']);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/?role='.$user->role.'#masuk')->with('success', 'Email Anda sudah terverifikasi. Silakan langsung masuk.');
        }

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())]
        );

        try {
            $user->sendEmailVerificationNotification();
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim ulang email verifikasi: '.$e->getMessage());
        }

        $redirect = redirect('/?role='.$user->role.'#masuk')
            ->with('success', 'Tautan verifikasi baru telah dikirim ke email Anda.');

        if (config('mail.default') === 'log') {
            $redirect->with('verification_url', $verificationUrl);
        }

        return $redirect;
    }

    public function logout(Request $request)
    {
        if ($request->user() && method_exists($request->user(), 'currentAccessToken') && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Anda telah berhasil keluar.',
            ], 200);
        }

        return redirect('/#masuk')->with('success', 'Anda telah berhasil keluar.');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        /** @var User|null $user */
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return redirect('/#lupa-sandi')
                ->withErrors(['email' => 'Alamat email ini tidak terdaftar di sistem kami.'])
                ->withInput($request->only('email', 'is_forgot'));
        }

        // Generate token pemulihan kata sandi
        try {
            /** @var CanResetPassword $user */
            $token = Password::createToken($user);
            $resetUrl = route('password.reset', ['token' => $token, 'email' => $user->email]);

            // Kirim email notification jika mailer aktif
            try {
                $user->sendPasswordResetNotification($token);
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim email reset password: '.$e->getMessage());
                // Jika mailer bukan log tapi gagal kirim SMTP, tetap tampilkan tautan darurat / pesan error yang jelas
                if (config('mail.default') !== 'log') {
                    return redirect('/#lupa-sandi')
                        ->withErrors(['email' => 'Gagal mengirim email verifikasi (SMTP error). Pastikan mailer server aktif: '.$e->getMessage()])
                        ->with('reset_url', $resetUrl)
                        ->withInput($request->only('email', 'is_forgot'));
                }
            }

            return redirect('/#lupa-sandi')
                ->with('status', 'Tautan pemulihan kata sandi telah berhasil dibuat!')
                ->with('reset_url', $resetUrl);
        } catch (\Throwable $e) {
            Log::error('Gagal memproses lupa sandi: '.$e->getMessage());

            return redirect('/#lupa-sandi')
                ->withErrors(['email' => 'Gagal memproses pemulihan kata sandi: '.$e->getMessage()])
                ->withInput($request->only('email', 'is_forgot'));
        }
    }

    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('shared.reset-password', [
            'token' => $token,
            'email' => $request->query('email', old('email')),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'token.required' => 'Token pemulihan kata sandi tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, string $password) {
                /** @var User $user */
                $user->forceFill([
                    'password' => Hash::make($password),
                ]);

                if (Schema::hasColumn('users', 'remember_token')) {
                    $user->setRememberToken(Str::random(60));
                }

                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect('/#masuk')->with('success', 'Kata sandi Anda berhasil diperbarui! Silakan masuk dengan kata sandi baru.');
        }

        return redirect()->back()
            ->withErrors(['email' => 'Tautan pemulihan kata sandi tidak valid atau telah kedaluwarsa.'])
            ->withInput($request->only('email'));
    }
}
