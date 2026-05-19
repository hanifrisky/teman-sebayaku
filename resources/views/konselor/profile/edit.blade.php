@extends('layouts.konselor')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
@php $profile = $user->counselorProfile; @endphp
<div class="max-w-xl mx-auto space-y-6 animate-fade-in pb-16">
    <div class="card p-6 bg-white border border-slate-200/80">
        <h3 class="font-extrabold text-slate-800 text-lg mb-6">Pengaturan Profil Konselor</h3>

        <form action="{{ route('konselor.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                           value="{{ old('name', $user->name) }}" 
                           required 
                           class="form-input" 
                           placeholder="Nama lengkap beserta gelar akademis..." />
                    @error('name')
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
            </div>

            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-2">2. Data Profil Konselor</h4>

                <!-- Motto -->
                <div>
                    <label for="motto" class="form-label">Motto Hidup / Konseling</label>
                    <input type="text" 
                           id="motto" 
                           name="motto" 
                           value="{{ old('motto', $profile->motto ?? '') }}" 
                           class="form-input" 
                           placeholder="Motto yang akan dipajang di kartu profil Anda..." />
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
                           placeholder="Contoh: 08123456789" />
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
                                <img src="{{ asset('storage/' . $profile->photo_path) }}" alt="Foto profil" class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs text-slate-400">Foto profil saat ini terpasang. Unggah berkas baru untuk mengubahnya.</span>
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
                              placeholder="Deskripsi diri, keahlian, atau fokus bimbingan Anda...">{{ old('description', $profile->description ?? '') }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
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
