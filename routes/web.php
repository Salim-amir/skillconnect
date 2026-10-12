<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Api\AuthController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/pengguna', function () {
    $users = \App\Models\User::all();
    return view('pengguna', compact('users'));
})->middleware('auth')->name('pengguna');

Route::get('/proyek', function () {
    return view('proyek');
})->middleware('auth')->name('proyek');

Route::get('/transaksi', function () {
    return view('transaksi');
})->middleware('auth')->name('transaksi');

Route::get('/laporan', function () {
    return view('laporan');
})->middleware('auth')->name('laporan');
