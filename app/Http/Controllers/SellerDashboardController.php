<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ✅ Produk milik seller yang sedang login
        $products = Product::where('user_id', $user->id)->get();

        // ✅ Jumlah produk milik seller
        $productCount = $products->count();

        // ✅ Transaksi penjualan (produk milik seller)
        $sales = Transaction::whereHas('product', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['product', 'buyer'])->latest()->get();

        $transactionCount = $sales->count();

        // ✅ Produk dari penjual lain
        $otherProducts = Product::where('user_id', '!=', $user->id)->get();

        return view('seller.dashboard', compact(
            'products',
            'sales',
            'productCount',
            'transactionCount',
            'otherProducts'
        ));
    }
}
