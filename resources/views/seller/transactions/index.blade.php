<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Saya') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="w-full table-auto border-collapse text-base">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-4 text-left">ID Transaksi</th>
                        <th class="px-6 py-4 text-left">Produk</th>
                        <th class="px-6 py-4 text-left">Pembeli</th>
                        <th class="px-6 py-4 text-center">Jumlah</th>
                        <th class="px-6 py-4 text-right">Harga Satuan</th>
                        <th class="px-6 py-4 text-right">Total Harga</th>
                        <th class="px-6 py-4 text-center">Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transactions as $transaction)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $transaction->id }}</td>
                            <td class="px-6 py-4">{{ $transaction->product->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $transaction->buyer->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">{{ $transaction->quantity }}</td>
                            <td class="px-6 py-4 text-right">Rp {{ number_format($transaction->product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right font-semibold text-green-600">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">{{ $transaction->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

