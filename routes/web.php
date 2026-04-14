<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Breeze profile settings
    require __DIR__.'/settings.php';

    // Customer profiles (own profile for users, all for admins)
    Route::resource('customers', CustomerController::class);

    // Orders (own orders for users, all for admins)
    Route::resource('orders', OrderController::class);

    // Admin-only routes
    Route::middleware('admin')->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('users', UserController::class);
    });
});

// Demo / test routes (no auth needed)
Route::get('/shop/store', [ShopController::class, 'store'])->name('shop.store');
Route::get('/shop/show',  [ShopController::class, 'show'])->name('shop.show');

require __DIR__.'/auth.php';
