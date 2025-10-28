<?php

use App\Http\Controllers\Admin\HistoryOrderController as AdminHistoryOrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

// === Auth Routes ===
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === Protected Routes ===
Route::middleware('auth')->group(function () {

    Route::resource('dashboard', DashboardController::class)->only('index');
    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('setting', [SettingController::class, 'update'])->name('setting.update');
    Route::resource('history-order', AdminHistoryOrderController::class);

    Route::prefix('admin')->group(function () {
        Route::resource('account', AdminUserController::class);
        Route::post('account/{account}/reset-password', [AdminUserController::class, 'resetPassword'])->name('account.reset-password');
        Route::resource('product', AdminProductController::class);
        Route::get('/order', [AdminOrderController::class, 'index'])->name('order.index');
        Route::post('/order/add/{product}', [AdminOrderController::class, 'addToCart'])->name('order.add');
        Route::delete('/order/cart', [AdminOrderController::class, 'clearCart'])->name('order.cart.clear');
        Route::post('/order/cart/increment/{id}', [AdminOrderController::class, 'incrementCart'])->name('order.cart.increment');
        Route::post('/order/cart/decrement/{id}', [AdminOrderController::class, 'decrementCart'])->name('order.cart.decrement');
        Route::post('/order/checkout', [AdminOrderController::class, 'checkout'])->name('order.checkout');
    });
});