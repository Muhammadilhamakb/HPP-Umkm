<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Ganti dengan dashboard kamu
    })->name('dashboard');

    // Route yang lain
});



Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order-history.index');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::resource('products', ProductController::class);

Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');

Route::get('/target', [SalesController::class, 'index'])->name('target.index');
Route::post('/target/target', [SalesController::class, 'storeTarget'])->name('target.storeTarget');
Route::post('/target/profit', [SalesController::class, 'storeProfit'])->name('target.storeProfit');
Route::post('/target/menu', [SalesController::class, 'storeMenu'])->name('target.storeMenu');


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'login'])->name('login.process');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route::middleware('auth')->group(function () {
//     Route::get('/hpp', [HPPController::class, 'index']);
//     Route::post('/hpp', [HPPController::class, 'store']);

//     Route::get('/target', [TargetController::class, 'index']);
//     Route::post('/target', [TargetController::class, 'store']);

//     Route::get('/history', [OrderHistoryController::class, 'index']);
//     Route::post('/history', [OrderHistoryController::class, 'store']);

//     Route::post('/logout', [AuthController::class, 'logout']);
// });
