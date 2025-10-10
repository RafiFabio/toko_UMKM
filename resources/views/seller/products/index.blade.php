@extends('layouts.dashboard')

@section('title', 'Daftar Produk')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Daftar Produk</h2>

    <!-- Tombol aksi -->
    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ route('seller.dashboard') }}" 
           class="text-blue-600 font-semibold hover:underline px-4 py-2 border border-blue-500 rounded-lg transition">
           &larr; Kembali ke Dashboard
        </a>

        <a href="{{ route('seller.products.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
           Tambah Produk
        </a>
    </div>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel produk -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Harga</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Stok</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $product->name }}</td>
                    <td class="px-4 py-2">Rp{{ number_format($product->price) }}</td>
                    <td class="px-4 py-2">{{ $product->stock }}</td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('seller.products.edit', $product->id) }}" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-3 py-1 rounded transition duration-200 shadow-sm">
                               Edit
                            </a>
                            <form action="{{ route('seller.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded transition duration-200 shadow-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
