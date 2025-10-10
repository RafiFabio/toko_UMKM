<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - UMKM Dashboard</title>

    <!-- 🎨 Konfigurasi warna Tailwind -->
    <script>
        tailwind = {
            config: {
                theme: {
                    extend: {
                        colors: {
                            red: {
                                500: '#ef4444',
                                600: '#dc2626',
                            },
                            blue: {
                                500: '#3b82f6',
                                600: '#2563eb',
                            },
                            green: {
                                500: '#22c55e',
                                600: '#16a34a',
                            },
                            yellow: {
                                500: '#eab308',
                                600: '#ca8a04',
                            },
                            gray: {
                                700: '#374151',
                                900: '#111827',
                            },
                        },
                    },
                },
            },
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- 🔹 Header / Navbar -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- 🔸 Logo -->
                <div class="flex items-center">
                    <a href="{{ Auth::check() ? route(Auth::user()->role . '.dashboard') : route('umkm.login') }}">
                        <h1 class="text-xl font-bold text-gray-700">UMKM Dashboard</h1>
                    </a>
                </div>

                <!-- 🔸 Menu kanan -->
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-gray-600">Halo, {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</span>

                        {{-- 🔹 MENU ADMIN --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-gray-900">Users</a>
                            <a href="{{ route('admin.products.index') }}" class="text-gray-700 hover:text-gray-900">Products</a>
                            <a href="{{ route('admin.transactions.index') }}" class="text-gray-700 hover:text-gray-900">Transactions</a>

                        {{-- 🔹 MENU SELLER --}}
                        @elseif(auth()->user()->role === 'seller' || auth()->user()->role === 'penjual')
                            <a href="{{ route('seller.products.index') }}" class="text-gray-700 hover:text-gray-900">Produk Saya</a>
                            <a href="{{ route('seller.transactions.index') }}" class="text-gray-700 hover:text-gray-900">Transaksi</a>

                        {{-- 🔹 MENU PEMBELI --}}
                        @elseif(auth()->user()->role === 'user' || auth()->user()->role === 'buyer' || auth()->user()->role === 'pembeli')
                            <a href="{{ route('user.products.index') }}" class="text-gray-700 hover:text-gray-900">Produk</a>
                            <a href="{{ route('user.transactions.index') }}" class="text-gray-700 hover:text-gray-900">Pesanan</a>
                        @endif

                        {{-- 🔹 LOGOUT --}}
                        <form method="POST" action="{{ route('umkm.logout') }}">
                            @csrf
                            <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow transition">
                                Logout
                            </button>
                        </form>

                    @else
                        <a href="{{ route('umkm.login') }}" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg shadow transition">
                            Login
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <!-- 🔹 Konten Utama -->
    <main class="max-w-7xl mx-auto p-4">
        @yield('content')
    </main>

</body>
</html>
