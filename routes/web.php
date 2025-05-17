<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;

// Halaman utama (Homepage) - dapat diakses tanpa login
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

// Middleware untuk halaman yang membutuhkan login
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Routing ke halaman artikel
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel'); // Menampilkan daftar artikel
    Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show'); // Menampilkan detail artikel

    // Routing ke halaman produk (Marketplace)
    Route::get('/marketplace', function () {
        return view('marketplace');
    })->name('marketplace');

    // Routing ke halaman About Us
    Route::get('/aboutUs', function () {
        return view('aboutUs');
    })->name('aboutUs');
});

// Routing untuk halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

// Routing untuk halaman registrasi
Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

// Rute logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('homepage');
})->name('logout');