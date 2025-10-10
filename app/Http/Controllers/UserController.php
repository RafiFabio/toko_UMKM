<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction;

class UserController extends Controller
{
    // 🏠 Dashboard Pembeli (atau Umum)
    public function dashboard()
    {
        $user = Auth::user();

        // Semua produk (seperti di toko utama)
        $products = Product::with('user')->latest()->get();

        // Jika user adalah penjual, tampilkan juga data penjualan
        $sales = collect();
        $productCount = 0;
        $transactionCount = 0;

        if ($user->role === 'seller') {
            $sales = Transaction::where('seller_id', $user->id)
                ->with(['product', 'buyer'])
                ->orderBy('created_at', 'desc')
                ->get();

            $productCount = Product::where('user_id', $user->id)->count();
            $transactionCount = $sales->count();
        }

        return view('user.dashboard', compact(
            'products',
            'sales',
            'productCount',
            'transactionCount'
        ));
    }

    // 💰 Daftar transaksi pembeli (riwayat pembelian)
    public function transactions()
    {
        $user = Auth::user();

        // Ambil transaksi di mana user ini sebagai pembeli
        $transactions = Transaction::where('buyer_id', $user->id)
            ->with(['product', 'seller'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.transactions', compact('transactions'));
    }
}
