@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow mt-8">
    <h2 class="text-2xl font-bold mb-4">Pembelian Produk</h2>

    <div class="flex items-center gap-4 mb-4">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded">
        <div>
            <h3 class="text-xl font-semibold">{{ $product->name }}</h3>
            <p class="text-green-600 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>
    </div>

    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        
        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
            BELI
        </button>
    </form>
</div>
@endsection
