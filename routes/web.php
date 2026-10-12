<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use App\Http\Controllers\PenggunaController;


Route::get('/', function () {
    return view('welcome');
});

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
    $totalUsers = User::count();
    return view('dashboard', compact('totalUsers'));
})->middleware('auth')->name('dashboard');

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




Route::get('/proyek', function () {
    return view('proyek');
})->middleware('auth')->name('proyek');

Route::get('/transaksi', function () {
    return view('transaksi');
})->middleware('auth')->name('transaksi');

Route::get('/laporan', function () {
    return view('laporan');
})->middleware('auth')->name('laporan');
