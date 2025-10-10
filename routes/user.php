<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Grup route untuk USER / PEMBELI
Route::middleware(['auth', 'role:user,buyer,pembeli'])->group(function () {
    // Dashboard utama user
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Halaman profil
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');

    // Halaman transaksi
    Route::get('/user/transactions', [UserController::class, 'transactions'])->name('user.transactions');
});

// Redirect otomatis kalau belum login
Route::get('/user', function () {
    return redirect()->route('umkm.login');
});
