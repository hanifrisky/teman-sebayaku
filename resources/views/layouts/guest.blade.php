<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Teman Sebayaku') }} - Masuk / Daftar</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-inter antialiased bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 text-slate-100 min-h-screen">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden px-4">
            {{-- Glowing Background Blobs --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-blue-400/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
            </div>

            <div class="relative z-10">
                <a href="/" class="flex flex-col items-center gap-3 mb-6 group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-extrabold text-2xl shadow-xl shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">TS</div>
                    <span class="text-2xl font-extrabold bg-gradient-to-r from-blue-200 to-white bg-clip-text text-transparent">Teman Sebayaku</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-8 bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl overflow-hidden rounded-3xl relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
