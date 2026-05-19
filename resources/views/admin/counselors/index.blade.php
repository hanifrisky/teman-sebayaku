@extends('layouts.admin')

@section('title', 'Manajemen Konselor Sebaya')
@section('page-title', 'Konselor Sebaya')

@section('header-actions')
<a href="{{ route('admin.counselors.create') }}" class="btn-primary">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Tambah Konselor
</a>
@endsection

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="card p-6">
        <p class="text-sm text-slate-500 mb-6">Kelola akun dan profil konselor sebaya. Konseli dapat memilih konselor dari daftar ini untuk mendampingi proses pengisian instrumen dan refleksi self-help.</p>

        @if($counselors->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <h4 class="text-lg font-bold text-slate-700">Belum Ada Konselor</h4>
                <p class="text-sm text-slate-500 mt-1 mb-6">Mulai dengan menambahkan akun konselor sebaya pertama Anda.</p>
                <a href="{{ route('admin.counselors.create') }}" class="btn-primary">Tambah Konselor</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($counselors as $counselor)
                    @php $profile = $counselor->counselorProfile; @endphp
                    <div class="border border-slate-200/80 rounded-3xl p-5 hover:border-blue-400/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between bg-white relative overflow-hidden">
                        <div>
                            {{-- Photo and basic info --}}
                            <div class="flex items-start gap-4">
                                <div class="w-16 h-16 rounded-2xl bg-blue-50 border border-slate-100 overflow-hidden flex-shrink-0 flex items-center justify-center font-bold text-blue-600 text-xl shadow-sm">
                                    @if($profile && $profile->photo_path)
                                        <img src="{{ asset('storage/' . $profile->photo_path) }}" alt="Foto {{ $counselor->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($counselor->name, 0, 2)) }}
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-slate-800 text-base truncate leading-snug">{{ $counselor->name }}</h4>
                                    <p class="text-xs text-slate-400 truncate mt-0.5">{{ $counselor->email }}</p>
                                    @if($profile && $profile->whatsapp_number)
                                        <a href="{{ $profile->whatsapp_url }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 hover:text-emerald-700 mt-1.5 bg-emerald-50 px-2 py-0.5 rounded-lg border border-emerald-100 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.96 9.96 0 001.333 4.993L2 22l5.13-1.347a9.94 9.94 0 004.887 1.277h.005c5.505 0 9.99-4.478 9.99-9.985 0-2.667-1.037-5.176-2.922-7.062A9.9 9.9 0 0012.012 2zM12 4.355c2.046 0 3.97.796 5.414 2.24s2.24 3.368 2.24 5.413c0 4.218-3.435 7.652-7.653 7.652a7.61 7.61 0 01-3.898-1.07l-.28-.166-2.898.76.772-2.825-.183-.29a7.61 7.61 0 01-1.168-3.99c0-4.217 3.435-7.653 7.652-7.653h.014zm-2.22 3.016a.6.6 0 00-.43-.204c-.167 0-.323.064-.473.214-.247.247-.634.624-.634 1.527 0 .903.656 1.774.747 1.898.09.124 1.263 2.014 3.102 2.74.437.172.778.275 1.045.36.44.14.84.12.116.012.307-.045.946-.387 1.08-.762.136-.375.136-.697.095-.762-.04-.065-.148-.105-.306-.185-.159-.08-.946-.467-1.093-.52-.147-.054-.255-.08-.363.08-.108.16-.42.52-.514.627-.094.107-.188.12-.347.04-.16-.08-.67-.247-1.278-.79-.472-.42-.79-.94-.882-1.1-.09-.16-.01-.246.07-.326.072-.072.16-.188.24-.282.08-.094.107-.16.16-.268.054-.107.027-.2-.013-.28-.04-.08-.363-.875-.497-1.205z"/></svg>
                                            WA: {{ $profile->whatsapp_number }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            @if($profile && $profile->motto)
                                <div class="mt-4 p-3 bg-slate-50 rounded-2xl border border-slate-100 text-xs italic text-slate-500">
                                    "{{ $profile->motto }}"
                                </div>
                            @endif

                            @if($profile && $profile->description)
                                <p class="text-xs text-slate-500 mt-4 leading-relaxed line-clamp-3">
                                    {{ $profile->description }}
                                </p>
                            @endif
                        </div>

                        <div class="flex items-center gap-2 mt-6 pt-4 border-t border-slate-100">
                            <a href="{{ route('admin.counselors.edit', $counselor) }}" class="btn-secondary btn-sm flex-1">
                                Edit Profil
                            </a>
                            <form action="{{ route('admin.counselors.destroy', $counselor) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun konselor ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger btn-sm w-full">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
