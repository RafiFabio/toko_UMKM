<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', RoleMiddleware::class . ':seller'])->group(function () {
    // Dashboard seller
    Route::get('/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');

    // Produk (CRUD)
    Route::get('/products', [ProductController::class, 'index'])->name('seller.products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('seller.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('seller.products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('seller.products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('seller.products.delete');

    // Transaksi seller
    Route::get('/transactions', [SellerController::class, 'transactions'])->name('seller.transactions');
});

