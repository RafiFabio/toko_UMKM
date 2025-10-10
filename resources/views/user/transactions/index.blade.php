@extends('layouts.dashboard')

@section('title', 'Daftar Transaksi')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">📦 Daftar Transaksi</h2>

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full border border-gray-300 border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-3 py-2 text-left">ID Transaksi</th>
                        <th class="border border-gray-300 px-3 py-2 text-left">Produk</th>
                        <th class="border border-gray-300 px-3 py-2 text-left">Pembeli</th>
                        <th class="border border-gray-300 px-3 py-2 text-right">Total Harga</th>
                        <th class="border border-gray-300 px-3 py-2 text-center">Status</th>
                        <th class="border border-gray-300 px-3 py-2 text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-3 py-2">{{ $trx->id }}</td>
                            <td class="border border-gray-300 px-3 py-2">{{ $trx->product->name ?? '-' }}</td>
                            <td class="border border-gray-300 px-3 py-2">{{ $trx->buyer->name ?? '-' }}</td>
                            <td class="border border-gray-300 px-3 py-2 text-right">
                                Rp{{ number_format($trx->total_price, 0, ',', '.') }}
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                @if($trx->status === 'pending')
                                    <span class="text-yellow-600 font-semibold">Menunggu</span>
                                @elseif($trx->status === 'paid')
                                    <span class="text-blue-600 font-semibold">Dibayar</span>
                                @elseif($trx->status === 'shipped')
                                    <span class="text-indigo-600 font-semibold">Dikirim</span>
                                @elseif($trx->status === 'completed')
                                    <span class="text-green-600 font-semibold">Selesai</span>
                                @elseif($trx->status === 'cancelled')
                                    <span class="text-red-600 font-semibold">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                {{ $trx->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">
                                Belum ada transaksi yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
