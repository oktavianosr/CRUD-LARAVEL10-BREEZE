<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Management</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        
        <div class="flex justify-end items-center mb-6">
            <form method="GET"">
                <input type="text" name="search" placeholder="Search..." class="border px-3 py-2 rounded w-1/3" value="{{ request('search') }}">

                <button class="ml-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Search</button>
            </form>
            <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded ml-2"> Tambah Anggota</a>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead><tr><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="p-4">{{ $user->name }}</td>
                            <td class="p-4">{{ $user->email }}</td>
                            <td class="p-4">{{ $user->role->name ?? $user->role_name['name'] ?? '-' }}</td>
                            <td class="p-4">
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus user ini?')" class="text-red-600 hover:underline ml-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
