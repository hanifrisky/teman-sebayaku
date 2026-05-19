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
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-input bg-white" 
                           placeholder="••••••••" />
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="form-input bg-white" 
                           placeholder="••••••••" />
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
