<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\User\ProfileSkillController;
use App\Http\Controllers\User\ProyekController;
use App\Models\User;
use App\Models\Project;
use App\Models\Transaction;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\User\TaskController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\DashboardController;

// ===================== PUBLIC / GUEST ROUTES =====================

Route::get('/', function () {
    return view('shared.welcome');
})->name('welcome');

// Halaman Form Login Khusus
Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    // Hapus memori intended URL agar tidak looping saat login gagal
    session()->forget('url.intended');
    session()->reflash();
    $role = request('role');
    return redirect('/' . ($role ? '?role=' . $role : '') . '#masuk');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Halaman Register
Route::get('/register', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    session()->forget('url.intended');
    session()->reflash();
    $role = request('role');
    return redirect('/' . ($role ? '?role=' . $role : '') . '#daftar');
})->name('register');

// Proses POST register diarahkan ke AuthController::register
Route::post('/register', [AuthController::class, 'register']);

// OAuth Google SSO (Mendukung query parameter ?role=member atau ?role=creator)
Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===================== PASSWORD RESET ROUTES =====================
Route::get('/forgot-password', function () {
    return redirect('/#lupa-sandi');
})->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password', function (\Illuminate\Http\Request $request) {
    if ($request->filled('token')) {
        return redirect()->route('password.reset', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }
    return redirect()->route('password.request');
});

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


// ===================== SHARED AUTH ROUTES =====================

Route::middleware('auth')->group(function () {

    // Dashboard Sentral: Otomatis membagi tampilan Admin / Creator / Member
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});


// ===================== ADMIN ROUTES =====================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/pengguna', function () {
        $users = User::all();
        return view('admin.pengguna', compact('users'));
    })->name('pengguna');

    Route::post('/pengguna',            [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{id}',        [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}',     [PenggunaController::class, 'destroy'])->name('pengguna.destroy');

    Route::get('/proyek', function () {
        $projects = Project::with('creator')->latest()->get();
        $totalProjects   = $projects->count();
        $mencariTim      = $projects->where('status_project', 'Mencari Tim')->count();
        $berjalan        = $projects->where('status_project', 'Berjalan')->count();
        $selesai         = $projects->where('status_project', 'Selesai')->count();
        return view('admin.proyek', compact('projects', 'totalProjects', 'mencariTim', 'berjalan', 'selesai'));
    })->name('proyek');

    Route::get('/transaksi', function () {
        $transactions = Transaction::with(['project', 'user'])->latest()->get();
        return view('admin.transaksi', compact('transactions'));
    })->name('transaksi');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

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

    // MOD-08: Task Board & Upload Bukti Kerja
    Route::get('/proyek/{id}/tasks',                        [TaskController::class, 'index'])->name('proyek.tasks');
    Route::post('/proyek/{id}/tasks',                       [TaskController::class, 'store'])->name('proyek.tasks.store');
    Route::put('/proyek/{id}/tasks/{taskId}/status',        [TaskController::class, 'updateStatus'])->name('proyek.tasks.status');
    Route::post('/proyek/{id}/tasks/{taskId}/bukti',        [TaskController::class, 'uploadBukti'])->name('proyek.tasks.bukti');
    Route::post('/proyek/{id}/tasks/{taskId}/revisi',       [TaskController::class, 'addRevision'])->name('proyek.tasks.revisi');

    // MOD-09: Evaluasi Anggota Tim oleh Creator
    Route::post('/proyek/{id}/evaluasi/{memberId}',         [TaskController::class, 'evaluateMember'])->name('proyek.evaluasi');

    // Integrasi Pembayaran Dana Proyek via Midtrans
    Route::post('/proyek/{id}/bayar',                       [PaymentController::class, 'initiate'])->name('proyek.bayar');
    Route::get('/proyek/{id}/bayar/status',                 [PaymentController::class, 'checkStatus'])->name('proyek.bayar.status');

});

// Webhook Midtrans (HTTP Notification dari server Midtrans)
Route::post('/midtrans/callback', [PaymentController::class, 'webhook'])->name('midtrans.webhook');

// Fallback penyajian file bukti kerja (jika storage:link belum dibuat di sistem operasi Windows)
Route::get('/storage/bukti-kerja/{filename}', function ($filename) {
    $path = storage_path('app/public/bukti-kerja/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('storage.bukti');
