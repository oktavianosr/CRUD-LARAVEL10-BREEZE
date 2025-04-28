<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Leave Type
        </h2>
    </x-slot>

    <div class="p-4">
        <form action="{{ route('leave_types.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Nama Leave Type</label>
                <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('name') }}">
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block mb-1">Description</label>
                <textarea name="description" class="border px-3 py-2 rounded w-full" rows="3"></textarea>
            </div>

            <div>
                <x-primary-button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </x-primary-button>
                <a href="{{ route('leave_types.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
