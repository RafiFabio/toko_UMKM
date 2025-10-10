<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Prefix "admin" dan middleware sudah diatur di RouteServiceProvider.
|
*/

Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// ======== USER MANAGEMENT ========
Route::get('/users', [AdminController::class, 'listUsers'])->name('admin.users.index');
Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.delete');

// ======== PRODUCT MANAGEMENT ========
Route::get('/products', [AdminController::class, 'listProducts'])->name('admin.products.index');
Route::delete('/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.delete');

// ======== TRANSACTION MANAGEMENT ========
Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions.index');
