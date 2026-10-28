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
        $requestedRole = $request->query('role', 'member');
        if (!in_array($requestedRole, ['member', 'creator'])) {
            $requestedRole = 'member';
        }
        session(['google_login_role' => $requestedRole]);

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            // PERBAIKAN: Gunakan Guzzle client tanpa merusak instansiasi driver, 
            // atau jika masih bermasalah di lokal gunakan ->stateless()
            $googleUser = Socialite::driver('google')
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
                ->stateless() // Menghindari InvalidStateException akibat Mismatch State di Localhost
                ->user();

            // Ambil role yang disimpan saat redirect tadi (default: member)
            $targetRole = session('google_login_role', 'member');
            if (!in_array($targetRole, ['member', 'creator'])) {
                $targetRole = 'member';
            }
            session()->forget('google_login_role');

            // Cari berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if (!$user) {
                // Prioritaskan admin jika email/nama mengandung 'admin'
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

                // Validasi role pengguna lama (Admin dikecualikan)
                if ($user->role !== 'admin' && $user->role !== $targetRole) {
                    $roleLabel = ucfirst($user->role);
                    return redirect()->route('login')
                        ->withErrors(['email' => 'Akun Google ini terdaftar sebagai ' . $roleLabel . '. Silakan pilih jenis akun ' . $roleLabel . '.'])
                        ->with('error', 'Akun Google ini terdaftar sebagai ' . $roleLabel . '. Silakan pilih jenis akun yang sesuai.');
                }
            }

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Berhasil masuk dengan akun Google!');

        } catch (\Exception $e) {
            // PERBAIKAN: Kembalikan ke route('login') agar alert error Blade ter-render sempurna
            return redirect()->route('login')
                ->withErrors(['email' => 'Gagal masuk menggunakan Google. Err: ' . $e->getMessage()])
                ->with('error', 'Gagal masuk menggunakan Google: ' . $e->getMessage());
        }
    }
}