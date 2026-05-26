@extends('layouts.admin')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')

@section('content')
<div class="max-w-xl mx-auto space-y-6 animate-fade-in">
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Edit Detail Pengguna</h3>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Kembali ke Daftar</a>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
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
                       placeholder="Nama lengkap pengguna" />
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

            <!-- Role -->
            <div>
                <label for="role" class="form-label">Hak Akses / Role</label>
                <select id="role" name="role" required class="form-input">
                    <option value="konseli" {{ old('role', $user->role) === 'konseli' ? 'selected' : '' }}>Konseli</option>
                    <option value="konselor" {{ old('role', $user->role) === 'konselor' ? 'selected' : '' }}>Konselor</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Passwords -->
            <div class="grid grid-cols-2 gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                <div class="col-span-2 mb-2">
                    <p class="text-xs font-semibold text-slate-500">Ubah Kata Sandi (Kosongkan jika tidak ingin diubah)</p>
                </div>
                <div>
                    <label for="password" class="form-label">Kata Sandi Baru</label>
                    <div class="relative" x-data="{ show: false }">
                        <input type="password" 
                               id="password" 
                               :type="show ? 'text' : 'password'"
                               name="password" 
                               class="form-input bg-white w-full pr-10" 
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
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <div class="relative" x-data="{ show: false }">
                        <input type="password" 
                               id="password_confirmation" 
                               :type="show ? 'text' : 'password'"
                               name="password_confirmation" 
                               class="form-input bg-white w-full pr-10" 
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
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Perbarui Pengguna</button>
            </div>
        </form>
    </div>
</div>
@endsection
