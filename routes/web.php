<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use App\Http\Controllers\PenggunaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\ProfileSkillController;
use App\Http\Controllers\ProyekUserController;

Route::get('/dashboard', function () {
    // Pastikan user dengan nama atau email 'admin' otomatis mendapatkan role 'admin'
    if (auth()->check()) {
        $currentUser = auth()->user();
        if (strtolower($currentUser->name) === 'admin' || str_contains(strtolower($currentUser->email), 'admin')) {
            if ($currentUser->role !== 'admin') {
                \App\Models\User::where('id', $currentUser->id)->update(['role' => 'admin']);
                $currentUser->role = 'admin';
            }
        }
    }

    $totalUsers = User::count();
    return view('dashboard', compact('totalUsers'));
})->middleware('auth')->name('dashboard');

// AD-02: Kelola Profile & Skill
Route::middleware('auth')->group(function () {
    Route::get('/profile-skill', [ProfileSkillController::class, 'index'])->name('profile.skill');
    Route::post('/profile-skill', [ProfileSkillController::class, 'update'])->name('profile.skill.update');
    Route::post('/profile-skill/add-skill', [ProfileSkillController::class, 'addSkill'])->name('profile.skill.add');
    Route::delete('/profile-skill/remove-skill/{skillId}', [ProfileSkillController::class, 'removeSkill'])->name('profile.skill.remove');
});

// AD-03, AD-04, AD-06, AD-07: Proyek & Kandidat & Riwayat
Route::middleware('auth')->group(function () {
    Route::get('/proyek', [ProyekUserController::class, 'index'])->name('proyek');
    Route::get('/proyek/buat', [ProyekUserController::class, 'create'])->name('proyek.create');
    Route::post('/proyek/buat', [ProyekUserController::class, 'store'])->name('proyek.store');
    Route::get('/proyek/riwayat', [ProyekUserController::class, 'riwayat'])->name('proyek.riwayat');
    Route::get('/proyek/{id}', [ProyekUserController::class, 'show'])->name('proyek.detail');
    Route::post('/proyek/{id}/apply', [ProyekUserController::class, 'apply'])->name('proyek.apply');
    Route::post('/proyek/{id}/kandidat/{applicationId}', [ProyekUserController::class, 'updateCandidateStatus'])->name('proyek.kandidat.status');
});

Route::get('/pengguna', function () {
    $users = User::all();
    return view('pengguna', compact('users'));
})->middleware('auth')->name('pengguna');

Route::post('/pengguna', [PenggunaController::class, 'store'])
    ->middleware('auth')->name('pengguna.store');

Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])
    ->middleware('auth')->name('pengguna.update');

Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])
    ->middleware('auth')->name('pengguna.destroy');

Route::get('/transaksi', function () {
    return view('transaksi');
})->middleware('auth')->name('transaksi');

Route::get('/laporan', function () {
    return view('laporan');
})->middleware('auth')->name('laporan');

