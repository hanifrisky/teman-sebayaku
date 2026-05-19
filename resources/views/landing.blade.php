@extends('layouts.base')

@section('title', 'Beranda')
@section('description', 'Teman Sebayaku - Aplikasi konseling sebaya berbasis budaya untuk meningkatkan kesejahteraan psikologis remaja.')

@section('body')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">
    {{-- Navbar --}}
    <nav class="fixed top-0 inset-x-0 z-50 bg-white/5 backdrop-blur-lg border-b border-white/10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/30">TS</div>
                <span class="text-xl font-bold text-white">Teman Sebayaku</span>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-blue-200 hover:text-white font-medium transition-colors px-4 py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 px-4 sm:px-6">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-blue-400/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
        </div>
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/20 backdrop-blur rounded-full text-blue-300 text-sm font-medium mb-8 border border-blue-400/20">
                <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                Konseling Sebaya Berbasis Budaya
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Tingkatkan <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Kesejahteraan</span> Psikologismu
            </h1>
            <p class="text-lg sm:text-xl text-blue-200/80 mb-10 max-w-2xl mx-auto leading-relaxed">
                Temukan konselor sebaya yang tepat, akses materi self-help berbasis kearifan budaya, dan ukur kesejahteraan psikologismu melalui instrumen wellbeing.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-2xl shadow-2xl shadow-blue-500/30 hover:shadow-blue-500/50 hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-lg">
                    Mulai Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="#features" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 backdrop-blur text-white font-semibold rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300 text-lg">
                    Pelajari Lebih
                </a>
            </div>

            {{-- Quick Login Panel for Testing --}}
            <div class="mt-12 p-6 bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl max-w-md mx-auto shadow-2xl animate-slide-up">
                <p class="text-xs font-semibold text-blue-300 uppercase tracking-wider mb-4 text-center">Pintasan Uji Coba (Quick Login)</p>
                <div class="grid grid-cols-3 gap-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="email" value="admin@temansebayaku.com">
                        <input type="hidden" name="password" value="password">
                        <button type="submit" class="w-full text-xs font-bold text-white bg-rose-500/20 hover:bg-rose-500/40 border border-rose-500/30 px-3 py-3 rounded-xl transition-all duration-300 hover:scale-[1.03] active:scale-95">
                            Admin
                        </button>
                    </form>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="email" value="budi@temansebayaku.com">
                        <input type="hidden" name="password" value="password">
                        <button type="submit" class="w-full text-xs font-bold text-white bg-emerald-500/20 hover:bg-emerald-500/40 border border-emerald-500/30 px-3 py-3 rounded-xl transition-all duration-300 hover:scale-[1.03] active:scale-95">
                            Konselor
                        </button>
                    </form>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="email" value="konseli@temansebayaku.com">
                        <input type="hidden" name="password" value="password">
                        <button type="submit" class="w-full text-xs font-bold text-white bg-sky-500/20 hover:bg-sky-500/40 border border-sky-500/30 px-3 py-3 rounded-xl transition-all duration-300 hover:scale-[1.03] active:scale-95">
                            Konseli
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="py-20 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Fitur Utama</h2>
                <p class="text-blue-200/70 text-lg max-w-2xl mx-auto">Dirancang untuk mendukung proses konseling sebaya yang efektif dan terukur</p>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                {{-- Feature 1 --}}
                <div class="group p-8 bg-white/5 backdrop-blur-lg rounded-2xl border border-white/10 hover:bg-white/10 hover:border-blue-400/30 transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/25 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Instrumen Wellbeing</h3>
                    <p class="text-blue-200/70 leading-relaxed">Ukur tingkat kesejahteraan psikologismu melalui kuesioner pre-test dan post-test yang terstandar.</p>
                </div>
                {{-- Feature 2 --}}
                <div class="group p-8 bg-white/5 backdrop-blur-lg rounded-2xl border border-white/10 hover:bg-white/10 hover:border-blue-400/30 transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-cyan-500/25 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Materi Self-Help</h3>
                    <p class="text-blue-200/70 leading-relaxed">Akses materi self-help berbasis kearifan budaya lokal dengan metode refleksi WDEP.</p>
                </div>
                {{-- Feature 3 --}}
                <div class="group p-8 bg-white/5 backdrop-blur-lg rounded-2xl border border-white/10 hover:bg-white/10 hover:border-blue-400/30 transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-400/25 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Konselor Sebaya</h3>
                    <p class="text-blue-200/70 leading-relaxed">Pilih konselor sebaya yang tepat dan hubungi langsung melalui WhatsApp untuk konsultasi.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-white/10 py-8 px-4">
        <div class="max-w-6xl mx-auto text-center text-blue-300/50 text-sm">
            &copy; {{ date('Y') }} Teman Sebayaku. All rights reserved.
        </div>
    </footer>
</div>
@endsection
