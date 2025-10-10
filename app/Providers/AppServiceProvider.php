<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {
            // Route utama (login, register, dll)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Route admin
            Route::middleware(['web', 'auth'])
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            // Route penjual
            Route::middleware(['web', 'auth'])
                ->prefix('seller')
                ->group(base_path('routes/seller.php'));

            // Route pembeli
            Route::middleware(['web', 'auth'])
                ->prefix('user')
                ->group(base_path('routes/user.php'));
        });
    }
}
