<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;

class AdminController extends Controller
{
    // ===== Dashboard =====
    public function index()
    {
        $userCount = User::count();
        $productCount = Product::count();
        $transactionCount = Transaction::count();

        return view('admin.dashboard', compact('userCount', 'productCount', 'transactionCount'));
    }

    // ===== USER MANAGEMENT =====
    public function listUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,seller,buyer',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users-edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,seller,buyer',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Tidak dapat menghapus akun sendiri.']);
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    // ===== PRODUCT MANAGEMENT =====
    public function listProducts()
    {
        $products = Product::with('user')->get();
        return view('admin.products', compact('products'));
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    // ===== TRANSACTION MANAGEMENT =====
    public function transactions()
    {
        $transactions = Transaction::with(['buyer', 'product'])->get();
        return view('admin.transactions', compact('transactions'));
    }
}
