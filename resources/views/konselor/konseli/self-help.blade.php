@extends('layouts.konselor')

@section('title', 'Refleksi Self-Help Konseli')
@section('page-title', 'Refleksi Self-Help: ' . $user->name)

@section('header-actions')
<a href="{{ route('konselor.dashboard') }}" class="btn-secondary">Kembali</a>
@endsection

@section('content')
<div class="space-y-6 animate-fade-in pb-16">
    
    @if(!$tribe)
        <div class="card p-12 text-center bg-white border border-slate-200/80">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <h4 class="text-lg font-bold text-slate-700">Konseli Belum Memilih Suku Budaya</h4>
            <p class="text-sm text-slate-500 mt-1">Kemajuan pengisian lembar refleksi WDEP akan ditampilkan di sini setelah konseli memilih suku.</p>
        </div>
    @else
        @php
            $materials = $tribe->materials->sortBy('order')->values();
        @endphp

        <div class="card p-5 bg-white border border-slate-200/80">
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-lg border border-blue-100 uppercase tracking-wider">
                    Suku Budaya Pilihan
                </span>
                <h3 class="font-extrabold text-slate-800 text-lg">Suku {{ $tribe->name }}</h3>
            </div>
            <p class="text-sm text-slate-500 mt-1.5">Berikut adalah jawaban-jawaban refleksi kognitif WDEP yang telah dimasukkan oleh konseli {{ $user->name }} pada masing-masing modul kearifan lokal.</p>
        </div>

        @if($materials->isEmpty())
            <div class="card p-12 text-center bg-white border border-slate-200/80">
                <p class="text-sm text-slate-400 font-semibold italic">Belum ada materi pembelajaran yang terdaftar untuk suku {{ $tribe->name }}.</p>
            </div>
        @else
            <div x-data="{ activeTab: 0 }">
                <!-- Horizontal Tabs -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-thin mb-6">
                    @foreach($materials as $idx => $material)
                        <button type="button" 
                                @click="activeTab = {{ $idx }}"
                                class="px-5 py-2.5 rounded-full text-xs font-bold border transition-all duration-200 flex-shrink-0 active:scale-95"
                                :class="activeTab === {{ $idx }} 
                                    ? 'bg-blue-600 border-blue-600 text-white shadow-sm' 
                                    : 'bg-white border-slate-200 text-slate-500 hover:text-slate-700 hover:bg-slate-50'">
                            {{ $material->title }}
                        </button>
                    @endforeach
                </div>

                <!-- Tab Contents -->
                @foreach($materials as $idx => $material)
                    <div class="space-y-6" x-show="activeTab === {{ $idx }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2">
                        
                        {{-- Philosophy details --}}
                        <div class="card p-6 bg-white border border-slate-200/80">
                            <h4 class="font-extrabold text-slate-800 text-base mb-2">{{ $material->title }}</h4>
                            @if($material->values)
                                <div class="mb-3">
                                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-100">
                                        Nilai Budaya: {{ $material->values }}
                                    </span>
                                </div>
                            @endif
                            <p class="text-sm text-slate-500 leading-relaxed">{{ $material->description ?: 'Tidak ada deskripsi filosofi.' }}</p>
                        </div>

                        {{-- WDEP Reflections List --}}
                        <div class="card p-6 bg-white border border-slate-200/80 space-y-6">
                            <h4 class="font-extrabold text-slate-800 text-base border-b border-slate-100 pb-3">Daftar Refleksi WDEP Konseli</h4>
                            
                            @if($material->questions->isEmpty())
                                <p class="text-sm text-slate-400 font-semibold italic text-center py-6">Belum ada pertanyaan refleksi WDEP untuk materi ini.</p>
                            @else
                                <div class="grid grid-cols-1 gap-6">
                                    @foreach($material->questions->sortBy('order') as $q)
                                        @php $ansText = $answers[$q->id] ?? null; @endphp
                                        <div class="p-5 bg-slate-50 border border-slate-100 rounded-3xl space-y-3">
                                            <div class="flex items-center gap-2">
                                                <span class="w-6 h-6 rounded bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center flex-shrink-0">
                                                    {{ $q->category }}
                                                </span>
                                                <span class="text-xs font-extrabold text-slate-400">
                                                    {{ $q->category === 'W' ? 'Wants (Keinginan)' : ($q->category === 'D' ? 'Doing (Tindakan)' : ($q->category === 'E' ? 'Evaluation (Evaluasi)' : 'Planning (Rencana)')) }}
                                                </span>
                                            </div>
                                            <p class="text-sm font-bold text-slate-800 leading-relaxed">{{ $q->text }}</p>
                                            
                                            <div class="p-4 bg-white border border-slate-200/80 rounded-2xl min-h-[100px] shadow-sm">
                                                @if($ansText)
                                                    <p class="text-xs font-medium text-slate-700 leading-relaxed whitespace-pre-line">{!! e($ansText) !!}</p>
                                                @else
                                                    <p class="text-xs text-slate-400 font-semibold italic">Konseli belum menuliskan jawaban refleksi untuk pertanyaan ini.</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    @endif

</div>
@endsection
