@extends('layouts.admin')

@section('title', 'Tambah Konselor Baru')
@section('page-title', 'Tambah Konselor')

@section('content')
<div class="max-w-xl mx-auto space-y-6 animate-fade-in">
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Form Registrasi Konselor</h3>
            <a href="{{ route('admin.counselors.index') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Kembali ke Daftar</a>
        </div>

        <form action="{{ route('admin.counselors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="space-y-4">
                <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-2">1. Akun Login</h4>
                
                <!-- Name -->
                <div>
                    <label for="name" class="form-label">Nama Lengkap & Gelar</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
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
                           value="{{ old('email') }}" 
                           required 
                           class="form-input" 
                           placeholder="budi@email.com" />
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Passwords -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="relative" x-data="{ show: false }">
                            <input type="password" 
                                   id="password" 
                                   :type="show ? 'text' : 'password'"
                                   name="password" 
                                   required 
                                   class="form-input w-full pr-10" 
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
                                   required 
                                   class="form-input w-full pr-10" 
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
            </div>

            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-2">2. Profil Konseling</h4>
                
                <!-- Motto -->
                <div>
                    <label for="motto" class="form-label">Motto Hidup / Konseling</label>
                    <input type="text" 
                           id="motto" 
                           name="motto" 
                           value="{{ old('motto') }}" 
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
                           value="{{ old('whatsapp_number') }}" 
                           class="form-input" 
                           placeholder="Contoh: 081234567890" />
                    @error('whatsapp_number')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <div>
                    <label for="photo" class="form-label">Foto Profil</label>
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
                              placeholder="Ceritakan latar belakang, fokus konseling, atau pendekatan bimbingan yang Anda gunakan.">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.counselors.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Daftarkan Konselor</button>
            </div>
        </form>
    </div>
</div>
@endsection
