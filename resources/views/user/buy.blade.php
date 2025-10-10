<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembelian Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Pembelian Produk</h2>

        <div class="mb-4">
            <h3 class="font-semibold">{{ $product->name }}</h3>
            <p class="text-gray-600">{{ $product->description }}</p>
            <p class="text-green-600 font-bold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500">Stok: {{ $product->stock }}</p>
        </div>

        <form action="{{ route('user.buy.process', $product->id) }}" method="POST">
            @csrf
            <label class="block mb-2">Jumlah Pembelian</label>
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="border rounded p-2 w-full mb-3">

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded w-full">Beli Sekarang</button>
        </form>
    </div>
</body>
</html>
