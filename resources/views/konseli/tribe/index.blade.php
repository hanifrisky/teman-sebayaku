@extends('layouts.konseli')

@section('title', 'Pilih Suku Budaya')

@section('content')
<div class="space-y-6 animate-fade-in pb-16">
    <div class="border-b border-slate-200 pb-4">
        <h2 class="text-2xl font-bold text-slate-800">Pilih Suku Budaya</h2>
        <p class="text-sm text-slate-500 mt-1">Pilihlah salah satu suku budaya di bawah ini untuk mengakses modul bimbingan berbasis kearifan budaya dan lembar refleksi diri WDEP.</p>
    </div>

    @if($tribes->isEmpty())
        <div class="card p-12 text-center bg-white">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h2a2.5 2.5 0 002.5-2.5V8a2.5 2.5 0 012.5-2.5h.5m-6 9v3m0 0l3-3m-3 3l-3-3"/></svg>
            <h4 class="text-lg font-bold text-slate-700">Belum Ada Suku Budaya Terdaftar</h4>
            <p class="text-sm text-slate-500 mt-1">Hubungi admin untuk mendaftarkan suku beserta modul pembelajarannya.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tribes as $tribe)
                @php 
                    $isSelected = $tribe->id == $selectedTribeId;
                @endphp
                <div class="border-2 rounded-3xl p-6 flex flex-col justify-between bg-white relative transition-all duration-300 hover:shadow-md {{ $isSelected ? 'border-blue-500 ring-4 ring-blue-500/10' : 'border-slate-200/80' }}">
                    @if($isSelected)
                        <div class="absolute top-4 right-4 bg-blue-500 text-white text-xs font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider">
                            Dipilih
                        </div>
                    @endif

                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-bold border border-blue-100 uppercase tracking-wider">
                                Suku Budaya
                            </span>
                        </div>
                        
                        <h4 class="font-extrabold text-slate-800 text-xl mb-1">{{ $tribe->name }}</h4>
                        <p class="text-xs text-slate-400 font-semibold mb-6">{{ $tribe->materials_count }} Modul Refleksi Terdaftar</p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 mt-6">
                        @if($isSelected)
                            <a href="{{ route('konseli.self-help.show', $tribe) }}" class="w-full btn-primary bg-gradient-to-r from-blue-500 to-blue-600 py-3 font-bold text-center block text-sm">
                                Buka Modul Refleksi
                            </a>
                        @else
                            <form action="{{ route('konseli.tribe.select', $tribe) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full btn-secondary py-3 font-bold text-center text-sm">
                                    Pilih Suku Ini
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
