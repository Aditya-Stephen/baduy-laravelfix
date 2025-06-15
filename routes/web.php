<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LogoutConfirmationController;

// Route untuk guest (tidak perlu login)
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace');
Route::get('/aboutUs', function () {
    return view('aboutUs');
})->name('aboutUs');

// Artikel routes untuk guest
Route::controller(ArticleController::class)->group(function () {
    Route::get('/artikel', 'index')->name('artikel'); // Daftar artikel
    Route::get('/artikel/{id}', 'show')->name('artikel.show'); // Menampilkan detail artikel
});

// Route login dan register dengan middleware guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

// Route untuk konfirmasi logout
Route::middleware('auth')->group(function () {
    Route::get('/auth/confirm-logout', [LogoutConfirmationController::class, 'show'])->name('auth.confirm-logout');
    Route::post('/auth/confirm-logout', [LogoutConfirmationController::class, 'confirm'])->name('auth.confirm-logout.submit');
    Route::post('/auth/cancel-logout', [LogoutConfirmationController::class, 'cancel'])->name('auth.confirm-logout.cancel');
    
    // Route logout - TAMBAH INI
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Routes yang memerlukan login (user biasa)
Route::middleware(['auth'])->group(function () {
    // Artikel routes
    Route::get('/artikel/create', [ArticleController::class, 'create'])->name('artikel.create');
    Route::post('/artikel', [ArticleController::class, 'store'])->name('artikel.store');

    // Edit Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Routes untuk Admin dan Superadmin
Route::middleware(['auth', 'CheckRole:admin,superadmin'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Article management
    Route::post('/articles/{id}/approve', [AdminController::class, 'approveArticle'])->name('admin.articles.approve');
    Route::post('/articles/{id}/reject', [AdminController::class, 'rejectArticle'])->name('admin.articles.reject');
    Route::get('/articles/{id}/preview', [ArticleController::class, 'adminPreview'])->name('admin.articles.preview');

    // Product CRUD
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Carousel CRUD
    Route::post('/carousels', [CarouselController::class, 'store'])->name('carousels.store');
    Route::put('/carousels/{carousel}', [CarouselController::class, 'update'])->name('carousels.update');
    Route::delete('/carousels/{carousel}', [CarouselController::class, 'destroy'])->name('carousels.destroy');
});

// Routes khusus untuk Superadmin
Route::middleware(['auth', 'CheckRole:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    
    // User management
    Route::post('/promote', [SuperAdminController::class, 'promoteToAdmin'])->name('superadmin.promote');
    Route::post('/demote', [SuperAdminController::class, 'demoteAdmin'])->name('superadmin.demote');
    Route::delete('/users/{id}', [SuperAdminController::class, 'deleteUser'])->name('superadmin.users.delete');
    
    // Update user role
    Route::put('/roles/{user}', [RoleController::class, 'update'])->name('roles.update');
    Route::post('/roles/promote', [RoleController::class, 'promoteToAdmin'])->name('roles.promote');

});

