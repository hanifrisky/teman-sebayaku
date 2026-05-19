@extends('layouts.admin')

@section('title', 'Tambah Materi Baru')
@section('page-title', 'Tambah Materi')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 animate-fade-in">
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Materi Baru Suku {{ $tribe->name }}</h3>
            <a href="{{ route('admin.tribes.show', $tribe) }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Kembali ke Suku</a>
        </div>

        <form action="{{ route('admin.tribes.materials.store', $tribe) }}" method="POST" class="space-y-6">
            @csrf

            <!-- Section 1: Detail Materi -->
            <div class="space-y-4">
                <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-2">1. Detail Materi Self-Help</h4>

                <!-- Title -->
                <div>
                    <label for="title" class="form-label">Judul Materi</label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
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
                           value="{{ old('values') }}" 
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
                              placeholder="Jelaskan makna dibalik kearifan budaya ini serta relevansinya terhadap ketahanan mental remaja..."></textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Section 2: WDEP Questions -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-2">2. Pertanyaan Refleksi WDEP</h4>
                <p class="text-xs text-slate-400">Tentukan pertanyaan pemandu kognitif untuk masing-masing pilar WDEP.</p>

                <div class="space-y-4">
                    {{-- W --}}
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-6 h-6 rounded bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center">W</span>
                            <span class="text-xs font-bold text-slate-700">Wants (Keinginan atau Harapan)</span>
                        </div>
                        <input type="hidden" name="questions[0][category]" value="W">
                        <textarea name="questions[0][text]" required rows="2" class="form-input bg-white text-xs" placeholder="Contoh: Apa keinginan atau tujuan yang ingin kamu capai dalam hidup saat ini?">{{ old('questions.0.text') }}</textarea>
                    </div>

                    {{-- D --}}
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-6 h-6 rounded bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center">D</span>
                            <span class="text-xs font-bold text-slate-700">Doing (Tindakan atau Aksi Nyata)</span>
                        </div>
                        <input type="hidden" name="questions[1][category]" value="D">
                        <textarea name="questions[1][text]" required rows="2" class="form-input bg-white text-xs" placeholder="Contoh: Langkah-langkah nyata apa yang sedang kamu lakukan untuk mencapai keinginan tersebut?">{{ old('questions.1.text') }}</textarea>
                    </div>

                    {{-- E --}}
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-6 h-6 rounded bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center">E</span>
                            <span class="text-xs font-bold text-slate-700">Evaluation (Evaluasi Tindakan)</span>
                        </div>
                        <input type="hidden" name="questions[2][category]" value="E">
                        <textarea name="questions[2][text]" required rows="2" class="form-input bg-white text-xs" placeholder="Contoh: Apakah langkah yang kamu lakukan saat ini sudah selaras dengan kearifan lokal kesabaran?">{{ old('questions.2.text') }}</textarea>
                    </div>

                    {{-- P --}}
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-6 h-6 rounded bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center">P</span>
                            <span class="text-xs font-bold text-slate-700">Planning (Rencana Masa Depan)</span>
                        </div>
                        <input type="hidden" name="questions[3][category]" value="P">
                        <textarea name="questions[3][text]" required rows="2" class="form-input bg-white text-xs" placeholder="Contoh: Rencana tindakan kecil dan realistis apa yang akan kamu lakukan selanjutnya?">{{ old('questions.3.text') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.tribes.show', $tribe) }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Materi</button>
            </div>
        </form>
    </div>
</div>
@endsection
