<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
Route::get('/', function () {
    return view('welcome');
});

/* ---------------------------------- Email verified routes ---------------------------------- */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::resource('products', ProductController::class)->middleware('role:admin|farmer');

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->only('index', 'destroy');
        Route::resource('categories', CategoryController::class)->except('show');
    });

    Route::post('orders/{order}/mark-as-delivered', [OrderController::class, 'markAsDelivered'])->name('orders.mark-as-delivered');
    Route::resource('orders', OrderController::class);
});

/* ---------------------------------- Auth routes ---------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
