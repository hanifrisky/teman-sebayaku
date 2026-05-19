@extends('layouts.konseli')

@section('title', 'Beranda Konseli')

@section('content')
@php
    $user = auth()->user();
    
    // Check progress
    $preTest = $user->wellbeingAnswers()->where('type', 'pre_test')->first();
    $preTestCompleted = $preTest && $preTest->status === 'completed';
    
    $counselorSelected = !is_null($user->selected_counselor_id);
    
    $tribeSelected = !is_null($user->selected_tribe_id);
    
    // Check self-help progress: did they answer at least one WDEP question?
    $hasSelfHelpAnswers = \App\Models\SelfHelpAnswer::where('konseli_id', $user->id)->exists();
    
    $postTest = $user->wellbeingAnswers()->where('type', 'post_test')->first();
    $postTestCompleted = $postTest && $postTest->status === 'completed';
@endphp

<div class="space-y-8 animate-fade-in pb-16">
    {{-- Header --}}
    <div class="p-6 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-3xl text-white shadow-xl shadow-blue-500/10">
        <h3 class="text-2xl font-bold">Halo, {{ $user->name }}!</h3>
        <p class="text-blue-100 mt-1.5 text-sm">Selamat datang di Teman Sebayaku. Mari ikuti langkah-langkah di bawah untuk mengeksplorasi ketahanan mental dan kesejahteraan psikologismu.</p>
    </div>

    {{-- Progress Steps --}}
    <div class="space-y-5">
        <h4 class="font-extrabold text-slate-800 text-lg">Peta Jalan (Roadmap) Bimbingan Anda</h4>
        
        <div class="grid grid-cols-1 gap-4">
            
            {{-- Step 1: Pre-Test --}}
            <div class="card p-5 flex items-start gap-4 {{ $preTestCompleted ? 'border-emerald-200 bg-emerald-50/10' : 'border-slate-200' }}">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 font-bold text-sm {{ $preTestCompleted ? 'bg-emerald-100 text-emerald-600' : 'bg-blue-100 text-blue-600' }}">
                    @if($preTestCompleted)
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    @else
                        1
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <h5 class="font-bold text-slate-800 text-sm">Langkah 1: Mengisi Pre-Test Wellbeing</h5>
                        <span class="text-xs font-bold {{ $preTestCompleted ? 'text-emerald-600 bg-emerald-100/60' : 'text-amber-600 bg-amber-50' }} px-2.5 py-0.5 rounded-lg border border-current/10">
                            {{ $preTestCompleted ? 'Selesai' : 'Belum Selesai' }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">Ukur tingkat kesejahteraan psikologis awal Anda sebelum memulai program bimbingan dengan instrumen wellbeing terstandar.</p>
                    <div class="mt-3.5">
                        @if($preTestCompleted)
                            <a href="{{ route('konseli.wellbeing.result', 'pre_test') }}" class="btn-secondary btn-sm">Lihat Skor Pre-Test</a>
                        @else
                            <a href="{{ route('konseli.wellbeing.index') }}" class="btn-primary btn-sm bg-gradient-to-r from-blue-500 to-blue-600">Ambil Pre-Test</a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Step 2: Choose Counselor --}}
            <div class="card p-5 flex items-start gap-4 {{ $counselorSelected ? 'border-emerald-200 bg-emerald-50/10' : 'border-slate-200' }}">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 font-bold text-sm {{ $counselorSelected ? 'bg-emerald-100 text-emerald-600' : 'bg-blue-100 text-blue-600' }}">
                    @if($counselorSelected)
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    @else
                        2
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <h5 class="font-bold text-slate-800 text-sm">Langkah 2: Pilih Konselor</h5>
                        <span class="text-xs font-bold {{ $counselorSelected ? 'text-emerald-600 bg-emerald-100/60' : 'text-amber-600 bg-amber-50' }} px-2.5 py-0.5 rounded-lg border border-current/10">
                            {{ $counselorSelected ? 'Selesai' : 'Belum Selesai' }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        @if($counselorSelected)
                            Konselor pendamping Anda saat ini: <strong class="text-slate-700">{{ $user->selectedCounselor->name }}</strong>. Anda dapat terhubung langsung via WhatsApp.
                        @else
                            Pilihlah salah satu dari Konselor terbaik kami yang siap mendengarkan cerita dan membantu mengoptimalkan ketahanan mental Anda.
                        @endif
                    </p>
                    <div class="mt-3.5">
                        <a href="{{ route('konseli.counselor.index') }}" class="btn-primary btn-sm bg-gradient-to-r from-blue-500 to-blue-600">
                            {{ $counselorSelected ? 'Hubungi / Ganti Konselor' : 'Pilih Konselor Sekarang' }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- Step 3: Choose Tribe --}}
            <div class="card p-5 flex items-start gap-4 {{ $tribeSelected ? 'border-emerald-200 bg-emerald-50/10' : 'border-slate-200' }}">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 font-bold text-sm {{ $tribeSelected ? 'bg-emerald-100 text-emerald-600' : 'bg-blue-100 text-blue-600' }}">
                    @if($tribeSelected)
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    @else
                        3
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <h5 class="font-bold text-slate-800 text-sm">Langkah 3: Pilih Suku Budaya</h5>
                        <span class="text-xs font-bold {{ $tribeSelected ? 'text-emerald-600 bg-emerald-100/60' : 'text-amber-600 bg-amber-50' }} px-2.5 py-0.5 rounded-lg border border-current/10">
                            {{ $tribeSelected ? 'Selesai' : 'Belum Selesai' }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        @if($tribeSelected)
                            Suku pilihan Anda saat ini: <strong class="text-slate-700">{{ $user->selectedTribe->name }}</strong>.
                        @else
                            Pilih suku asal atau suku budaya lain yang ingin Anda pelajari materi kearifan lokalnya untuk refleksi diri.
                        @endif
                    </p>
                    <div class="mt-3.5">
                        <a href="{{ route('konseli.tribe.index') }}" class="btn-primary btn-sm bg-gradient-to-r from-blue-500 to-blue-600">
                            {{ $tribeSelected ? 'Mulai Baca Modul / Ganti Suku' : 'Pilih Suku Sekarang' }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- Step 4: Self-Help --}}
            <div class="card p-5 flex items-start gap-4 {{ $hasSelfHelpAnswers ? 'border-emerald-200 bg-emerald-50/10' : 'border-slate-200' }}">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 font-bold text-sm {{ $hasSelfHelpAnswers ? 'bg-emerald-100 text-emerald-600' : 'bg-blue-100 text-blue-600' }}">
                    @if($hasSelfHelpAnswers)
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    @else
                        4
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <h5 class="font-bold text-slate-800 text-sm">Langkah 4: Mengisi Refleksi Self-Help WDEP</h5>
                        <span class="text-xs font-bold {{ $hasSelfHelpAnswers ? 'text-emerald-600 bg-emerald-100/60' : 'text-amber-600 bg-amber-50' }} px-2.5 py-0.5 rounded-lg border border-current/10">
                            {{ $hasSelfHelpAnswers ? 'Selesai' : 'Belum Selesai' }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">Pelajari materi kearifan budaya lokal, lalu tuangkan refleksi diri Anda ke dalam lembar kerja kognitif WDEP yang telah terintegrasi.</p>
                    <div class="mt-3.5">
                        @if($tribeSelected)
                            <a href="{{ route('konseli.self-help.show', $user->selected_tribe_id) }}" class="btn-primary btn-sm bg-gradient-to-r from-blue-500 to-blue-600">Buka Lembar Refleksi</a>
                        @else
                            <button disabled class="btn-secondary btn-sm cursor-not-allowed opacity-50">Buka Lembar Refleksi (Pilih Suku Dulu)</button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Step 5: Post-Test --}}
            <div class="card p-5 flex items-start gap-4 {{ $postTestCompleted ? 'border-emerald-200 bg-emerald-50/10' : 'border-slate-200' }}">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 font-bold text-sm {{ $postTestCompleted ? 'bg-emerald-100 text-emerald-600' : 'bg-blue-100 text-blue-600' }}">
                    @if($postTestCompleted)
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    @else
                        5
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <h5 class="font-bold text-slate-800 text-sm">Langkah 5: Mengisi Post-Test Wellbeing</h5>
                        <span class="text-xs font-bold {{ $postTestCompleted ? 'text-emerald-600 bg-emerald-100/60' : 'text-amber-600 bg-amber-50' }} px-2.5 py-0.5 rounded-lg border border-current/10">
                            {{ $postTestCompleted ? 'Selesai' : 'Belum Selesai' }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">Setelah menyelesaikan seluruh rangkaian pembelajaran self-help, lakukan post-test untuk mengetahui perkembangan indeks kesejahteraan psikologis akhir Anda.</p>
                    <div class="mt-3.5">
                        @if($postTestCompleted)
                            <a href="{{ route('konseli.wellbeing.result', 'post_test') }}" class="btn-secondary btn-sm">Lihat Skor Post-Test</a>
                        @else
                            @if($preTestCompleted && $hasSelfHelpAnswers)
                                <a href="{{ route('konseli.wellbeing.index') }}" class="btn-primary btn-sm bg-gradient-to-r from-blue-500 to-blue-600">Ambil Post-Test</a>
                            @else
                                <button disabled class="btn-secondary btn-sm cursor-not-allowed opacity-50">Ambil Post-Test (Selesaikan Langkah Sebelumnya Dulu)</button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
