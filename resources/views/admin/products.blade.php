<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Produk') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded-lg p-6">
            <table class="w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="border px-3 py-2">#</th>
                        <th class="border px-3 py-2">Nama Produk</th>
                        <th class="border px-3 py-2">Penjual</th>
                        <th class="border px-3 py-2">Harga</th>
                        <th class="border px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2 text-center">{{ $key + 1 }}</td>
                            <td class="border px-3 py-2">{{ $product->name }}</td>
                            <td class="border px-3 py-2">{{ $product->user->name ?? '-' }}</td>
                            <td class="border px-3 py-2">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="border px-3 py-2 text-center">
                                <form action="{{ route('admin.products.delete', $product->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-white font-semibold px-4 py-1.5 rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:scale-105"
                                        style="background: linear-gradient(to right, #ef4444, #b91c1c);">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
