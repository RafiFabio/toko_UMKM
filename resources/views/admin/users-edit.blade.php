<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded-lg p-6">

            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1">Nama</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="border px-3 py-2 rounded w-full" required>
                </div>

                <div>
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="border px-3 py-2 rounded w-full" required>
                </div>

                <div>
                    <label class="block mb-1">Password <small>(kosongkan jika tidak diubah)</small></label>
                    <input type="password" name="password" class="border px-3 py-2 rounded w-full">
                </div>

                <div>
                    <label class="block mb-1">Role</label>
                    <select name="role" class="border px-3 py-2 rounded w-full" required>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="seller" {{ $user->role === 'seller' ? 'selected' : '' }}>Penjual</option>
                        <option value="buyer" {{ $user->role === 'buyer' ? 'selected' : '' }}>Pembeli</option>
                    </select>
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update User</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
