@extends('layouts.konseli')

@section('title', 'Hasil Kuesioner Wellbeing')

@section('content')
@php
    $score = $answer->total_score;
    $maxPossibleScore = \App\Models\Question::count() * 4; // Each question max score is 4
    $percentage = round(($score / $maxPossibleScore) * 100);
@endphp

<div class="max-w-2xl mx-auto space-y-8 animate-fade-in pb-16">
    <div class="card p-6 bg-white border border-slate-200/80 text-center relative overflow-hidden">
        {{-- Glowing blobs --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-20">
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-500 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-indigo-500 rounded-full blur-2xl"></div>
        </div>

        <div class="relative z-10 space-y-6">
            <div>
                <span class="text-xs font-bold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-lg border border-blue-100 uppercase tracking-wider">
                    Hasil Pengukuran
                </span>
                <h2 class="text-2xl font-extrabold text-slate-800 mt-3">Hasil {{ str_replace('_', ' ', strtoupper($answer->type)) }}</h2>
                <p class="text-xs text-slate-400 mt-1">Nama Pengisi: <strong class="text-slate-600">{{ $answer->konseli_name }}</strong> &bull; Selesai Pada: {{ $answer->completed_at->format('d M Y H:i') }}</p>
            </div>

            {{-- Circular score display --}}
            <div class="relative w-40 h-40 mx-auto flex items-center justify-center">
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="42" stroke="#f1f5f9" stroke-width="8" fill="transparent" />
                    <circle cx="50" cy="50" r="42" stroke="url(#blueGradient)" stroke-width="8" fill="transparent" 
                            stroke-dasharray="263.89" 
                            stroke-dashoffset="{{ 263.89 - (263.89 * $percentage / 100) }}"
                            stroke-linecap="round" class="transition-all duration-1000 ease-out" />
                    <defs>
                        <linearGradient id="blueGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#3b82f6" />
                            <stop offset="100%" stop-color="#6366f1" />
                        </linearGradient>
                    </defs>
                </svg>
                <div class="absolute text-center">
                    <span class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">{{ $score }}</span>
                    <span class="text-xs font-bold text-slate-400 block mt-0.5">dari {{ $maxPossibleScore }} Poin</span>
                </div>
            </div>

            {{-- Score interpretation --}}
            <div class="p-5 bg-slate-50 border border-slate-100 rounded-3xl max-w-lg mx-auto text-left">
                <h4 class="font-bold text-slate-800 text-sm mb-2 text-center uppercase tracking-wider text-blue-600">Interpretasi & Rekomendasi</h4>
                <p class="text-sm text-slate-600 leading-relaxed font-semibold">
                    {{ $answer->interpretation->description ?? 'Deskripsi interpretasi tidak ditemukan.' }}
                </p>
            </div>

            {{-- Action buttons --}}
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3 justify-center">
                <a href="{{ route('konseli.wellbeing.pdf', $answer->type) }}" target="_blank" class="w-full sm:w-auto btn-primary bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 font-bold flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Laporan (PDF)
                </a>
                <a href="{{ route('konseli.dashboard') }}" class="w-full sm:w-auto btn-secondary px-6 py-3 font-semibold text-center">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
