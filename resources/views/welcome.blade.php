<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Leave Submission</title>
    @vite('resources/css/app.css') <!-- Assuming you're using Vite -->
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-500">{{ config('app.name', 'Laravel') }}</h1>
            <nav>
                @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-blue-600  hover:text-blue-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            </nav>
        </div>
    </header>

    <main class="mt-10">
        <section class="text-center px-6">
            <h2 class="text-4xl font-extrabold mb-4">Selamat Datang Di Pengajuan Cuti</h2>
            <p class="text-lg mb-8">Kelola cuti Anda dengan cepat dan efisien dengan portal sederhana kami.</p>
            <a href="{{ route('login') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">Buat Permohonan Cuti!</a>
        </section>

        <section id="leave-form" class="mt-20 px-6">
            <div class="bg-white max-w-2xl mx-auto p-8 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold mb-6">Form Pengajuan Cuti (Segera Hadir 🚀)</h3>
                <p class="text-gray-600">Stay tuned. Form pengajuan cuti akan segera hadir.</p>
            </div>
        </section>
    </main>

    <footer class="mt-20 bg-gray-200 text-center py-4">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </footer>

</body>
</html>
