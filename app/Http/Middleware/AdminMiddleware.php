<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // User belum login → redirect ke login UMKM
            return redirect()->route('umkm.login');
        }

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized'); // bukan admin → 403
        }

        return $next($request);
    }
}
