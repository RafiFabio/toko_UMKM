<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Saya - Toko UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <header class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-10">
        <h1 class="text-2xl font-bold text-gray-800">💳 Riwayat Transaksi</h1>
        <div class="flex items-center space-x-4">
            <a href="{{ route('user.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">← Kembali</a>
        </div>
    </header>

    <main class="p-6 max-w-7xl mx-auto">
        @if($transactions->isEmpty())
            <p class="text-gray-600">Belum ada transaksi yang dilakukan.</p>
        @else
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Produk</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Jumlah</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $index => $trx)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $trx->product->name ?? '-' }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($trx->product->price ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $trx->quantity }}</td>
                                <td class="px-4 py-3 font-semibold text-green-600">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        @if($trx->status == 'selesai') bg-green-100 text-green-700
                                        @elseif($trx->status == 'proses') bg-yellow-100 text-yellow-700
                                        @else bg-gray-100 text-gray-600 @endif">
                                        {{ ucfirst($trx->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ $trx->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>

</body>
</html>
