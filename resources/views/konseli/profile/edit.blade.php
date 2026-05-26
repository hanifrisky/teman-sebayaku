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
                    <div class="relative" x-data="{ show: false }">
                        <input type="password" 
                               id="password" 
                               :type="show ? 'text' : 'password'"
                               name="password" 
                               class="form-input bg-white text-xs w-full pr-10" 
                               placeholder="••••••••" />
                        <button type="button" 
                                @click="show = !show" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none p-1 transition-colors"
                                title="Tampilkan/Sembunyikan Kata Sandi">
                            <svg x-show="!show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.69 9.69a3 3 0 004.62 4.62M4.93 4.93l14.14 14.14" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="form-label text-xs">Konfirmasi Kata Sandi</label>
                    <div class="relative" x-data="{ show: false }">
                        <input type="password" 
                               id="password_confirmation" 
                               :type="show ? 'text' : 'password'"
                               name="password_confirmation" 
                               class="form-input bg-white text-xs w-full pr-10" 
                               placeholder="••••••••" />
                        <button type="button" 
                                @click="show = !show" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none p-1 transition-colors"
                                title="Tampilkan/Sembunyikan Kata Sandi">
                            <svg x-show="!show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.69 9.69a3 3 0 004.62 4.62M4.93 4.93l14.14 14.14" />
                            </svg>
                        </button>
                    </div>
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
