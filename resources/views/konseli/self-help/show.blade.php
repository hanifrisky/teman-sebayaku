@extends('layouts.konseli')

@section('title', 'Modul Refleksi Self-Help')

@section('content')
@php
    $materials = $tribe->materials->sortBy('order')->values();
@endphp

<div class="space-y-6 pb-16 animate-fade-in" x-data="{
    activeTab: 0,
    materialsCount: {{ $materials->count() }},
    answers: {{ json_encode($answers) }},
    savingStatus: 'idle', // 'idle', 'saving', 'saved', 'error'
    saveTimeout: null,
    
    saveAnswer(questionId, text) {
        this.answers[questionId] = text;
        this.savingStatus = 'saving';
        
        // Debounce / delay save by 800ms
        clearTimeout(this.saveTimeout);
        this.saveTimeout = setTimeout(async () => {
            try {
                let response = await fetch('{{ route('konseli.self-help.save') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        material_question_id: questionId,
                        answer_text: text
                    })
                });
                let result = await response.json();
                if (result.success) {
                    this.savingStatus = 'saved';
                    setTimeout(() => {
                        if (this.savingStatus === 'saved') this.savingStatus = 'idle';
                    }, 1500);
                } else {
                    this.savingStatus = 'error';
                }
            } catch (e) {
                this.savingStatus = 'error';
            }
        }, 800);
    }
}">
    <!-- Header with Dynamic Status -->
    <div class="card p-5 bg-white border border-slate-200/80">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-xs font-bold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-lg border border-blue-100 uppercase tracking-wider">
                    Suku {{ $tribe->name }}
                </span>
                <h3 class="font-extrabold text-slate-800 text-lg mt-2">Lembar Refleksi Diri (Self-Help) WDEP</h3>
            </div>

            {{-- Auto-save status --}}
            <div class="flex items-center gap-2 text-xs font-semibold self-start sm:self-center">
                <template x-if="savingStatus === 'saving'">
                    <span class="inline-flex items-center gap-1.5 text-blue-600 bg-blue-50 px-2.5 py-1.5 rounded-lg border border-blue-100">
                        <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Menyimpan...
                    </span>
                </template>
                <template x-if="savingStatus === 'saved'">
                    <span class="inline-flex items-center gap-1 text-emerald-600 bg-emerald-50 px-2.5 py-1.5 rounded-lg border border-emerald-100">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Perubahan disimpan
                    </span>
                </template>
                <template x-if="savingStatus === 'error'">
                    <span class="inline-flex items-center gap-1 text-red-600 bg-red-50 px-2.5 py-1.5 rounded-lg border border-red-100">
                        Gagal menyimpan perubahan.
                    </span>
                </template>
            </div>
        </div>

        {{-- Selected Counselor Notice --}}
        @if(auth()->user()->counselor)
            <div class="mt-4 p-4 bg-blue-50/50 border border-blue-100 rounded-2xl text-xs text-blue-700 flex items-start gap-2.5 font-medium leading-relaxed">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 9a1 1 0 00-1 1v4a1 1 0 102 0v-4a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <div>
                    Lembar refleksi ini akan dipantau oleh konselor sebaya pendamping Anda: <strong class="text-slate-800">{{ auth()->user()->counselor->name }}</strong>. Anda dapat mengirim pesan WhatsApp untuk meminta bimbingan lebih lanjut.
                </div>
            </div>
        @else
            <div class="mt-4 p-4 bg-amber-50 border border-amber-100 rounded-2xl text-xs text-amber-700 flex items-start gap-2.5 font-semibold leading-relaxed">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 9a1 1 0 00-1 1v4a1 1 0 102 0v-4a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <div>
                    Anda belum memilih konselor pendamping. <a href="{{ route('konseli.counselor.index') }}" class="underline font-bold text-amber-800">Pilih Konselor Sebaya</a> agar lembar kerja ini dapat ditinjau!
                </div>
            </div>
        @endif
    </div>

    @if($materials->isEmpty())
        <div class="card p-12 text-center bg-white">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <h4 class="text-lg font-bold text-slate-700">Belum Ada Materi Pembelajaran</h4>
            <p class="text-sm text-slate-500 mt-1">Silakan pilih suku lain atau hubungi admin.</p>
        </div>
    @else
        <!-- Horizontal Tabs Navigator -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-thin">
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

        <!-- Material Details & Questions Form -->
        @foreach($materials as $idx => $material)
            <div class="space-y-6" x-show="activeTab === {{ $idx }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2">
                
                {{-- Philosophy & Values Card --}}
                <div class="card p-6 bg-white border border-slate-200/80">
                    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-4 mb-4">
                        <h4 class="font-extrabold text-slate-800 text-lg">{{ $material->title }}</h4>
                        @if($material->values)
                            <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-100">
                                Nilai Budaya: {{ $material->values }}
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        {{ $material->description ?: 'Tidak ada deskripsi filosofi.' }}
                    </p>
                </div>

                {{-- WDEP Worksheets --}}
                <div class="card p-6 bg-white border border-slate-200/80 space-y-6">
                    <h4 class="font-extrabold text-slate-800 text-base border-b border-slate-100 pb-3">Lembar Refleksi WDEP</h4>
                    
                    @if($material->questions->isEmpty())
                        <p class="text-sm text-slate-400 font-semibold italic text-center py-6">Belum ada pertanyaan refleksi WDEP untuk materi ini.</p>
                    @else
                        <div class="grid grid-cols-1 gap-6">
                            @foreach($material->questions->sortBy('order') as $q)
                                <div class="p-5 bg-slate-50 border border-slate-100 rounded-3xl space-y-3">
                                    <div class="flex items-center gap-2">
                                        <span class="w-6 h-6 rounded bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center flex-shrink-0">
                                            {{ $q->category }}
                                        </span>
                                        <span class="text-xs font-extrabold text-slate-400">
                                            {{ $q->category === 'W' ? 'Wants (Keinginan)' : ($q->category === 'D' ? 'Doing (Tindakan)' : ($q->category === 'E' ? 'Evaluation (Evaluasi)' : 'Planning (Rencana)')) }}
                                        </span>
                                    </div>
                                    <p class="text-sm font-bold text-slate-700 leading-relaxed">{{ $q->text }}</p>
                                    
                                    {{-- Reflection textarea --}}
                                    <textarea rows="4" 
                                              @input="saveAnswer({{ $q->id }}, $event.target.value)"
                                              class="form-input bg-white text-xs font-medium" 
                                              placeholder="Tuliskan refleksi dirimu di sini... (Perubahan disimpan otomatis)">{{ $answers[$q->id] ?? '' }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Next Tab Navigator --}}
                <div class="flex justify-between items-center pt-4">
                    <button type="button" 
                            @click="activeTab = Math.max(0, activeTab - 1)" 
                            :disabled="activeTab === 0"
                            class="btn-secondary btn-sm px-4 py-2 hover:bg-slate-100 disabled:opacity-40 disabled:cursor-not-allowed">
                        Materi Sebelumnya
                    </button>
                    <button type="button" 
                            @click="if(activeTab < materialsCount - 1) { activeTab++ } else { window.location.href = '{{ route('konseli.dashboard') }}' }"
                            class="btn-primary btn-sm bg-gradient-to-r from-blue-500 to-blue-600 px-5 py-2">
                        <span x-text="activeTab === materialsCount - 1 ? 'Selesai & Beranda' : 'Materi Berikutnya'"></span>
                    </button>
                </div>

            </div>
        @endforeach
    @endif
</div>
@endsection
