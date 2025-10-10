<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {

            // Route umum (guest, auth basic)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Admin routes
            Route::middleware(['web', 'auth', 'role:admin'])
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            // Seller routes
            Route::middleware(['web', 'auth', 'role:seller'])
                ->prefix('seller')
                ->group(base_path('routes/seller.php'));

            // User routes
            Route::middleware(['web', 'auth', 'role:user'])
                ->prefix('user')
                ->group(base_path('routes/user.php'));
        });
    }
}
