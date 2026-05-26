@extends('layouts.base')

@section('body')
<div class="min-h-screen flex flex-col">
    {{-- Top Navbar --}}
    <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-lg border-b border-slate-200 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('konseli.dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('image/logo-mark.png') }}" alt="Teman Sebayaku" class="w-8 h-8 rounded-lg object-cover shadow-sm">
                    <span class="font-extrabold text-slate-800">Teman Sebayaku</span>
                </a>
                
                {{-- Desktop Links --}}
                <nav class="hidden sm:flex items-center gap-4">
                    <a href="{{ route('konseli.dashboard') }}" class="text-sm font-semibold {{ request()->routeIs('konseli.dashboard') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">Beranda</a>
                    <a href="{{ route('konseli.lessons.index') }}" class="text-sm font-semibold {{ request()->routeIs('konseli.lessons.*') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">Materi</a>
                    <a href="{{ route('konseli.wellbeing.index') }}" class="text-sm font-semibold {{ request()->routeIs('konseli.wellbeing.*') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">Wellbeing</a>
                    <a href="{{ route('konseli.counselor.index') }}" class="text-sm font-semibold {{ request()->routeIs('konseli.counselor.*') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">Pilih Konselor</a>
                    <a href="{{ route('konseli.tribe.index') }}" class="text-sm font-semibold {{ request()->routeIs('konseli.tribe.*', 'konseli.self-help.*') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">Self-Help</a>
                    <a href="{{ route('konseli.profile.edit') }}" class="text-sm font-semibold {{ request()->routeIs('konseli.profile.*') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">Profil</a>
                </nav>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-slate-500 hidden sm:block">Halo, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-bold transition-colors">Keluar</button>
                </form>
            </div>
        </div>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="max-w-5xl mx-auto px-4 mt-4">
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="max-w-5xl mx-auto px-4 mt-4">
        <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1 max-w-5xl mx-auto w-full px-4 py-6">
        @yield('content')
    </main>

    {{-- Bottom Navigation (Mobile) --}}
    <nav class="fixed bottom-0 inset-x-0 bg-white border-t border-slate-200 sm:hidden z-30 safe-bottom">
        <div class="grid grid-cols-6 gap-1 px-2 py-2">
            <a href="{{ route('konseli.dashboard') }}" class="flex flex-col items-center gap-1 py-1 text-xs {{ request()->routeIs('konseli.dashboard') ? 'text-blue-600' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Beranda</span>
            </a>
            <a href="{{ route('konseli.lessons.index') }}" class="flex flex-col items-center gap-1 py-1 text-xs {{ request()->routeIs('konseli.lessons.*') ? 'text-blue-600' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>Materi</span>
            </a>
            <a href="{{ route('konseli.wellbeing.index') }}" class="flex flex-col items-center gap-1 py-1 text-xs {{ request()->routeIs('konseli.wellbeing.*') ? 'text-blue-600' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Wellbeing</span>
            </a>
            <a href="{{ route('konseli.counselor.index') }}" class="flex flex-col items-center gap-1 py-1 text-xs {{ request()->routeIs('konseli.counselor.*') ? 'text-blue-600' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Konselor</span>
            </a>
            <a href="{{ route('konseli.tribe.index') }}" class="flex flex-col items-center gap-1 py-1 text-xs {{ request()->routeIs('konseli.tribe.*', 'konseli.self-help.*') ? 'text-blue-600' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>Self-Help</span>
            </a>
            <a href="{{ route('konseli.profile.edit') }}" class="flex flex-col items-center gap-1 py-1 text-xs {{ request()->routeIs('konseli.profile.*') ? 'text-blue-600' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>Profil</span>
            </a>
        </div>
    </nav>
</div>
@endsection
