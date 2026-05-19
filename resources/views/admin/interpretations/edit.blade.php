@extends('layouts.admin')

@section('title', 'Edit Interpretasi Hasil')
@section('page-title', 'Edit Interpretasi')

@section('content')
<div class="max-w-xl mx-auto space-y-6 animate-fade-in">
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Form Edit Interpretasi</h3>
            <a href="{{ route('admin.interpretations.index') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Kembali ke Daftar</a>
        </div>

        <form action="{{ route('admin.interpretations.update', $interpretation) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Range Scores -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="min_score" class="form-label">Skor Minimal</label>
                    <input type="number" 
                           id="min_score" 
                           name="min_score" 
                           value="{{ old('min_score', $interpretation->min_score) }}" 
                           required 
                           min="0"
                           class="form-input" 
                           placeholder="0" />
                    @error('min_score')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="max_score" class="form-label">Skor Maksimal</label>
                    <input type="number" 
                           id="max_score" 
                           name="max_score" 
                           value="{{ old('max_score', $interpretation->max_score) }}" 
                           required 
                           min="0"
                           class="form-input" 
                           placeholder="100" />
                    @error('max_score')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="form-label">Keterangan & Rekomendasi Hasil</label>
                <textarea id="description" 
                          name="description" 
                          rows="5" 
                          required 
                          class="form-input" 
                          placeholder="Masukkan teks deskripsi hasil">{{ old('description', $interpretation->description) }}</textarea>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.interpretations.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Perbarui Interpretasi</button>
            </div>
        </form>
    </div>
</div>
@endsection
