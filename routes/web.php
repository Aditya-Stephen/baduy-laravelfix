<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
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

// Route login dan register untuk guest
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/auth/submit', [AuthController::class, 'handleAuthSubmit'])->name('auth.submit');
});

// Route logout untuk user yang sudah login
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('homepage');
})->name('logout');

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

