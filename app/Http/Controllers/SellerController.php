<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction;

class SellerController extends Controller
{
    // 🏠 Dashboard Seller
    public function index()
    {
        $sellerId = Auth::id();

        // 📊 Statistik
        $productCount = Product::where('user_id', $sellerId)->count();
        $transactionCount = Transaction::where('seller_id', $sellerId)->count();

        // 📦 Produk milik seller sendiri
        $myProducts = Product::where('user_id', $sellerId)->get();

        // 🛍️ Produk dari penjual lain (bisa dibeli)
        $otherProducts = Product::where('user_id', '!=', $sellerId)
            ->with('user')
            ->latest()
            ->get();

        // 💰 Data penjualan milik seller ini
        $sales = Transaction::where('seller_id', $sellerId)
            ->with(['product', 'buyer'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('seller.dashboard', compact(
            'productCount',
            'transactionCount',
            'myProducts',
            'otherProducts',
            'sales'
        ));
    }

    // 💰 Daftar Transaksi Seller
    public function transactions()
    {
        $transactions = Transaction::where('seller_id', Auth::id())
            ->with('product', 'buyer')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('seller.transactions.index', compact('transactions'));
    }

    // 📦 Daftar Produk Seller
    public function products()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('seller.products.index', compact('products'));
    }

    // ➕ Form Tambah Produk
    public function create()
    {
        return view('seller.products.create');
    }

    // 💾 Simpan Produk Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // ✏️ Form Edit Produk
    public function edit($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        return view('seller.products.edit', compact('product'));
    }

    // 🔄 Update Produk
    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'price', 'stock', 'description']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // 🗑️ Hapus Produk
    public function destroy($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
