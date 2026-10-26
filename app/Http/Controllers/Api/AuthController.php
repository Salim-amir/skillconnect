<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan masuk dengan akun Anda.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'      => 'required|email',
            'password'   => 'required',
            'login_role' => 'nullable|in:member,creator',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Autentikasi kredensial email & password
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $requestedRole = $request->input('login_role', 'member');

            // Pengecekan kesesuaian role akun (Admin dikecualikan)
            if ($user->role !== 'admin' && $user->role !== $requestedRole) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->withErrors(['email' => 'Akun ini terdaftar sebagai ' . ucfirst($user->role) . '. Pilih jenis akun yang sesuai.'])
                    ->with('error', 'Pilihan jenis akun tidak sesuai dengan peran Anda.')
                    ->withInput($request->only('email', 'login_role'));
            }

            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil! Selamat datang kembali.');
        }

        // Hapus intended URL agar tidak terjebak loop saat login gagal
        $request->session()->forget('url.intended');

        return redirect()->route('login')
            ->withErrors(['email' => 'Email atau kata sandi yang Anda masukkan salah.'])
            ->with('error', 'Email atau kata sandi salah. Silakan coba lagi.')
            ->withInput($request->only('email', 'login_role'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}