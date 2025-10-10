<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard Penjual
        </h2>
    </x-slot>

    <div class="p-6 space-y-10 max-w-7xl mx-auto">

        {{-- 📊 Statistik --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-blue-100 p-4 rounded-lg text-center">
                <h3 class="text-2xl font-bold text-blue-700">{{ $productCount ?? 0 }}</h3>
                <p class="text-gray-700">Produk Kamu</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg text-center">
                <h3 class="text-2xl font-bold text-green-700">{{ $transactionCount ?? 0 }}</h3>
                <p class="text-gray-700">Transaksi</p>
            </div>
        </div>


            {{-- 💰 Penjualan Kamu --}}
            <div class="space-y-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">💰 Penjualan Kamu</h3>

                @if($sales->isEmpty())
                    <p class="text-gray-500 px-4 py-3">Belum ada transaksi penjualan.</p>
                @else
                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        <table class="w-full table-auto text-sm border-collapse">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-3 text-left">Produk</th>
                                    <th class="px-4 py-3 text-left">Pembeli</th>
                                    <th class="px-4 py-3 text-center">Jumlah</th>
                                    <th class="px-4 py-3 text-right">Total</th>
                                    <th class="px-4 py-3 text-center">Status</th>
                                    <th class="px-4 py-3 text-left">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                    <tr class="border-t hover:bg-gray-50 transition">
                                        <td class="px-4 py-3">{{ $sale->product->name ?? '-' }}</td>
                                        <td class="px-4 py-3">{{ $sale->buyer->name ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center">{{ $sale->quantity }}</td>
                                        <td class="px-4 py-3 text-right font-semibold text-green-600">
                                            Rp {{ number_format($sale->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 text-center">{{ ucfirst($sale->status) }}</td>
                                        <td class="px-4 py-3 text-gray-500">{{ $sale->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>


    </div>

    {{-- 🌈 Style tambahan --}}
    <style>
        .product-card {
            transition: all 0.2s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</x-app-layout>
