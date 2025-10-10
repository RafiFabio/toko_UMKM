<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Toko UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-10">
        <h1 class="text-2xl font-bold text-gray-800">🛍️ Toko UMKM</h1>
        <div class="flex items-center space-x-4">
            <span class="text-gray-700">Halo, {{ Auth::user()->name }}</span>
            <a href="{{ route('user.transactions') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Checkout</a>
            <form method="POST" action="{{ route('umkm.logout') }}">
                @csrf
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Logout</button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="p-6 max-w-7xl mx-auto">

        {{-- ✅ Notifikasi --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
                {{ session('error') }}
            </div>
        @endif

        <!-- ================= PRODUK TERSEDIA ================= -->
        <h2 class="text-xl font-semibold mb-4 text-gray-800">🛒 Produk Tersedia</h2>

        @if($products->isEmpty())
            <p class="text-gray-600">Belum ada produk yang dijual.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-40 object-contain bg-gray-50 p-2">
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                                Tidak ada gambar
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2 mt-1">{{ $product->description }}</p>
                            <p class="text-green-600 font-semibold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500">Stok: {{ $product->stock }}</p>
                            <p class="text-xs text-gray-400 mt-1">Penjual: {{ $product->user->name ?? 'Tidak diketahui' }}</p>

                            <!-- Tombol Beli Sekarang -->
                            <a href="{{ route('transactions.create', ['product_id' => $product->id]) }}"
                               class="mt-4 block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded transition">
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

</body>
</html>
