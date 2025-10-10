<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('web')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | 🏠 Halaman Utama (Redirect Otomatis)
    |--------------------------------------------------------------------------
    */
    Route::get('/', function () {
        if (Auth::check()) {
            $role = Auth::user()->role;

            return match ($role) {
                'admin' => redirect()->route('admin.dashboard'),
                'seller', 'penjual' => redirect()->route('seller.dashboard'),
                'buyer', 'pembeli', 'user' => redirect()->route('user.dashboard'),
                default => redirect()->route('umkm.login'),
            };
        }

        return redirect()->route('umkm.login');
    });

    /*
    |--------------------------------------------------------------------------
    | 📊 Dashboard Umum (Redirect berdasarkan role)
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'seller', 'penjual' => redirect()->route('seller.dashboard'),
            'buyer', 'pembeli', 'user' => redirect()->route('user.dashboard'),
            default => redirect()->route('umkm.login'),
        };
    })->middleware('auth')->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | 🔐 AUTH CUSTOM
    |--------------------------------------------------------------------------
    */
    Route::get('/umkm/login', [AuthController::class, 'showLoginForm'])->name('umkm.login');
    Route::post('/umkm/login', [AuthController::class, 'login'])->name('umkm.login.submit');
    Route::post('/umkm/logout', [AuthController::class, 'logout'])->name('umkm.logout');

    /*
    |--------------------------------------------------------------------------
    | 👩‍💼 SELLER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('seller')->middleware(['auth'])->name('seller.')->group(function () {
        // 🏠 Dashboard Seller
        Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');

        // 📦 CRUD Produk
        Route::get('/products', [SellerController::class, 'products'])->name('products.index');
        Route::get('/products/create', [SellerController::class, 'create'])->name('products.create');
        Route::post('/products/store', [SellerController::class, 'store'])->name('products.store');
        Route::get('/products/edit/{id}', [SellerController::class, 'edit'])->name('products.edit');
        Route::put('/products/update/{id}', [SellerController::class, 'update'])->name('products.update');
        Route::delete('/products/delete/{id}', [SellerController::class, 'destroy'])->name('products.destroy');

        // 💰 Transaksi Penjualan Seller
        Route::get('/transactions', [SellerController::class, 'transactions'])->name('transactions.index');
    });

    /*
    |--------------------------------------------------------------------------
    | 🛍️ BUYER / USER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
        // Dashboard User
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        // Transaksi User
        Route::get('/transactions', [UserController::class, 'transactions'])->name('transactions.index');

        // Profil
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    });

    /*
    |--------------------------------------------------------------------------
    | 💳 TRANSAKSI (Bisa dilakukan siapa pun yang login)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth'])->group(function () {
        Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
    });

    /*
    |--------------------------------------------------------------------------
    | 🔧 Tambahan Default Laravel
    |--------------------------------------------------------------------------
    */
    require __DIR__ . '/profile.php';
    require __DIR__ . '/auth.php';
});
