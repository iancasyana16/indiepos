<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
Route::get('/order', function () {
    return view('dashboard.order');
})->name('order');
Route::get('/history-order', function () {
    return view('dashboard.historyOrder');
})->name('history-order');
Route::get('/product', function () {
    return view('dashboard.product');
})->name('product');
// Route::get('/account', function () {
//     return view('dashboard.account');
// })->name('account');
Route::get('/setting', function () {
    return view('dashboard.setting');
})->name('setting');


Route::get('/product-add', function () {
    return view('dashboard.addProduct');
})->name('product-add');
Route::get('/product-edit', function () {
    return view('dashboard.editProduct');
})->name('product-edit');
Route::get('/account-add', function () {
    return view('dashboard.addAccount');
})->name('account-add');
Route::get('/account-edit', function () {
    return view('dashboard.editAccount');
})->name('account-edit');

Route::resource('/account', UserController::class)->names([
    'index' => 'account',
    'store' => 'account.store',
    'update' => 'account.update',
    'destroy' => 'account.destroy',
]);