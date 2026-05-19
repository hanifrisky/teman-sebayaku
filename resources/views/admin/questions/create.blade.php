@extends('layouts.admin')

@section('title', 'Tambah Soal Kuesioner')
@section('page-title', 'Tambah Soal')

@section('content')
<div class="max-w-xl mx-auto space-y-6 animate-fade-in">
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Form Tambah Soal</h3>
            <a href="{{ route('admin.questions.index') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Kembali ke Daftar</a>
        </div>

        <form action="{{ route('admin.questions.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Text -->
            <div>
                <label for="text" class="form-label">Pernyataan / Pertanyaan</label>
                <textarea id="text" 
                          name="text" 
                          rows="4" 
                          required 
                          class="form-input" 
                          placeholder="Masukkan teks pernyataan (misal: Saya merasa optimis tentang masa depan saya.)">{{ old('text') }}</textarea>
                @error('text')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Option Group -->
            <div>
                <label for="option_group_id" class="form-label">Grup Opsi Jawaban</label>
                <select id="option_group_id" name="option_group_id" required class="form-input">
                    <option value="" disabled selected>Pilih grup opsi jawaban</option>
                    @foreach($optionGroups as $group)
                        <option value="{{ $group->id }}" {{ old('option_group_id') == $group->id ? 'selected' : '' }}>
                            {{ $group->name }} ({{ $group->items->count() }} pilihan)
                        </option>
                    @endforeach
                </select>
                @error('option_group_id')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="form-label">Nomor Urut Tampil (Opsional)</label>
                <input type="number" 
                       id="order" 
                       name="order" 
                       value="{{ old('order') }}" 
                       class="form-input" 
                       placeholder="Biarkan kosong untuk urutan otomatis berikutnya" />
                @error('order')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.questions.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Pertanyaan</button>
            </div>
        </form>
    </div>
</div>
@endsection
