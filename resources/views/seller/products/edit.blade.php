@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-10 border border-gray-300">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">✏️ Edit Produk</h1>

    <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nama Produk --}}
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $product->name) }}"
                   class="w-full border border-gray-500 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none shadow-sm"
                   required>
        </div>

        {{-- Harga --}}
        <div>
            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
            <input type="number" name="price" id="price"
                   value="{{ old('price', $product->price) }}"
                   class="w-full border border-gray-500 rounded-lg p-3 focus:ring-2 focus:ring-green-400 focus:border-green-500 outline-none shadow-sm"
                   required>
        </div>

        {{-- Stok --}}
        <div>
            <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
            <input type="number" name="stock" id="stock"
                   value="{{ old('stock', $product->stock) }}"
                   class="w-full border border-gray-500 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 outline-none shadow-sm"
                   required>
        </div>

        {{-- Deskripsi --}}
        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" id="description"
                      rows="4"
                      class="w-full border border-gray-500 rounded-lg p-3 focus:ring-2 focus:ring-purple-400 focus:border-purple-500 outline-none shadow-sm"
                      placeholder="Tuliskan deskripsi produk...">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Gambar Produk --}}
        <div>
            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Gambar Produk</label>
            @if ($product->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-32 rounded-lg border border-gray-400 shadow-sm">
                </div>
            @endif
            <input type="file" name="image" id="image"
                   class="w-full text-sm text-gray-600 border border-gray-500 rounded-lg p-2 file:mr-3 file:py-2 file:px-4 
                          file:rounded-md file:border-0 file:text-sm 
                          file:font-semibold file:bg-blue-50 file:text-blue-700 
                          hover:file:bg-blue-100 shadow-sm">
            <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('seller.dashboard') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-lg font-medium transition shadow-sm">
               ← Kembali
            </a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition shadow-md">
                💾 Update Produk
            </button>
        </div>
    </form>
</div>
@endsection
