<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($user) ? 'Edit User' : 'Tambah User' }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div>
                <x-input-label for="name" value="Nama" />
                <x-text-input name="name" id="name" type="text" class="mt-1 block w-full" value="{{ old('name', $user->name ?? '') }}" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" value="Email" />
                <x-text-input name="email" id="email" type="email" class="mt-1 block w-full" value="{{ old('email', $user->email ?? '') }}" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="role_id" value="Role" />
                <select name="role_id" id="role_id" class="block mt-1 w-full">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
            </div>

            @if (!isset($user))
            <div class="mt-4">
                <x-input-label for="password" value="Password" />
                <x-text-input name="password" id="password" type="password" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            @endif

            <div class="mt-4">
                <x-primary-button>{{ isset($user) ? 'Update' : 'Simpan' }}</x-primary-button>
                <a href="{{ route('users.index') }}" class="ml-2 text-gray-600">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
