@extends('layouts.konseli')

@section('title', 'Mengisi Kuesioner Wellbeing')

@section('content')
@php
    $totalQuestions = $questions->count();
@endphp

<div class="space-y-6 pb-16 animate-fade-in" x-data="{
    currentIndex: 0,
    totalQuestions: {{ $totalQuestions }},
    questions: {{ json_encode($questions->map(function($q) {
        return [
            'id' => $q->id,
            'text' => $q->text,
            'options' => $q->optionGroup->items->sortBy('order')->values()->map(function($opt) {
                return [
                    'id' => $opt->id,
                    'label' => $opt->label,
                    'score' => $opt->score
                ];
            })
        ];
    })) }},
    answers: {
        @foreach($answer->details as $d)
            '{{ $d->question_id }}': {
                option_id: {{ $d->selected_option_id }},
                score: {{ $d->score }}
            },
        @endforeach
    },
    savingStatus: 'idle', // 'idle', 'saving', 'saved', 'error'
    
    get progressPercentage() {
        let answeredCount = Object.keys(this.answers).length;
        return Math.round((answeredCount / this.totalQuestions) * 100);
    },
    
    get allAnswered() {
        return Object.keys(this.answers).length === this.totalQuestions;
    },
    
    selectOption(questionId, optionId, score) {
        this.answers[questionId] = { option_id: optionId, score: score };
        this.saveAnswer(questionId, optionId, score);
    },
    
    async saveAnswer(questionId, optionId, score) {
        this.savingStatus = 'saving';
        try {
            let response = await fetch('{{ route('konseli.wellbeing.save', $type) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    question_id: questionId,
                    selected_option_id: optionId,
                    score: score
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
    }
}">
    <!-- Header with Progress Bar -->
    <div class="card p-5 bg-white border border-slate-200/80">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-xs font-bold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-lg border border-blue-100 uppercase tracking-wider">
                    {{ str_replace('_', ' ', strtoupper($type)) }}
                </span>
                <h3 class="font-extrabold text-slate-800 text-lg mt-2">Indeks Kesejahteraan Psikologis</h3>
            </div>
            
            {{-- Saving status badge --}}
            <div class="flex items-center gap-2 text-xs font-semibold self-start sm:self-center">
                <template x-if="savingStatus === 'saving'">
                    <span class="inline-flex items-center gap-1.5 text-blue-600 bg-blue-50 px-2.5 py-1.5 rounded-lg border border-blue-100">
                        <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Menyimpan otomatis...
                    </span>
                </template>
                <template x-if="savingStatus === 'saved'">
                    <span class="inline-flex items-center gap-1 text-emerald-600 bg-emerald-50 px-2.5 py-1.5 rounded-lg border border-emerald-100">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Tersimpan otomatis
                    </span>
                </template>
                <template x-if="savingStatus === 'error'">
                    <span class="inline-flex items-center gap-1 text-red-600 bg-red-50 px-2.5 py-1.5 rounded-lg border border-red-100">
                        Gagal menyimpan. Coba lagi!
                    </span>
                </template>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="mt-5">
            <div class="flex justify-between items-center text-xs font-bold text-slate-500 mb-1.5">
                <span>Kemajuan Pengisian</span>
                <span class="text-blue-600" x-text="progressPercentage + '%'">0%</span>
            </div>
            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-full rounded-full transition-all duration-300" :style="'width: ' + progressPercentage + '%'"></div>
            </div>
        </div>
    </div>

    <!-- Main Two-Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- Left Side: Active Question Display -->
        <div class="lg:col-span-2 card p-6 bg-white border border-slate-200/80">
            <div class="min-h-[320px] flex flex-col justify-between">
                <div>
                    {{-- Question Number --}}
                    <span class="text-xs font-bold text-blue-500 uppercase tracking-widest" x-text="'PERTANYAAN ' + (currentIndex + 1) + ' DARI ' + totalQuestions"></span>
                    
                    {{-- Question Text --}}
                    <h4 class="font-extrabold text-slate-800 text-lg mt-3 mb-6 leading-relaxed" x-text="questions[currentIndex].text"></h4>
                    
                    {{-- Option Radio list --}}
                    <div class="space-y-3">
                        <template x-for="(opt, idx) in questions[currentIndex].options" :key="opt.id">
                            <label class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-100 rounded-2xl cursor-pointer hover:bg-blue-50/20 hover:border-blue-200 transition-all duration-200"
                                   :class="answers[questions[currentIndex].id]?.option_id === opt.id ? 'border-blue-500 bg-blue-50/30' : ''">
                                <input type="radio" 
                                       :name="'q_' + questions[currentIndex].id"
                                       :value="opt.id"
                                       :checked="answers[questions[currentIndex].id]?.option_id === opt.id"
                                       @change="selectOption(questions[currentIndex].id, opt.id, opt.score)"
                                       class="w-4 h-4 text-blue-600 bg-white border-slate-300 focus:ring-blue-500" />
                                <span class="text-sm font-semibold text-slate-700" x-text="opt.label"></span>
                            </label>
                        </template>
                    </div>
                </div>

                {{-- Bottom navigation controls --}}
                <div class="flex items-center justify-between gap-4 mt-8 pt-6 border-t border-slate-100">
                    <button type="button" 
                            @click="currentIndex = Math.max(0, currentIndex - 1)" 
                            :disabled="currentIndex === 0"
                            class="btn-secondary btn-sm px-4 py-2 hover:bg-slate-100 disabled:opacity-40 disabled:cursor-not-allowed">
                        Sebelumnya
                    </button>
                    
                    <button type="button" 
                            @click="if(currentIndex < totalQuestions - 1) { currentIndex++ }"
                            x-show="currentIndex < totalQuestions - 1"
                            class="btn-primary btn-sm bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-2">
                        Berikutnya
                    </button>

                    <form action="{{ route('konseli.wellbeing.finish', $type) }}" method="POST" x-show="currentIndex === totalQuestions - 1">
                        @csrf
                        <button type="submit" 
                                :disabled="!allAnswered"
                                class="btn-success btn-sm bg-emerald-600 text-white font-bold px-5 py-2 rounded-xl disabled:opacity-40 disabled:cursor-not-allowed">
                            Selesaikan Tes
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Side: Question Navigator Grid -->
        <div class="lg:col-span-1 card p-5 bg-white border border-slate-200/80">
            <h4 class="font-bold text-slate-800 text-sm mb-4">Navigasi Soal</h4>
            
            <div class="grid grid-cols-5 gap-2.5">
                <template x-for="(q, idx) in questions" :key="q.id">
                    <button type="button" 
                            @click="currentIndex = idx"
                            class="w-10 h-10 rounded-xl font-bold text-xs flex items-center justify-center border transition-all duration-200 active:scale-95"
                            :class="currentIndex === idx 
                                ? 'bg-blue-600 border-blue-600 text-white shadow-md shadow-blue-500/25 ring-2 ring-blue-600 ring-offset-2' 
                                : (answers[q.id] 
                                    ? 'bg-emerald-50 border-emerald-200 text-emerald-600 font-extrabold' 
                                    : 'bg-slate-50 border-slate-200 text-slate-400')">
                        <span x-text="idx + 1"></span>
                    </button>
                </template>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 space-y-2">
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                    <span class="w-3.5 h-3.5 rounded bg-emerald-50 border border-emerald-200 block"></span>
                    <span>Sudah dijawab</span>
                </div>
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                    <span class="w-3.5 h-3.5 rounded bg-slate-50 border border-slate-200 block"></span>
                    <span>Belum dijawab</span>
                </div>
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                    <span class="w-3.5 h-3.5 rounded bg-blue-600 block"></span>
                    <span>Pertanyaan aktif</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
