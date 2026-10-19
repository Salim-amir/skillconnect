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
    /**
     * Redirect pengguna ke halaman autentikasi Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Tangani callback dari Google SSO
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
            $driver = Socialite::driver('google');

            // Bypass SSL verify (khusus lingkungan lokal/dev)
            $driver->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));

            $googleUser = $driver->user();

            // Cari pengguna berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if (!$user) {
                // Tentukan role default
                $role = (strtolower($googleUser->getName()) === 'admin' || str_contains(strtolower($googleUser->getEmail()), 'admin')) 
                    ? 'admin' 
                    : 'user';

                $user = User::create([
                    'name'      => $googleUser->getName(),
                    'email'     => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'role'      => $role,
                    'password'  => Hash::make(Str::random(16)),
                ]);
            } else {
                // Tautkan google_id jika sebelumnya daftar manual via email
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
            }

            // Login-kan user & perbarui session
            Auth::login($user);
            $request->session()->regenerate();

            // Direct ke rute dashboard
            return redirect()->intended(route('dashboard'))->with('success', 'Berhasil masuk menggunakan Google!');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal masuk menggunakan Google.');
        }
    }
}