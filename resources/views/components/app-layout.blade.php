<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
        <!-- Links -->
        <div class="flex items-center space-x-4">
            @auth
                @php $role = Auth::user()->role; @endphp

                {{-- 🌐 ADMIN --}}
                @if($role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300 px-3 py-2 rounded">Dashboard</a>
                    <a href="{{ route('admin.users.index') }}" class="hover:text-gray-300 px-3 py-2 rounded">Users</a>
                    <a href="{{ route('admin.products.index') }}" class="hover:text-gray-300 px-3 py-2 rounded">Products</a>
                    <a href="{{ route('admin.transactions.index') }}" class="hover:text-gray-300 px-3 py-2 rounded">Transactions</a>

                {{-- 🧑‍💼 SELLER --}}
                @elseif($role === 'seller' || $role === 'penjual')
                    <a href="{{ route('seller.dashboard') }}" class="hover:text-gray-300 px-3 py-2 rounded">Dashboard</a>
                    <a href="{{ route('seller.products.index') }}" class="hover:text-gray-300 px-3 py-2 rounded">My Products</a>
                    <a href="{{ route('seller.transactions.index') }}" class="hover:text-gray-300 px-3 py-2 rounded">Transactions</a>

                {{-- 🛍️ BUYER / PEMBELI --}}
                @else
                    <a href="{{ route('user.dashboard') }}" class="hover:text-gray-300 px-3 py-2 rounded">Dashboard</a>
                    <a href="{{ route('transactions.create') }}" class="hover:text-gray-300 px-3 py-2 rounded">Shop</a>
                    <a href="{{ route('user.transactions.index') }}" class="hover:text-gray-300 px-3 py-2 rounded">My Orders</a>
                @endif
            @endauth
        </div>

        <!-- Profile Dropdown -->
        @auth
        <div class="relative inline-block text-left">
            <button id="profileBtn" class="flex items-center space-x-2 bg-gray-700 px-3 py-2 rounded focus:outline-none hover:bg-gray-600 transition">
                <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/32' }}" 
                     alt="Profile" class="w-8 h-8 rounded-full object-cover">
                <span>{{ Auth::user()->name }}</span>
            </button>

            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded shadow-lg z-50">
                {{-- Profile --}}
                @if(Route::has('profile.edit'))
                <a href="{{ route('profile.edit') }}" 
                   class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                    <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/24' }}" 
                         alt="Profile" class="w-6 h-6 rounded-full mr-2 object-cover">
                    Profile
                </a>
                @endif

                {{-- Logout --}}
                @if(Route::has('umkm.logout'))
                <form method="POST" action="{{ route('umkm.logout') }}">
                    @csrf
                    <button type="submit" 
                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                        Logout
                    </button>
                </form>
                @endif
            </div>
        </div>
        @endauth
    </nav>

    <!-- Header -->
    <header class="bg-white shadow p-4">
        {{ $header ?? '' }}
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4">
        {{ $slot }}
    </main>

    <!-- Script untuk toggle dropdown -->
    <script>
        const btn = document.getElementById('profileBtn');
        const dropdown = document.getElementById('profileDropdown');

        if (btn && dropdown) {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });

            window.addEventListener('click', () => {
                dropdown.classList.add('hidden');
            });
        }
    </script>
</body>
</html>
