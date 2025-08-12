<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="min-h-screen bg-gradient-to-tr from-emerald-100 via-white to-emerald-50 font-sans text-gray-800 antialiased">
    <div class="flex min-h-screen items-center justify-center px-4 py-12">
        <div class="relative w-full max-w-md">
            <!-- Decorative background blob -->
            <div
                class="absolute -top-10 -left-10 w-40 h-40 bg-emerald-300 opacity-20 rounded-full blur-2xl animate-pulse">
            </div>

            <!-- Card -->
            <div class="relative z-10 bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
                <div class="flex flex-col items-center mb-6">
                    <a href="/">
                        <img src="{{ asset('storage/logo.png') }}" alt="Logo"
                            class="h-16 w-16 object-contain drop-shadow-md">
                    </a>
                    <h2 class="mt-4 text-xl font-semibold text-emerald-600">Selamat Datang Kembali</h2>
                    <p class="text-sm text-gray-500">Silakan login untuk melanjutkan</p>
                </div>

                {{ $slot }}

                <div class="mt-6 text-xs text-gray-400 text-center">
                    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>

</html>
