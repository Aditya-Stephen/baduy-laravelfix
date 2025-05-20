<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarketplaceController;

// Halaman utama dengan data carousel dinamis
Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Marketplace dengan produk dinamis - pindah ke luar middleware agar bisa diakses publik
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace');

// Route About Us - pindah ke luar middleware agar bisa diakses publik
Route::get('/aboutUs', function () {
    return view('aboutUs');
})->name('aboutUs');

// Artikel routes - pindah ke luar middleware agar bisa diakses publik
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

// Routing untuk halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

// Routing untuk halaman registrasi
Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

// Rute submit form login/register
Route::post('/auth/submit', [AuthController::class, 'handleAuthSubmit'])->name('auth.submit');

// Rute logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('homepage');
})->name('logout');

// Admin routes dengan middleware auth dan admin
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Product CRUD
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Carousel CRUD
    Route::post('/carousels', [CarouselController::class, 'store'])->name('carousels.store');
    Route::put('/carousels/{carousel}', [CarouselController::class, 'update'])->name('carousels.update');
    Route::delete('/carousels/{carousel}', [CarouselController::class, 'destroy'])->name('carousels.destroy');
});