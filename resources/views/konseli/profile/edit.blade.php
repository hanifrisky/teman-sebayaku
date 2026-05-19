@extends('layouts.konseli')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-xl mx-auto space-y-6 animate-fade-in pb-16">
    <div class="card p-6 bg-white border border-slate-200/80">
        <h3 class="font-extrabold text-slate-800 text-lg mb-6">Pengaturan Akun & Profil</h3>

        <form action="{{ route('konseli.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       required 
                       class="form-input" 
                       placeholder="Nama lengkap Anda..." />
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}" 
                       required 
                       class="form-input" 
                       placeholder="email@domain.com" />
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password change block -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-slate-50 border border-slate-100 rounded-3xl">
                <div class="col-span-1 md:col-span-2">
                    <h4 class="text-xs font-extrabold text-slate-500">Ubah Kata Sandi (Kosongkan jika tidak diubah)</h4>
                </div>
                <div>
                    <label for="password" class="form-label text-xs">Kata Sandi Baru</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-input bg-white text-xs" 
                           placeholder="••••••••" />
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="form-label text-xs">Konfirmasi Kata Sandi</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="form-input bg-white text-xs" 
                           placeholder="••••••••" />
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="btn-primary bg-gradient-to-r from-blue-500 to-blue-600 px-6">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
