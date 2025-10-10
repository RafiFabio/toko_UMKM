<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika belum login, arahkan ke halaman login
        if (!auth()->check()) {
            return redirect()->route('umkm.login');
        }

        $userRole = auth()->user()->role;

        /**
         * Alias Role — fleksibel:
         * Admin   → admin
         * Seller  → seller, penjual
         * Buyer   → buyer, pembeli, user
         */
        $aliases = [
            'admin'  => ['admin'],
            'seller' => ['seller', 'penjual'],
            'buyer'  => ['buyer', 'pembeli', 'user'],
            'user'   => ['user', 'buyer', 'pembeli'],
            'pembeli' => ['pembeli', 'buyer', 'user'],
            'penjual' => ['penjual', 'seller'],
        ];

        // Gabungkan semua role & sinonimnya ke satu array
        $allowedRoles = [];
        foreach ($roles as $role) {
            $allowedRoles = array_merge($allowedRoles, $aliases[$role] ?? [$role]);
        }

        // Cek apakah role user termasuk dalam role yang diizinkan
        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Unauthorized');
        }

        // Lanjut ke request berikutnya
        return $next($request);
    }
}
