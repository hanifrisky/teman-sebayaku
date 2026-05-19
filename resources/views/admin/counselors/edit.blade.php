@extends('layouts.admin')

@section('title', 'Edit Profil Konselor')
@section('page-title', 'Edit Konselor')

@section('content')
@php $profile = $counselor->counselorProfile; @endphp
<div class="max-w-xl mx-auto space-y-6 animate-fade-in">
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Edit Profil Konselor</h3>
            <a href="{{ route('admin.counselors.index') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Kembali ke Daftar</a>
        </div>

        <form action="{{ route('admin.counselors.update', $counselor) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-2">1. Akun Login</h4>
                
                <!-- Name -->
                <div>
                    <label for="name" class="form-label">Nama Lengkap & Gelar</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $counselor->name) }}" 
                           required 
                           class="form-input" 
                           placeholder="Contoh: Budi Raharjo, S.Psi" />
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
                           value="{{ old('email', $counselor->email) }}" 
                           required 
                           class="form-input" 
                           placeholder="budi@email.com" />
                    @error('email')
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
            </div>

            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-2">2. Profil Konseling</h4>
                
                <!-- Motto -->
                <div>
                    <label for="motto" class="form-label">Motto Hidup / Konseling</label>
                    <input type="text" 
                           id="motto" 
                           name="motto" 
                           value="{{ old('motto', $profile->motto ?? '') }}" 
                           class="form-input" 
                           placeholder="Contoh: Mendengarkan tanpa menghakimi." />
                    @error('motto')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- WhatsApp -->
                <div>
                    <label for="whatsapp_number" class="form-label">Nomor WhatsApp</label>
                    <input type="text" 
                           id="whatsapp_number" 
                           name="whatsapp_number" 
                           value="{{ old('whatsapp_number', $profile->whatsapp_number ?? '') }}" 
                           class="form-input" 
                           placeholder="Contoh: 081234567890" />
                    @error('whatsapp_number')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <div>
                    <label for="photo" class="form-label">Foto Profil</label>
                    @if($profile && $profile->photo_path)
                        <div class="mb-3 flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl border border-slate-200 overflow-hidden">
                                <img src="{{ asset('storage/' . $profile->photo_path) }}" alt="Foto lama" class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs text-slate-400">Foto saat ini terpasang. Unggah file baru untuk menggantinya.</span>
                        </div>
                    @endif
                    <input type="file" 
                           id="photo" 
                           name="photo" 
                           accept="image/*"
                           class="form-input bg-white" />
                    <p class="text-slate-400 text-xs mt-1">Format: JPG/PNG/WebP, maksimal 2MB</p>
                    @error('photo')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="form-label">Deskripsi Diri & Keahlian</label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              class="form-input" 
                              placeholder="Ceritakan latar belakang, fokus konseling, atau pendekatan bimbingan yang Anda gunakan.">{{ old('description', $profile->description ?? '') }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.counselors.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Perbarui Profil</button>
            </div>
        </form>
    </div>
</div>
@endsection
