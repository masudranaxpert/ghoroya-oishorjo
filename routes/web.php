<?php

use Illuminate\Support\Facades\Route;
use App\Auth\Controllers\AdminAuthController;
use App\Auth\Controllers\AdminCategoryController;
use App\Auth\Controllers\AdminProductController;
use App\Auth\Controllers\CustomerAuthController;

// Homepage redirect
Route::get('/', function () {
    return redirect()->route('customer.login');
});

// Admin Authentication Routes (Hidden URL)
Route::prefix('adminpanel')->name('admin.')->group(function () {
    // Guest routes (login, register)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/', [AdminAuthController::class, 'login']); // POST to same URL
        Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AdminAuthController::class, 'register']);
    });
    
    // Protected routes (dashboard, logout)
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        
        // Categories
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::post('/categories/{category}/subcategories', [AdminCategoryController::class, 'storeSubcategory'])->name('subcategories.store');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.delete');
        Route::delete('/subcategories/{subcategory}', [AdminCategoryController::class, 'destroySubcategory'])->name('subcategories.delete');
        
        // Products
        Route::get('/products', [AdminProductController::class, 'index'])->name('products');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.delete');
        Route::get('/categories/{category}/subcategories', [AdminProductController::class, 'getSubcategories'])->name('categories.subcategories');
        
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

// Customer Authentication Routes
Route::prefix('customer')->group(function () {
    // Guest routes (login, register)
    Route::middleware('guest:customer')->group(function () {
        Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
        Route::post('/login', [CustomerAuthController::class, 'login']);
        Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
        Route::post('/register', [CustomerAuthController::class, 'register']);
    });
    
    // Protected routes (dashboard, profile, logout)
    Route::middleware('customer.auth')->group(function () {
        Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])->name('customer.dashboard');
        Route::get('/profile', [CustomerAuthController::class, 'profile'])->name('customer.profile');
        Route::put('/profile', [CustomerAuthController::class, 'updateProfile'])->name('customer.profile.update');
        Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
    });
});
