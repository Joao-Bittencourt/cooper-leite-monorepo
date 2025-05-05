<?php

declare(strict_types=1);

use App\Http\Controllers\API\CooperativeController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\TransactionController;

Route::post('register', [RegisterController::class, 'register'])->name('register.register');
Route::post('login', [RegisterController::class, 'login'])->name('register.login');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/cooperatives', [CooperativeController::class, 'index'])->name('cooperatives.index');
    Route::get('/cooperatives/{cooperative}', [CooperativeController::class, 'show'])->name('cooperatives.show');
    Route::post('/cooperatives', [CooperativeController::class, 'store'])->name('cooperatives.store');
    Route::put('/cooperatives/{cooperative}', [CooperativeController::class, 'update'])->name('cooperatives.update');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
});
