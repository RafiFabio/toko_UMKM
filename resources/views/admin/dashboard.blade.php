<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800">Total Pengguna</h3>
                <p class="text-3xl font-bold mt-2">{{ $userCount }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800">Total Produk</h3>
                <p class="text-3xl font-bold mt-2">{{ $productCount }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800">Total Transaksi</h3>
                <p class="text-3xl font-bold mt-2">{{ $transactionCount }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
