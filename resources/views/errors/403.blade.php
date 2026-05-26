@extends('layouts.base')

@section('title', '403 Akses Ditolak - Teman Sebayaku')

@section('body')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white relative overflow-hidden px-4 select-none">
    
    {{-- Glow Background Effects --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1.5s"></div>
    </div>

    {{-- Content Container --}}
    <div class="max-w-md w-full bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl rounded-3xl p-8 sm:p-10 text-center relative z-10 animate-slide-up">
        
        {{-- Brand Logo --}}
        <div class="flex justify-center mb-6">
            <a href="/" class="flex flex-col items-center gap-2 group">
                <img src="{{ asset('image/logo-mark.png') }}" alt="Teman Sebayaku" class="w-12 h-12 rounded-xl object-cover shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                <span class="text-sm font-bold text-slate-400 group-hover:text-slate-300 transition-colors uppercase tracking-widest">Teman Sebayaku</span>
            </a>
        </div>

        {{-- Glowing Icon / Graphic --}}
        <div class="relative w-28 h-28 mx-auto mb-6 flex items-center justify-center">
            {{-- Pulsing background glow behind shield --}}
            <div class="absolute inset-0 bg-blue-500/20 rounded-full blur-xl animate-ping scale-75 opacity-70"></div>
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-500/30 to-indigo-500/30 rounded-full border border-white/10 shadow-inner flex items-center justify-center">
                {{-- Premium Security Shield Icon --}}
                <svg class="w-12 h-12 text-blue-400 filter drop-shadow-[0_0_8px_rgba(96,165,250,0.5)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
        </div>

        {{-- Big Error Number --}}
        <h1 class="text-7xl font-extrabold tracking-tighter bg-gradient-to-r from-blue-400 via-cyan-300 to-indigo-400 bg-clip-text text-transparent mb-2">
            403
        </h1>
        
        {{-- Short Title --}}
        <h2 class="text-xl font-bold text-white mb-3">
            Akses Dibatasi
        </h2>

        {{-- Error Message --}}
        <p class="text-slate-300 text-sm leading-relaxed mb-8 font-medium px-2">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki akses ke halaman ini.' }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 items-stretch justify-center">
            <a href="/" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-blue-500/25 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Ke Landing Page
            </a>
            <button onclick="window.history.length > 1 ? window.history.back() : window.location.href='/'" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white/5 hover:bg-white/10 text-slate-200 hover:text-white font-bold rounded-2xl border border-white/10 hover:border-white/20 transition-all duration-300 active:scale-[0.98] text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </button>
        </div>

    </div>
</div>
@endsection
