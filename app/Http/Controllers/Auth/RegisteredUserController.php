<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan halaman register.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Proses register user baru.
     */
    public function store(Request $request): RedirectResponse
    {
        // ✅ Validasi input termasuk role
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,seller'], // ✅ ubah 'buyer' jadi 'user'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        // ✅ arahkan berdasarkan role
        if ($user->role === 'seller') {
            return redirect()->route('seller.dashboard');
        } elseif ($user->role === 'user') { // ✅ ubah dari buyer ke user
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('dashboard');

    }
}
