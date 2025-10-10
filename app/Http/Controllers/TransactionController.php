<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi milik user (riwayat pembelian)
     */
    public function index()
    {
        $transactions = Transaction::where('buyer_id', Auth::id())
            ->with('product')
            ->latest()
            ->get();

        return view('user.transactions.index', compact('transactions'));
    }

    /**
     * Menampilkan halaman pembelian produk
     */
    public function create(Request $request)
    {
        $productId = $request->query('product_id');
        $product = Product::findOrFail($productId);

        return view('user.transactions.create', compact('product'));
    }

    /**
     * Proses simpan transaksi baru (pembelian)
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Pastikan stok cukup
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi!');
        }

        // Buat transaksi baru
        Transaction::create([
            'product_id' => $product->id,
            'buyer_id' => Auth::id(),
            'seller_id' => $product->user_id,
            'quantity' => $request->quantity,
            'total_price' => $product->price * $request->quantity,
            'status' => 'pending',
        ]);

        // Kurangi stok produk
        $product->decrement('stock', $request->quantity);

        // ✅ Setelah beli, arahkan ke dashboard
        return redirect()->intended(route('dashboard'))
            ->with('success', 'Transaksi berhasil! Terima kasih sudah berbelanja.');
    }
}
