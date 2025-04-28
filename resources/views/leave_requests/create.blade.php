<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Ajukan Cuti') }}
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('leave_requests.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="leave_type_id" class="block text-gray-700">Tipe Cuti</label>
                        <select name="leave_type_id" id="leave_type_id" class="mt-1 block w-full" required>
                            <option value="">Pilih Tipe Cuti</option>
                            @foreach($leaveTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="start_date" class="block text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="mt-1 block w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="block text-gray-700">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="mt-1 block w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="attachment" class="block text-gray-700">Lampiran (PDF)</label>
                        <input type="file" name="attachment" id="attachment" class="mt-1 block w-full" accept="application/pdf">
                        <small class="text-gray-500">Ukuran 100KB - 500KB</small>
                    </div>

                    <div class="mb-4">
                        <label for="metadata" class="block text-gray-700">deskripsi (Opsional)</label>
                        <textarea name="metadata[notes]" id="metadata" rows="3" class="mt-1 block w-full" placeholder="Catatan tambahan..."></textarea>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Ajukan
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
