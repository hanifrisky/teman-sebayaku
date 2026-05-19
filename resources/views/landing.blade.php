@extends('layouts.base')

@section('title', 'Beranda - Teman Sebayaku')
@section('description', 'Model Peer Counseling Berbantuan Digital Self-Help Bermuatan Nilai Kearifan Lokal untuk Meningkatkan Well-Being Remaja')

@section('body')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white selection:bg-blue-500 selection:text-white">
    
    {{-- Decorative Background Elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute top-1/3 left-10 w-[400px] h-[400px] bg-indigo-500/5 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
        <div class="absolute bottom-1/4 right-10 w-[450px] h-[450px] bg-cyan-500/10 rounded-full blur-[110px] animate-pulse" style="animation-delay: 4s"></div>
    </div>

    {{-- Navbar --}}
    <nav class="fixed top-0 inset-x-0 z-50 bg-slate-950/70 backdrop-blur-md border-b border-white/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('image/logo-mark.png') }}" alt="Teman Sebayaku" class="w-10 h-10 rounded-xl object-cover shadow-lg shadow-blue-500/20">
                <div class="flex flex-col">
                    <span class="text-base font-black tracking-tight text-white leading-none">Teman Sebayaku</span>
                    <span class="text-[9px] font-bold text-blue-300 tracking-widest uppercase mt-0.5">LPPD-KEMENDIKTI SAINTEK</span>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                {{-- Logos in Navbar --}}
                <div class="hidden lg:flex items-center gap-3 bg-white/5 border border-white/10 rounded-2xl px-4 py-1.5">
                    <img src="{{ asset('image/logo/Diktisaintek.png') }}" alt="LPPD-KEMENDIKTI SAINTEK" class="h-7 object-contain">
                    <div class="h-5 w-px bg-white/20 mx-1"></div>
                    <img src="{{ asset('image/logo/logo-um.webp') }}" alt="UM" class="h-6 object-contain">
                    <img src="{{ asset('image/logo/logo-uny.png') }}" alt="UNY" class="h-6 object-contain">
                    <img src="{{ asset('image/logo/logo-unp.png') }}" alt="UNP" class="h-6 object-contain">
                </div>
                
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition-all duration-200 text-sm hover:scale-[1.02]">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-300 hover:text-white transition-colors px-4 py-2">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition-all duration-200 text-sm hover:scale-[1.02]">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero & Welcome Section --}}
    <section class="relative pt-32 pb-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto text-center relative z-10">
            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 bg-blue-500/10 backdrop-blur border border-blue-400/20 rounded-full text-blue-300 text-xs font-black uppercase tracking-wider mb-8 animate-fade-in">
                <span class="w-2 h-2 bg-blue-400 rounded-full animate-ping"></span>
                Model Peer Counseling Berbantuan Digital Self-Help
                <br>Bermuatan Nilai Kearifan Lokal Untuk Meningkatkan Well-Being Remaja
            </div>
            
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight mb-8">
                Selamat Datang di <span class="bg-gradient-to-r from-blue-400 via-cyan-400 to-indigo-400 bg-clip-text text-transparent">Teman Sebayaku</span>
            </h1>

            {{-- Institutional Partner Logos Row --}}
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 py-5 px-8 bg-white/5 border border-white/10 rounded-3xl max-w-3xl mx-auto shadow-xl backdrop-blur-md mb-10 hover:border-white/20 transition-all duration-300">
                <div class="flex flex-col items-center gap-1.5">
                    <span class="text-[9px] font-black text-blue-400 tracking-widest uppercase">PROGRAM PENDUKUNG</span>
                    <img src="{{ asset('image/logo/Diktisaintek.png') }}" alt="LPPD-KEMENDIKTI SAINTEK" class="h-10 sm:h-12 object-contain hover:scale-105 transition-transform duration-200">
                </div>
                <div class="hidden sm:block h-10 w-px bg-white/10"></div>
                <div class="flex flex-col items-center gap-1.5">
                    <span class="text-[9px] font-black text-slate-400 tracking-widest uppercase">KOLABORASI UNIVERSITAS</span>
                    <div class="flex items-center gap-4 sm:gap-6">
                        <img src="{{ asset('image/logo/logo-um.webp') }}" alt="UM" class="h-8 sm:h-10 object-contain hover:scale-105 transition-transform duration-200">
                        <img src="{{ asset('image/logo/logo-uny.png') }}" alt="UNY" class="h-8 sm:h-10 object-contain hover:scale-105 transition-transform duration-200">
                        <img src="{{ asset('image/logo/logo-unp.png') }}" alt="UNP" class="h-8 sm:h-10 object-contain hover:scale-105 transition-transform duration-200">
                    </div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 sm:p-8 text-left space-y-6 max-w-4xl mx-auto shadow-2xl">
                <p class="text-base sm:text-lg text-slate-200 font-semibold leading-relaxed">
                    Platform ini merupakan pusat bantuan <strong>Model Peer Counseling Berbantuan Digital Self-Help Bermuatan Nilai Kearifan Lokal untuk Meningkatkan Well-Being Remaja</strong> dengan muatan nilai kearifan lokal untuk meningkatkan well-being pada siswa SLTA.
                </p>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-medium">
                    Tujuan utama platform <strong>“Teman Sebayaku”</strong> adalah untuk membantu kamu meningkatkan kondisi <strong>“well-being”</strong> yang berperan penting terhadap kondisi kamu menghadapi tantangan.
                </p>
                
                <div class="border-t border-slate-800 pt-6">
                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed mb-6 font-medium">
                        Tentunya kondisi well-being pada individu sangat erat kaitannya dengan kesehatan mental yang dimiliki. Selain itu well-being berkontribusi terhadap:
                    </p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @php
                            $wellbeingPoints = [
                                'Hubungan Sosial',
                                'Produktivitas',
                                'Resiliensi',
                                'Kemampuan Adaptabilitas',
                                'Kebermaknaan Hidup',
                                'Kondisi Fisik'
                            ];
                        @endphp
                        @foreach($wellbeingPoints as $idx => $point)
                            <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/5 hover:border-blue-500/20 hover:bg-white/10 transition-all duration-200">
                                <span class="w-7 h-7 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center font-extrabold text-xs">
                                    {{ $idx + 1 }}
                                </span>
                                <span class="text-xs sm:text-sm font-bold text-slate-200">{{ $point }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <p class="text-sm text-slate-300 leading-relaxed font-medium pt-2">
                    Tahapan self-help ini didesain berdasarkan tahapan <strong>WDEP (Want; Do/Doing; Evaluation; Planning)</strong> yang memudahkan kamu untuk dapat bertanggung jawab terhadap apa yang menjadi pilihan kalian.
                </p>
                
                <p class="text-xs sm:text-sm text-blue-300 leading-relaxed bg-blue-500/10 border border-blue-500/20 p-4 rounded-2xl font-bold italic">
                    "Melalui platform Teman Sebayaku yang merupakan media pendukung dalam pelaksanaan Model Peer Counseling Berbantuan Digital Self-Help Bermuatan Nilai Kearifan Lokal untuk Meningkatkan Well-Being Remaja diharapkan dapat mencegah permasalahan terkait dengan kesehatan mental dan menjadi pribadi yang cerdas emosi."
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-10">
                <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-extrabold rounded-2xl shadow-xl shadow-blue-500/20 hover:shadow-blue-500/40 hover:from-blue-600 hover:to-indigo-700 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 text-base">
                    Mulai Sesi Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="#langkah" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/5 backdrop-blur text-slate-200 font-bold rounded-2xl border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-300 text-base">
                    Panduan Alur
                </a>
            </div>
        </div>
    </section>

    {{-- Steps Section --}}
    <section id="langkah" class="py-20 px-4 sm:px-6 lg:px-8 border-t border-white/5 bg-slate-950/40 relative">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-2xl sm:text-3xl font-black text-white mb-4">Langkah Menggunakan Self-Help Teman Sebayaku</h2>
                <p class="text-slate-400 text-sm max-w-xl mx-auto font-medium">Ikuti alur berikut untuk memulai perjalanan bimbingan digital self-help kamu</p>
            </div>
            
            <div class="relative pl-6 sm:pl-8 border-l border-blue-500/30 space-y-8 max-w-2xl mx-auto">
                @php
                    $steps = [
                        'Silakan register akun baru di platform',
                        'Masuk melalui menu log-in menggunakan akun terdaftar',
                        'Mengisi kuesioner instrumen well-being sebelum mengikuti sesi self-help (Pre-Test)',
                        'Memilih muatan budaya yang sesuai dengan suku-nilai budaya kamu',
                        'Melakukan sesi refleksi mandiri Self-Help berbasis WDEP',
                        'Mengisi kuesioner instrumen well-being (Post-Test) setelah sesi',
                        'Mengkomunikasikan hasil kerja self-help dengan peer counselor (Konselor)',
                        'Menghubungi Konselor Sekolah jika dibutuhkan sesi konseling lanjutan'
                    ];
                @endphp
                @foreach($steps as $idx => $step)
                    <div class="relative group">
                        {{-- Timeline Dot --}}
                        <div class="absolute -left-[35px] sm:-left-[43px] top-0.5 w-6 h-6 rounded-full bg-slate-900 border-2 border-blue-500 flex items-center justify-center text-[10px] font-black text-blue-400 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-200">
                            {{ $idx + 1 }}
                        </div>
                        <div class="p-4 bg-white/5 border border-white/5 rounded-2xl hover:border-blue-500/20 hover:bg-white/10 transition-all duration-300">
                            <p class="text-sm sm:text-base font-bold text-slate-200 leading-relaxed">{{ $step }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Team Section --}}
    <section id="pengembang" class="py-20 px-4 sm:px-6 lg:px-8 border-t border-white/5">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-2xl sm:text-3xl font-black text-white mb-4">Tentang Tim Pengembang</h2>
                <p class="text-slate-400 text-sm max-w-xl mx-auto font-medium">Tim pakar bimbingan konseling dan sains teknologi pengembang platform Teman Sebayaku</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $team = [
                        ['name' => 'Prof. Dr. M. Ramli, M.A', 'role' => 'FIP Universitas Negeri Malang', 'initials' => 'MR', 'grad' => 'from-blue-500 to-indigo-600', 'photo' => 'image/team/ramli.png'],
                        ['name' => 'Prof. Dr. Budi Astuti, M.Si', 'role' => 'FIP Universitas Negeri Yogyakarta', 'initials' => 'BA', 'grad' => 'from-purple-500 to-pink-600', 'photo' => 'image/team/budi-astuti.png'],
                        ['name' => 'Dr. Miftahul Fikri, M.Pd', 'role' => 'FIP Universitas Negeri Padang', 'initials' => 'MF', 'grad' => 'from-emerald-500 to-teal-600', 'photo' => 'image/team/miftahul-fikri.png'],
                        ['name' => 'Dr. Diniy Hidayatur Rahman, S.Pd., M.Pd', 'role' => 'FIP Universitas Negeri Malang', 'initials' => 'DR', 'grad' => 'from-orange-500 to-rose-600', 'photo' => 'image/team/diniy.png'],
                        ['name' => 'Nur Mega Aris Saputra, S.Pd., M.Pd', 'role' => 'FIP Universitas Negeri Malang', 'initials' => 'AS', 'grad' => 'from-cyan-500 to-blue-600', 'photo' => 'image/team/aris-saputra.png'],
                        ['name' => 'Nail Hidaya Afandi, S.Pd., M.Pd', 'role' => 'FIP Universitas Negeri Malang', 'initials' => 'NA', 'grad' => 'from-indigo-500 to-purple-600', 'photo' => 'image/team/nail.png'],
                        ['name' => 'Muh. Nur Alamsyah, S.Pd., M.Pd', 'role' => 'FIP Universitas Negeri Malang', 'initials' => 'MA', 'grad' => 'from-pink-500 to-red-600', 'photo' => 'image/team/alamsyah.png'],
                    ];
                @endphp
                @foreach($team as $member)
                    <div class="group p-6 bg-white/5 border border-white/5 rounded-3xl hover:border-blue-500/20 hover:bg-white/10 hover:shadow-2xl hover:shadow-blue-500/5 transition-all duration-300 flex flex-col items-center text-center">
                        {{-- Photo or Initials --}}
                        @if(isset($member['photo']) && file_exists(public_path($member['photo'])))
                            <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-lg mb-4 group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset($member['photo']) }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br {{ $member['grad'] }} flex items-center justify-center text-white font-black text-xl shadow-lg mb-4 group-hover:scale-105 transition-transform duration-300">
                                {{ $member['initials'] }}
                            </div>
                        @endif
                        <h3 class="text-sm sm:text-base font-black text-slate-100 mb-2 leading-snug group-hover:text-blue-300 transition-colors">
                            {{ $member['name'] }}
                        </h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider leading-relaxed">
                            {{ $member['role'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Contact & Footer Section --}}
    <footer id="kontak" class="border-t border-white/10 bg-slate-950 py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 border-b border-white/5 pb-12">
            {{-- Left column --}}
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('image/logo-mark.png') }}" alt="Teman Sebayaku" class="w-8 h-8 rounded-lg object-cover shadow-lg">
                    <span class="text-lg font-black text-white">Teman Sebayaku</span>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed font-medium">
                    Platform Peer Counseling dan Digital Self-Help bermuatan nilai kearifan lokal. Didukung oleh LPPD-KEMENDIKTI SAINTEK bekerjasama dengan Universitas Negeri Malang, Universitas Negeri Yogyakarta, dan Universitas Negeri Padang.
                </p>
            </div>
            
            {{-- Right column --}}
            <div class="space-y-6">
                <h4 class="text-sm font-black text-slate-200 uppercase tracking-widest">Informasi Kontak & Alamat</h4>
                <div class="space-y-4">
                    <div class="flex items-start gap-3 text-slate-300 text-sm">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <div>
                            <p class="font-bold text-slate-200 mb-0.5">Alamat:</p>
                            <p class="font-medium text-slate-400">Departemen Bimbingan dan Konseling FIP UM<br>Jl. Semarang No 5 Kota Malang</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 text-slate-300 text-sm">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <div>
                            <p class="font-bold text-slate-200 mb-0.5">Kontak:</p>
                            <p class="font-medium text-slate-400">+62812-3175-0634</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 text-slate-300 text-sm">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <div>
                            <p class="font-bold text-slate-200 mb-0.5">Email:</p>
                            <a href="mailto:aris.saputra.fip@um.ac.id" class="font-medium text-blue-400 hover:text-blue-300 hover:underline transition-colors">aris.saputra.fip@um.ac.id</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="max-w-6xl mx-auto text-center pt-8 text-slate-500 text-xs font-bold uppercase tracking-wider">
            &copy; {{ date('Y') }} Teman Sebayaku. All rights reserved. • LPPD-KEMENDIKTI SAINTEK-UM-UNY-UNP
        </div>
    </footer>
</div>
@endsection
