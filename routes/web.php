<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/* ---------------------------------- Public routes ---------------------------------- */
Route::get('/', [PublicController::class, 'welcome'])->name('welcome');
Route::get('/farmers', [PublicController::class, 'farmer'])->name('farmers');

/* ---------------------------------- Email verified routes ---------------------------------- */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::resource('products', ProductController::class)->middleware('role:admin|farmer');
    Route::get('/farmers/{farmer}/products', [PublicController::class, 'product'])->middleware('role:customer')->name('farmer.products');
    Route::put('/cart/{product}/product', [CartController::class, 'update'])->middleware('role:customer')->name('cart.update');
    Route::delete('/cart/{product}/product', [CartController::class, 'destroyProduct'])->middleware('role:customer')->name('cart.destroy-product');
    Route::resource('/cart', CartController::class)->middleware('role:customer')->only('index', 'store', 'destroy');

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->only('index', 'destroy');
        Route::resource('categories', CategoryController::class)->except('show');
    });

    Route::post('orders/{order}/mark-as-delivered', [OrderController::class, 'markAsDelivered'])->name('orders.mark-as-delivered');
    Route::resource('orders', OrderController::class);
});

/* ---------------------------------- Auth routes ---------------------------------- */
Route::middleware('auth')->group(function () {
    Route::patch('/users/{user}/update-balance', [UserController::class, 'updateBalance'])->name('users.update-balance');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
