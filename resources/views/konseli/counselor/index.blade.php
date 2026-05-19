@extends('layouts.konseli')

@section('title', 'Pilih Konselor Sebaya')

@section('content')
<div class="space-y-6 animate-fade-in pb-16">
    <div class="border-b border-slate-200 pb-4">
        <h2 class="text-2xl font-bold text-slate-800">Pilih Konselor Sebaya Anda</h2>
        <p class="text-sm text-slate-500 mt-1">Pilih konselor yang akan mendampingi perjalanan bimbingan dan memberikan feedback terhadap lembar refleksi kognitif Anda.</p>
    </div>

    @if($counselors->isEmpty())
        <div class="card p-12 text-center bg-white">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <h4 class="text-lg font-bold text-slate-700">Belum Ada Konselor Aktif</h4>
            <p class="text-sm text-slate-500 mt-1">Silakan hubungi admin untuk mendaftarkan konselor sebaya.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($counselors as $counselor)
                @php 
                    $profile = $counselor->counselorProfile;
                    $isSelected = $counselor->id == $selectedCounselorId;
                @endphp
                <div class="border-2 rounded-3xl p-5 flex flex-col justify-between bg-white relative transition-all duration-300 hover:shadow-md {{ $isSelected ? 'border-blue-500 ring-4 ring-blue-500/10' : 'border-slate-200/80' }}">
                    @if($isSelected)
                        <div class="absolute top-4 right-4 bg-blue-500 text-white text-xs font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider">
                            Dipilih
                        </div>
                    @endif

                    <div>
                        {{-- Photo and Info --}}
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 border border-slate-100 overflow-hidden flex-shrink-0 flex items-center justify-center font-bold text-blue-600 text-lg">
                                @if($profile && $profile->photo_path)
                                    <img src="{{ asset('storage/' . $profile->photo_path) }}" alt="Foto {{ $counselor->name }}" class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($counselor->name, 0, 2)) }}
                                @endif
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-extrabold text-slate-800 text-base truncate leading-snug">{{ $counselor->name }}</h4>
                                <p class="text-xs text-slate-400 truncate mt-0.5">{{ $counselor->email }}</p>
                            </div>
                        </div>

                        {{-- Motto --}}
                        @if($profile && $profile->motto)
                            <div class="mt-4 p-3 bg-slate-50 rounded-2xl border border-slate-100 text-xs italic text-slate-500">
                                "{{ $profile->motto }}"
                            </div>
                        @endif

                        {{-- Description --}}
                        @if($profile && $profile->description)
                            <p class="text-xs text-slate-500 mt-4 leading-relaxed line-clamp-4 font-medium">
                                {{ $profile->description }}
                            </p>
                        @endif
                    </div>

                    <div class="space-y-2 mt-6 pt-4 border-t border-slate-100">
                        @if($profile && $profile->whatsapp_number)
                            <a href="{{ $profile->whatsapp_url }}" target="_blank" class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.96 9.96 0 001.333 4.993L2 22l5.13-1.347a9.94 9.94 0 004.887 1.277h.005c5.505 0 9.99-4.478 9.99-9.985 0-2.667-1.037-5.176-2.922-7.062A9.9 9.9 0 0012.012 2zM12 4.355c2.046 0 3.97.796 5.414 2.24s2.24 3.368 2.24 5.413c0 4.218-3.435 7.652-7.653 7.652a7.61 7.61 0 01-3.898-1.07l-.28-.166-2.898.76.772-2.825-.183-.29a7.61 7.61 0 01-1.168-3.99c0-4.217 3.435-7.653 7.652-7.653h.014zm-2.22 3.016a.6.6 0 00-.43-.204c-.167 0-.323.064-.473.214-.247.247-.634.624-.634 1.527 0 .903.656 1.774.747 1.898.09.124 1.263 2.014 3.102 2.74.437.172.778.275 1.045.36.44.14.84.12.116.012.307-.045.946-.387 1.08-.762.136-.375.136-.697.095-.762-.04-.065-.148-.105-.306-.185-.159-.08-.946-.467-1.093-.52-.147-.054-.255-.08-.363.08-.108.16-.42.52-.514.627-.094.107-.188.12-.347.04-.16-.08-.67-.247-1.278-.79-.472-.42-.79-.94-.882-1.1-.09-.16-.01-.246.07-.326.072-.072.16-.188.24-.282.08-.094.107-.16.16-.268.054-.107.027-.2-.013-.28-.04-.08-.363-.875-.497-1.205z"/></svg>
                                Chat WhatsApp
                            </a>
                        @endif

                        @if(!$isSelected)
                            <form action="{{ route('konseli.counselor.select', $counselor) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full btn-primary bg-gradient-to-r from-blue-500 to-blue-600 py-2 text-xs font-bold text-center">
                                    Pilih Konselor Ini
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
