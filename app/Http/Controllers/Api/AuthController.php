<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\CanResetPassword;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:member,creator',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'name.max'           => 'Nama maksimal 255 karakter.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email ini sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'role.required'      => 'Pilih peran akun Anda.',
            'role.in'            => 'Peran yang dipilih tidak valid.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role, // Menyimpan role 'member' atau 'creator' secara dinamis
        ]);

        // Hapus memori intended URL agar murni mengarah ke halaman login
        $request->session()->forget('url.intended');

        return redirect('/?role=' . $request->role . '#masuk')->with('success', 'Registrasi berhasil! Silakan masuk dengan akun Anda.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'      => 'required|email',
            'password'   => 'required',
            'login_role' => 'nullable|in:member,creator,admin',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Autentikasi kredensial email & password
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $requestedRole = $request->input('login_role', 'member');

            // Pengecekan kesesuaian role akun
            if ($requestedRole === 'admin') {
                if ($user->role !== 'admin') {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect('/?role=admin#masuk')
                        ->withErrors(['email' => 'Akun ini bukan akun Admin. Silakan pilih tab peran yang sesuai.'])
                        ->with('error', 'Akses ditolak: Akun ini bukan akun Administrator.')
                        ->withInput($request->only('email', 'login_role'));
                }
            } else {
                if ($user->role !== 'admin' && $user->role !== $requestedRole) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect('/?role=' . $requestedRole . '#masuk')
                        ->withErrors(['email' => 'Akun ini terdaftar sebagai ' . ucfirst($user->role) . '. Pilih jenis akun yang sesuai.'])
                        ->with('error', 'Pilihan jenis akun tidak sesuai dengan peran Anda.')
                        ->withInput($request->only('email', 'login_role'));
                }
            }

            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil! Selamat datang kembali.');
        }

        // Hapus intended URL agar tidak terjebak loop saat login gagal
        $request->session()->forget('url.intended');

        $requestedRole = $request->input('login_role', 'member');
        return redirect('/' . ($requestedRole ? '?role=' . $requestedRole : '') . '#masuk')
            ->withErrors(['email' => 'Email atau kata sandi yang Anda masukkan salah.'])
            ->with('error', 'Email atau kata sandi salah. Silakan coba lagi.')
            ->withInput($request->only('email', 'login_role'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/#masuk')->with('success', 'Anda telah berhasil keluar.');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        /** @var User|null $user */
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect('/#lupa-sandi')
                ->withErrors(['email' => 'Alamat email ini tidak terdaftar di sistem kami.'])
                ->withInput($request->only('email', 'is_forgot'));
        }

        // Generate token pemulihan kata sandi
        /** @var CanResetPassword $user */
        $token = Password::createToken($user);
        $resetUrl = route('password.reset', ['token' => $token, 'email' => $user->email]);

        // Kirim email notification jika mailer aktif
        try {
            $user->sendPasswordResetNotification($token);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email reset password: ' . $e->getMessage());
            if (config('mail.default') !== 'log') {
                return redirect('/#lupa-sandi')
                    ->withErrors(['email' => 'Gagal mengirim email via SMTP: ' . $e->getMessage()])
                    ->withInput($request->only('email', 'is_forgot'));
            }
        }

        return redirect('/#lupa-sandi')
            ->with('status', 'Tautan pemulihan kata sandi telah berhasil dikirim ke alamat email Anda!')
            ->with('reset_url', $resetUrl);
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
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'token.required'     => 'Token pemulihan kata sandi tidak valid.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'password.required'  => 'Kata sandi baru wajib diisi.',
            'password.min'       => 'Kata sandi minimal 8 karakter.',
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