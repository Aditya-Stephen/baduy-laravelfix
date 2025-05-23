<?php

use App\Http\Controllers\ArticleController;
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

// Marketplace dengan produk dinamis
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace');

// Route About Us
Route::get('/aboutUs', function () {
    return view('aboutUs');
})->name('aboutUs');

// Artikel routes
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

// Auth routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/auth/submit', [AuthController::class, 'handleAuthSubmit'])->name('auth.submit');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('homepage');
})->name('logout');

// HAPUS semua route admin di luar middleware

// Admin routes - PERBAIKAN: Gunakan middleware auth saja dulu untuk debugging
Route::middleware(['auth'])->group(function () {
    // Admin dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // Product CRUD
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Carousel CRUD
    Route::post('/carousels', [CarouselController::class, 'store'])->name('carousels.store');
    Route::put('/carousels/{carousel}', [CarouselController::class, 'update'])->name('carousels.update');
    Route::delete('/carousels/{carousel}', [CarouselController::class, 'destroy'])->name('carousels.destroy');
});

// CATATAN: Setelah route /admin bisa diakses, baru aktifkan middleware admin