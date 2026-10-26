<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        // Tangkap parameter 'role' dari URL (?role=member atau ?role=creator) dan simpan di session
        $requestedRole = $request->query('role', 'member');
        session(['google_login_role' => $requestedRole]);

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
            $driver = Socialite::driver('google');

            // Set SSL verify false tanpa triggering warning di VS Code
            $driver->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));

            $googleUser = $driver->user();

            // Ambil role yang disimpan saat redirect tadi (default: member)
            $targetRole = session('google_login_role', 'member');
            session()->forget('google_login_role');

            // Cari berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if (!$user) {
                // Tentukan role: prioritaskan admin jika email/nama mengandung 'admin', jika tidak gunakan targetRole pilihan user
                $role = (strtolower($googleUser->getName()) === 'admin' || str_contains(strtolower($googleUser->getEmail()), 'admin')) 
                    ? 'admin' 
                    : $targetRole;

                $user = User::create([
                    'name'      => $googleUser->getName(),
                    'email'     => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'role'      => $role,
                    'password'  => Hash::make(Str::random(16)),
                ]);
            } else {
                // Tautkan google_id jika user mendaftar lewat manual sebelumnya
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }

                // Validasi role pengguna lama: cegah jika mencoba masuk memilih role yang berbeda (kecuali Admin)
                if ($user->role !== 'admin' && $user->role !== $targetRole) {
                    return redirect()->route('login')
                        ->withErrors(['email' => 'Akun Google ini terdaftar sebagai ' . ucfirst($user->role) . '. Silakan pilih jenis akun yang sesuai.'])
                        ->with('error', 'Pilihan jenis akun tidak sesuai dengan peran Anda.');
                }
            }

            Auth::login($user);
            $request->session()->regenerate();

            // Redirect ke route 'dashboard'
            return redirect()->route('dashboard')->with('success', 'Berhasil masuk dengan akun Google!');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Gagal masuk menggunakan Google. Silakan coba lagi.'])
                ->with('error', 'Gagal masuk menggunakan Google. Silakan coba lagi.');
        }
    }
}