<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($role) ? 'Edit Role' : 'Tambah Role' }}
        </h2>
    </x-slot>
    <div class="py-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Edit Role</h1>

        <form action="{{ route('roles.update', $role) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1">Name</label>
                <input type="text" name="name" value="{{ $role->name }}" class="border px-3 py-2 rounded w-full" required>
            </div>

            <div>
                <label class="block mb-1">Level</label>
                <input type="number" name="level" value="{{ $role->level }}" class="border px-3 py-2 rounded w-full">
            </div>

            <div>
                <label class="block mb-1">Permissions </label>
                <textarea name="permissions" class="border px-3 py-2 rounded w-full" rows="3">{{ $role->permissions ? json_encode(json_decode($role->permissions), JSON_PRETTY_PRINT) : '' }}</textarea>
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" class="mr-2" {{ $role->is_active ? 'checked' : '' }}>
                    Active
                </label>
            </div>

            <x-primary-button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded" type="submit">Update</x-primary-button>
        </form>
    </div>
</x-app-layout>
