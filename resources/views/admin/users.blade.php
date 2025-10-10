<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6 overflow-visible">

                {{-- Notifikasi sukses --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-3 border border-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Notifikasi error --}}
                @if($errors->any())
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-3 border border-red-300">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM TAMBAH USER -->
                <div class="mb-6 border border-gray-200 p-4 rounded bg-gray-50">
                    <h3 class="font-semibold mb-3 text-lg text-gray-800">Tambah User Baru</h3>

                    <form action="{{ route('admin.users.store') }}" method="POST"
                          class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        @csrf

                        <input type="text" name="name" placeholder="Nama"
                               class="border border-gray-300 px-3 py-2 rounded w-full focus:ring focus:ring-blue-300" required>

                        <input type="email" name="email" placeholder="Email"
                               class="border border-gray-300 px-3 py-2 rounded w-full focus:ring focus:ring-blue-300" required>

                        <input type="password" name="password" placeholder="Password"
                               class="border border-gray-300 px-3 py-2 rounded w-full focus:ring focus:ring-blue-300" required>

                        <select name="role" class="border border-gray-300 px-3 py-2 rounded w-full focus:ring focus:ring-blue-300" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="seller">Penjual</option>
                            <option value="buyer">Pembeli</option>
                        </select>

                        <div class="col-span-full text-right mt-4">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow-md border border-blue-800 transition">
                                + Tambah User
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TABEL USER -->
                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full text-sm text-gray-800">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-3 py-2 w-12 text-center">#</th>
                                <th class="border border-gray-300 px-3 py-2">Nama</th>
                                <th class="border border-gray-300 px-3 py-2">Email</th>
                                <th class="border border-gray-300 px-3 py-2">Role</th>
                                <th class="border border-gray-300 px-3 py-2 text-center w-44">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $key => $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-3 py-2 text-center">{{ $key + 1 }}</td>
                                    <td class="border border-gray-300 px-3 py-2">{{ $user->name }}</td>
                                    <td class="border border-gray-300 px-3 py-2">{{ $user->email }}</td>
                                    <td class="border border-gray-300 px-3 py-2 capitalize">{{ $user->role }}</td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <div class="flex justify-center gap-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="px-4 py-1 rounded text-sm font-semibold text-black bg-yellow-400 hover:bg-yellow-500 border border-yellow-600 shadow transition">
                                                ✏️ Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin hapus user ini?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-4 py-1 rounded text-sm font-semibold text-white bg-red-600 hover:bg-red-700 border border-red-800 shadow transition">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">
                                        Belum ada data pengguna.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
