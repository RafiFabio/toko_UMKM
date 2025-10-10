<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\RoleMiddleware;

class SellerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return app(RoleMiddleware::class)->handle($request, $next, 'seller');
    }
}
