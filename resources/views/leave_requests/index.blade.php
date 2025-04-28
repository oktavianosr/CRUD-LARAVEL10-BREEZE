<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Leave Requests') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Daftar Permohonan Cuti</h3>
                    <form method="GET">
                        <input type="text" name="search" placeholder="Search..." class="border px-3 py-2 rounded w-1/3" value="{{ request('search') }}">
                        <button class="ml-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Search</button>
                    </form>
                    @if(Auth::user()->role->name !== 'Administrator')
                    <a href="{{ route('leave_requests.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Ajukan Cuti</a>
                    @endif
                </div>

                <table class="min-w-full divide-y divide-gray-300 text-left table-auto ">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3">Id Anggota</th>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Tipe Cuti</th>
                            <th class="px-6 py-3">Tanggal Mulai</th>
                            <th class="px-6 py-3">Tanggal Selesai</th>
                            <th class="px-6 py-3">Status</th>
                            @if(Auth::user()->role->name === 'Administrator')
                            <th class="px-6 py-3">Lampiran</th>
                            <th class="px-6 py-3">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($leaveRequests as $request)
                            <tr>
                                <td class="px-6 py-4">{{ $request->user->id }}</td>
                                <td class="px-6 py-4">{{ $request->user->name }}</td>
                                <td class="px-6 py-4">{{ $request->leaveType->name }}</td>
                                <td class="px-6 py-4">{{ $request->start_date }}</td>
                                <td class="px-6 py-4">{{ $request->end_date }}</td>
                                <td class="px-6 py-4">
                                    @if (is_null($request->is_approved))
                                    <span class="text-red-600">Ditolak</span>
                                    @elseif ($request->is_approved)
                                    <span class="text-green-600">Disetujui</span>
                                    @else
                                    <span class="text-yellow-500">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if (Auth::user()->role->name === 'Administrator')
                                        <a href="{{ Storage::url($request->attachment) }}" class="text-black-600 hover:underline" target="_blank">Lihat File</a>
                                        @elseif ($request->attachment === null)
                                        <span class="text-gray-600">Tidak ada lampiran</span>
                                        @else
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    @if (Auth::user()->role->name === 'Administrator' && $request->is_approved === false)
                                        <form action="{{ route('leave_requests.approve', $request) }}" method="POST" class="inline">
                                            @csrf
                                            <x-primary-button type="submit" class="text-white px-3 py-1 rounded p-3 rounded">
                                                Setujui
                                            </x-primary-button>
                                        </form>
                                        <form action="{{ route('leave_requests.reject', $request) }}" method="POST" class="inline">
                                            @csrf
                                            <x-primary-button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                                Tolak
                                            </x-primary-button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $leaveRequests->links() }}
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
