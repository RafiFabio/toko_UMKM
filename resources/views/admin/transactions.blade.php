<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded-lg p-6">
            <table class="w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="border px-3 py-2 text-center">#</th>
                        <th class="border px-3 py-2">Pembeli</th>
                        <th class="border px-3 py-2">Produk</th>
                        <th class="border px-3 py-2 text-center">Jumlah</th>
                        <th class="border px-3 py-2 text-right">Total Harga</th>
                        <th class="border px-3 py-2 text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $key => $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2 text-center">{{ $key + 1 }}</td>
                            <td class="border px-3 py-2">{{ $transaction->buyer->name ?? '-' }}</td>
                            <td class="border px-3 py-2">{{ $transaction->product->name ?? '-' }}</td>
                            <td class="border px-3 py-2 text-center">{{ $transaction->quantity ?? 1 }}</td>
                            <td class="border px-3 py-2 text-right font-semibold text-green-700">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </td>
                            <td class="border px-3 py-2 text-center">
                                {{ $transaction->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
