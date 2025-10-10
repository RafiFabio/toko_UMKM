<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo / Nama App -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? route(Auth::user()->role . '.dashboard') : route('umkm.login') }}">
                        <h1 class="text-xl font-bold text-gray-700">UMKM App</h1>
                    </a>
                </div>
            </div>

            <!-- Menu kanan -->
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-gray-600">Halo, {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</span>

                    <form method="POST" action="{{ route('umkm.logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('umkm.login') }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
