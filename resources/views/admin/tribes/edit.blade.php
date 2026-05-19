@extends('layouts.admin')

@section('title', 'Edit Suku Budaya')
@section('page-title', 'Edit Suku')

@section('content')
<div class="max-w-md mx-auto space-y-6 animate-fade-in">
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Form Edit Suku</h3>
            <a href="{{ route('admin.tribes.index') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Kembali ke Daftar</a>
        </div>

        <form action="{{ route('admin.tribes.update', $tribe) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="form-label">Nama Suku Budaya</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $tribe->name) }}" 
                       required 
                       class="form-input" 
                       placeholder="Contoh: Suku Jawa" />
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.tribes.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Perbarui Suku</button>
            </div>
        </form>
    </div>
</div>
@endsection
