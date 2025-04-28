<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Role Management</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="flex justify-between items-center mb-6">
            <hr>

        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="GET" class="mb-4">
            <input type="text" name="search" placeholder="Search Role..." class="border px-3 py-2 rounded w-1/3" value="{{ request('search') }}">
            <button class="ml-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Search</button>
            <a href="{{ route('roles.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">+ Add Role</a>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-4">Level</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ $role->name }}</td>
                            <td class="py-2 px-4">{{ $role->level }}</td>
                            <td class="py-2 px-4">{{ $role->is_active ? 'Active' : 'Inactive' }}</td>
                            <td class="py-2 px-4 flex space-x-2">
                                <a href="{{ route('roles.edit', $role) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black py-1 px-3 mr-2 rounded" >Edit</a>
                                <form action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Delete this role?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $roles->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
