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
    public function redirectToGoogle()
    {
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

            // Cari berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if (!$user) {
                // Tentukan role default (member)
                $role = (strtolower($googleUser->getName()) === 'admin' || str_contains(strtolower($googleUser->getEmail()), 'admin')) 
                    ? 'admin' 
                    : 'member';

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