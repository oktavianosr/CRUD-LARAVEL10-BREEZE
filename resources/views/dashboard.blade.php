<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audit History & Note') }}
        </h2>
    </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="overflow-x-auto">
                    <!-- Audit Table -->
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Action</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">User</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Note</th>
                            </tr>
                        </thead>
                        <tbody class="min-w-full bg-white divide-y divide-gray-200">
                            @forelse ($audits as $audit)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-600">
                                        {{ $audit->created_at->format('Y-m-d H:i:s') ?? $audit->updated_at->format('Y-m-d H:i:s') ?? $audit->deleted_at->format('Y-m-d H:i:s') }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-600">
                                        {{ ucfirst($audit->event) }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-600">
                                        {{ optional($audit->user)->name ??  '-' }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-600">
                                        {{ $audit->new_values['name'] ?? $audit->new_values['metadata']  ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                        No audit history available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
</x-app-layout>
