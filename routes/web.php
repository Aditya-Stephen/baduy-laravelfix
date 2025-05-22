<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;

// Halaman utama (Homepage) - dapat diakses tanpa login
Route::get('/', function () {
    return view('profile.homepage');
})->name('profile.homepage');

// Middleware untuk halaman yang membutuhkan login
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

// Routing Artikel
Route::controller(ArticleController::class)->group(function () {
    // Menampilkan daftar artikel
    Route::get('/artikel', 'index')->name('profile.artikel');
    
    // Menampilkan form tambah artikel
    Route::get('/artikel/create', 'create')->name('artikel.create');
    
    // Menyimpan artikel baru
    Route::post('/artikel', 'store')->name('artikel.store');
    
    // Menampilkan detail artikel
    Route::get('/artikel/{id}', 'show')->name('artikel.show');
});


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