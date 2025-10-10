<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
|
| Ini adalah route untuk halaman profil pengguna.
| Hanya user yang sudah login yang bisa mengakses halaman ini.
|
*/

Route::middleware('auth')->group(function () {
    // Menampilkan halaman edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Mengupdate data profil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Menghapus akun
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
