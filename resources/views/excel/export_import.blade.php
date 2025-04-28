<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import & Export') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <form method="POST" action="{{ route('export_excel') }}" class="space-y-4">
                            @csrf
                            <div class="mb-4">
                                <label class="font-semibold text-sm">Export Model:</label>
                                <select name="model" class="block w-full border p-2 rounded-lg">
                                    <option value="">Pilih Model</option>
                                    <option value="App\Models\User">User</option>
                                    <option value="App\Models\LeaveRequest">LeaveRequest</option>
                                    <option value="App\Models\LeaveTypes">LeaveTypes</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="font-semibold text-sm">Fields: (Arsir Untuk Memilih / CTRL + Click)</label>
                                <select name="fields[]" class="block w-full border p-2 rounded-lg" multiple>
                                    <!-- Fields akan di-load disini melalui JS -->
                                </select>
                            </div>

                            @if (session('export_filename'))
                                <a href="{{ route('export.download', ['filename' => session('export_filename')]) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Download File</a>
                            @endif

                            <x-secondary-button type="submit" class="">
                                Export
                            </x-secondary-button>
                        </form>

                    </div>

                <div class="p-6 bg-white border-b border-gray-200">

                        <!-- Import Form -->
                        <form method="POST" action="{{ route('import_excel') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="font-semibold">Import Model :</label>
                                <select name="model" class="block w-full border p-2 rounded-lg">
                                    <option value="">Pilih Model</option>
                                    <option value="App\Models\User">User</option>
                                    <option value="App\Models\LeaveRequest">LeaveRequest</option>
                                    <option value="App\Models\LeaveTypes">LeaveTypes</option>
                                    <!-- Tambah model lain -->
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="font-semibold">File:</label>
                                <input type="file" name="file" class="block border p-2">
                            </div>
                            <x-secondary-button type="submit" class="">Import</x-secondary-button>
                        </form>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('select[name="model"]').addEventListener('change', function() {
            let model = this.value;

            fetch("{{ route('get-fields') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ model: model })
            })
            .then(response => response.json())
            .then(data => {
                let fieldsSelect = document.querySelector('select[name="fields[]"]');
                fieldsSelect.innerHTML = '';

                data.fields.forEach(field => {
                    let option = document.createElement('option');
                    option.value = field;
                    option.textContent = field;
                    fieldsSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching fields:', error));
        });
    </script>
</x-app-layout>
