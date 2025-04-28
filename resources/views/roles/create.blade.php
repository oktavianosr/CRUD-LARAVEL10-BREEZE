<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($role) ? 'Edit Role' : 'Tambah Role' }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form action="{{ isset($role) ? route('roles.update', $role) : route('roles.store') }}" method="POST">
            @csrf
            @if(isset($role)) @method('PUT') @endif

            <div>
                <label class="block mb-1">Nama Role</label>
                <input type="text" name="name" class="border px-3 py-2 rounded w-full" required>
            </div>

            <div>
                <label class="block mb-1">Level</label>
                <x-input-label>1. Administrator</x-input-label>
                <x-input-label>2. Karyawan</x-input-label>
                <input type="number" name="level" class="border px-3 py-2 rounded w-full" value="3">
            </div>

            <div>
                <label class="block mb-1">Hak Akses</label>
                <textarea name="permissions[notes]" class="border px-3 py-2 rounded w-full" rows="3"></textarea>
            </div>


            <div class="mt-4">
                <x-primary-button>{{ isset($role) ? 'Update' : 'Simpan' }}</x-primary-button>
                <a href="{{ route('roles.index') }}" class="ml-2 text-gray-600">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
