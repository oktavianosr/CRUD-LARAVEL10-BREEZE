<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Leave Types
        </h2>
    </x-slot>



        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="flex justify-between items-center mb-6">
                <hr>
                <a href="{{ route('leave_types.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">+ Add Leave Type</a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4">Name</th>
                            <th class="py-2 px-4">Status</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaveType as $leaveTypes)
                            <tr class="border-t">
                                <td class="py-2 px-4">{{ $leaveTypes->name }}</td>
                                <td class="py-2 px-4">{{ $leaveTypes->is_active ? 'Active' : 'Inactive' }}</td>
                                <td class="py-2 px-4 flex space-x-2">
                                    <a href="{{ route('leave_types.edit', $leaveTypes) }}" class="bg-yellow-400 hover:bg-yellow-500 text-blue mr-2 py-1 px-3 rounded">Edit</a>
                                    <form action="{{ route('leave_types.destroy', $leaveTypes) }}" method="POST" onsubmit="return confirm('Delete this leave type?')">
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
                    {{ $leaveType->withQueryString()->links() }}
                </div>
            </div>
        </div>
</x-app-layout>
