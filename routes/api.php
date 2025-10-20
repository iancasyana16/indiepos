<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::resource('product', ProductController::class)->only(['index', 'store', 'update', 'destroy']);
// Route::resource('user', UserController::class)->only('index', 'store', 'update', 'destroy');

// Route::post('/order/checkout', [AdminOrderController::class, 'checkout'])->name('order.checkout');