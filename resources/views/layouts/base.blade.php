<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Teman Sebayaku') }} - @yield('title', 'Dashboard')</title>
    <meta name="description" content="@yield('description', 'Aplikasi konseling sebaya berbasis budaya untuk meningkatkan kesejahteraan psikologis remaja.')">
    <link rel="icon" href="{{ asset('image/logo-mark.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-inter antialiased bg-slate-50 text-slate-800 min-h-screen">
    @yield('body')
    @stack('scripts')
</body>
</html>
