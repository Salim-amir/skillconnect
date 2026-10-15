<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\User\ProfileSkillController;
use App\Http\Controllers\User\ProyekController;
use App\Models\User;
use App\Models\Project;

// ===================== PUBLIC ROUTES =====================

Route::get('/', function () {
    return view('shared.welcome');
});

// OAuth Google SSO
Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

// Auth Manual
Route::get('/login', function () {
    return view('shared.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('shared.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ===================== SHARED AUTH ROUTES =====================

Route::middleware('auth')->group(function () {

    // Dashboard Sentral: Otomatis membagi tampilan Admin / User
    Route::get('/dashboard', function () {
        $currentUser = auth()->user();

        // Pengecekan otomatis role admin
        if (strtolower($currentUser->name) === 'admin' || str_contains(strtolower($currentUser->email), 'admin')) {
            if ($currentUser->role !== 'admin') {
                User::where('id', $currentUser->id)->update(['role' => 'admin']);
                $currentUser->role = 'admin';
            }
        }

        // Jika Admin -> Tampilkan Admin Dashboard
        if ($currentUser->role === 'admin') {
            $totalUsers     = User::count();
            $totalProjects  = Project::count();
            $totalCompleted = Project::where('status_project', 'Selesai')->count();
            $latestUsers    = User::latest()->take(5)->get();
            return view('admin.dashboard', compact('totalUsers', 'totalProjects', 'totalCompleted', 'latestUsers'));
        }

        // Jika User Biasa -> Tampilkan User Dashboard (user/dashboard.blade.php)
        return view('user.dashboard');
    })->name('dashboard');

});


// ===================== ADMIN ROUTES =====================

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/pengguna', function () {
        $users = User::all();
        return view('admin.pengguna', compact('users'));
    })->name('pengguna');

    Route::post('/pengguna',            [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{id}',        [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}',     [PenggunaController::class, 'destroy'])->name('pengguna.destroy');

    Route::get('/transaksi', function () {
        return view('admin.transaksi');
    })->name('transaksi');

    Route::get('/laporan', function () {
        return view('admin.laporan');
    })->name('laporan');

});


// ===================== USER ROUTES =====================

Route::middleware('auth')->group(function () {

    // Kelola Profile & Skill
    Route::get('/profile-skill',                            [ProfileSkillController::class, 'index'])->name('profile.skill');
    Route::post('/profile-skill',                           [ProfileSkillController::class, 'update'])->name('profile.skill.update');
    Route::post('/profile-skill/add-skill',                 [ProfileSkillController::class, 'addSkill'])->name('profile.skill.add');
    Route::delete('/profile-skill/remove-skill/{skillId}',  [ProfileSkillController::class, 'removeSkill'])->name('profile.skill.remove');

    // Proyek & Kandidat
    Route::get('/proyek',                                   [ProyekController::class, 'index'])->name('proyek');
    Route::get('/proyek/buat',                              [ProyekController::class, 'create'])->name('proyek.create');
    Route::post('/proyek/buat',                             [ProyekController::class, 'store'])->name('proyek.store');
    Route::get('/proyek/riwayat',                           [ProyekController::class, 'riwayat'])->name('proyek.riwayat');
    Route::get('/proyek/{id}',                              [ProyekController::class, 'show'])->name('proyek.detail');
    Route::post('/proyek/{id}/apply',                       [ProyekController::class, 'apply'])->name('proyek.apply');
    Route::post('/proyek/{id}/kandidat/{applicationId}',    [ProyekController::class, 'updateCandidateStatus'])->name('proyek.kandidat.status');

});