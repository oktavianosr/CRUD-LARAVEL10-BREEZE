<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Leave Type
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

        <form action="{{ route('leave_types.update', $leaveType) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1">Name</label>
                <input type="text" name="name" value="{{ $leaveType->name }}" class="border px-3 py-2 rounded w-full" required>
            </div>

            <div>
                <label class="block mb-1">Description</label>
                <textarea name="description[notes]" class="border px-3 py-2 rounded w-full" rows="3">{{ $leaveType->description ? json_encode(json_decode($leaveType->description), JSON_PRETTY_PRINT) : '' }}</textarea>
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" class="mr-2" {{ $leaveType->is_active ? 'checked' : '' }}>
                    Active
                </label>
            </div>

            <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
