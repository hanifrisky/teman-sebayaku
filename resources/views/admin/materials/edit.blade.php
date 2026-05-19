@extends('layouts.admin')

@section('title', 'Edit Materi Self-Help')
@section('page-title', 'Edit Materi')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 animate-fade-in">
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Edit Materi Suku {{ $tribe->name }}</h3>
            <a href="{{ route('admin.tribes.show', $tribe) }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Kembali ke Suku</a>
        </div>

        <form action="{{ route('admin.tribes.materials.update', [$tribe, $material]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Detail Materi -->
            <div class="space-y-4">
                <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-2">1. Detail Materi Self-Help</h4>

                <!-- Title -->
                <div>
                    <label for="title" class="form-label">Judul Materi</label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $material->title) }}" 
                           required 
                           class="form-input" 
                           placeholder="Contoh: Filosofi Alon-alon Waton Kelakon" />
                    @error('title')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Values -->
                <div>
                    <label for="values" class="form-label">Nilai-Nilai Budaya (Koma Terpisah)</label>
                    <input type="text" 
                           id="values" 
                           name="values" 
                           value="{{ old('values', $material->values) }}" 
                           class="form-input" 
                           placeholder="Contoh: Kesabaran, Ketekunan, Kehati-hatian" />
                    @error('values')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="form-label">Deskripsi & Makna Filosofis</label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              class="form-input" 
                              placeholder="Jelaskan makna dibalik kearifan budaya ini...">{!! old('description', $material->description) !!}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Section 2: WDEP Questions -->
            @php
                $oldQuestions = old('questions');
                if ($oldQuestions) {
                    $questionsW = collect($oldQuestions)->where('category', 'W')->values()->all();
                    $questionsD = collect($oldQuestions)->where('category', 'D')->values()->all();
                    $questionsE = collect($oldQuestions)->where('category', 'E')->values()->all();
                    $questionsP = collect($oldQuestions)->where('category', 'P')->values()->all();
                } else {
                    $questionsW = $material->questions->where('category', 'W')->sortBy('order')->values()->map(function($q) {
                        return ['id' => $q->id, 'category' => $q->category, 'text' => $q->text];
                    })->all();
                    $questionsD = $material->questions->where('category', 'D')->sortBy('order')->values()->map(function($q) {
                        return ['id' => $q->id, 'category' => $q->category, 'text' => $q->text];
                    })->all();
                    $questionsE = $material->questions->where('category', 'E')->sortBy('order')->values()->map(function($q) {
                        return ['id' => $q->id, 'category' => $q->category, 'text' => $q->text];
                    })->all();
                    $questionsP = $material->questions->where('category', 'P')->sortBy('order')->values()->map(function($q) {
                        return ['id' => $q->id, 'category' => $q->category, 'text' => $q->text];
                    })->all();

                    // Fallback to at least one question per category
                    if (empty($questionsW)) $questionsW = [['id' => null, 'category' => 'W', 'text' => '']];
                    if (empty($questionsD)) $questionsD = [['id' => null, 'category' => 'D', 'text' => '']];
                    if (empty($questionsE)) $questionsE = [['id' => null, 'category' => 'E', 'text' => '']];
                    if (empty($questionsP)) $questionsP = [['id' => null, 'category' => 'P', 'text' => '']];
                }
            @endphp
            <div id="wdep-questions-container"
                 data-w="{{ json_encode($questionsW) }}"
                 data-d="{{ json_encode($questionsD) }}"
                 data-e="{{ json_encode($questionsE) }}"
                 data-p="{{ json_encode($questionsP) }}"
                 x-data="{
                    questions: {
                        W: JSON.parse($el.dataset.w),
                        D: JSON.parse($el.dataset.d),
                        E: JSON.parse($el.dataset.e),
                        P: JSON.parse($el.dataset.p)
                    },
                    addQuestion(category) {
                        this.questions[category].push({ id: null, category: category, text: '' });
                    },
                removeQuestion(category, index) {
                    if (this.questions[category].length > 1) {
                        this.questions[category].splice(index, 1);
                    } else {
                        alert('Minimal harus ada 1 pertanyaan untuk kategori ini.');
                    }
                },
                getGlobalIndex(category, localIndex) {
                    let offset = 0;
                    let categories = ['W', 'D', 'E', 'P'];
                    for (let c of categories) {
                        if (c === category) break;
                        offset += this.questions[c].length;
                    }
                    return offset + localIndex;
                }
            }">
                <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-2">2. Pertanyaan Refleksi WDEP</h4>
                <p class="text-xs text-slate-400">Tentukan pertanyaan pemandu kognitif untuk masing-masing pilar WDEP. Anda dapat menambahkan lebih dari satu pertanyaan per kategori.</p>

                <div class="space-y-6">
                    {{-- Wants (W) --}}
                    <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-3 mb-2">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center">W</span>
                                <span class="text-xs font-bold text-slate-700">Wants (Keinginan atau Harapan)</span>
                            </div>
                            <button type="button" @click="addQuestion('W')" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Tambah Pertanyaan
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <template x-for="(q, idx) in questions.W" :key="idx">
                                <div class="space-y-2 p-4 bg-white border border-slate-200/60 rounded-xl shadow-sm relative group">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-400" x-text="'Pertanyaan #' + (idx + 1)"></span>
                                        <button type="button" 
                                                @click="removeQuestion('W', idx)" 
                                                x-show="questions.W.length > 1"
                                                class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-lg transition-colors flex items-center justify-center"
                                                title="Hapus Pertanyaan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                    <input type="hidden" :name="'questions[' + getGlobalIndex('W', idx) + '][id]'" :value="q.id">
                                    <input type="hidden" :name="'questions[' + getGlobalIndex('W', idx) + '][category]'" value="W">
                                    <textarea :name="'questions[' + getGlobalIndex('W', idx) + '][text]'" 
                                              x-model="q.text"
                                              required 
                                              rows="2" 
                                              class="form-input text-xs" 
                                              placeholder="Contoh: Apa keinginan atau tujuan yang ingin kamu capai dalam hidup saat ini?"></textarea>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Doing (D) --}}
                    <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-3 mb-2">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center">D</span>
                                <span class="text-xs font-bold text-slate-700">Doing (Tindakan atau Aksi Nyata)</span>
                            </div>
                            <button type="button" @click="addQuestion('D')" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Tambah Pertanyaan
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <template x-for="(q, idx) in questions.D" :key="idx">
                                <div class="space-y-2 p-4 bg-white border border-slate-200/60 rounded-xl shadow-sm relative group">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-400" x-text="'Pertanyaan #' + (idx + 1)"></span>
                                        <button type="button" 
                                                @click="removeQuestion('D', idx)" 
                                                x-show="questions.D.length > 1"
                                                class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-lg transition-colors flex items-center justify-center"
                                                title="Hapus Pertanyaan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                    <input type="hidden" :name="'questions[' + getGlobalIndex('D', idx) + '][id]'" :value="q.id">
                                    <input type="hidden" :name="'questions[' + getGlobalIndex('D', idx) + '][category]'" value="D">
                                    <textarea :name="'questions[' + getGlobalIndex('D', idx) + '][text]'" 
                                              x-model="q.text"
                                              required 
                                              rows="2" 
                                              class="form-input text-xs" 
                                              placeholder="Contoh: Langkah-langkah nyata apa yang sedang kamu lakukan untuk mencapai keinginan tersebut?"></textarea>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Evaluation (E) --}}
                    <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-3 mb-2">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center">E</span>
                                <span class="text-xs font-bold text-slate-700">Evaluation (Evaluasi Tindakan)</span>
                            </div>
                            <button type="button" @click="addQuestion('E')" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Tambah Pertanyaan
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <template x-for="(q, idx) in questions.E" :key="idx">
                                <div class="space-y-2 p-4 bg-white border border-slate-200/60 rounded-xl shadow-sm relative group">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-400" x-text="'Pertanyaan #' + (idx + 1)"></span>
                                        <button type="button" 
                                                @click="removeQuestion('E', idx)" 
                                                x-show="questions.E.length > 1"
                                                class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-lg transition-colors flex items-center justify-center"
                                                title="Hapus Pertanyaan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                    <input type="hidden" :name="'questions[' + getGlobalIndex('E', idx) + '][id]'" :value="q.id">
                                    <input type="hidden" :name="'questions[' + getGlobalIndex('E', idx) + '][category]'" value="E">
                                    <textarea :name="'questions[' + getGlobalIndex('E', idx) + '][text]'" 
                                              x-model="q.text"
                                              required 
                                              rows="2" 
                                              class="form-input text-xs" 
                                              placeholder="Contoh: Apakah langkah yang kamu lakukan saat ini sudah selaras dengan kearifan lokal kesabaran?"></textarea>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Planning (P) --}}
                    <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-3 mb-2">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center">P</span>
                                <span class="text-xs font-bold text-slate-700">Planning (Rencana Masa Depan)</span>
                            </div>
                            <button type="button" @click="addQuestion('P')" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Tambah Pertanyaan
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <template x-for="(q, idx) in questions.P" :key="idx">
                                <div class="space-y-2 p-4 bg-white border border-slate-200/60 rounded-xl shadow-sm relative group">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-400" x-text="'Pertanyaan #' + (idx + 1)"></span>
                                        <button type="button" 
                                                @click="removeQuestion('P', idx)" 
                                                x-show="questions.P.length > 1"
                                                class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-lg transition-colors flex items-center justify-center"
                                                title="Hapus Pertanyaan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                    <input type="hidden" :name="'questions[' + getGlobalIndex('P', idx) + '][id]'" :value="q.id">
                                    <input type="hidden" :name="'questions[' + getGlobalIndex('P', idx) + '][category]'" value="P">
                                    <textarea :name="'questions[' + getGlobalIndex('P', idx) + '][text]'" 
                                              x-model="q.text"
                                              required 
                                              rows="2" 
                                              class="form-input text-xs" 
                                              placeholder="Contoh: Rencana tindakan kecil dan realistis apa yang akan kamu lakukan selanjutnya?"></textarea>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.tribes.show', $tribe) }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Perbarui Materi</button>
            </div>
        </form>
    </div>
</div>
@endsection
