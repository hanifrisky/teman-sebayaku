@extends('layouts.konseli')

@section('title', 'Kuesioner Wellbeing')

@section('content')
<div class="space-y-8 animate-fade-in pb-16">
    <div class="border-b border-slate-200 pb-4">
        <h2 class="text-2xl font-bold text-slate-800">Instrumen Kesejahteraan Psikologis (Wellbeing)</h2>
        <p class="text-sm text-slate-500 mt-1">Ukur tingkat kesejahteraan psikologis Anda melalui dua tahap kuesioner terstandar.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        {{-- Card 1: Pre-Test --}}
        <div class="card p-6 bg-white relative overflow-hidden flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-bold border border-blue-100 uppercase tracking-wider">Tahap Awal</span>
                    @if($preTest)
                        <span class="text-xs font-bold px-2.5 py-0.5 rounded-lg border {{ $preTest->status === 'completed' ? 'text-emerald-600 bg-emerald-50 border-emerald-100' : 'text-amber-600 bg-amber-50 border-amber-100' }}">
                            {{ $preTest->status === 'completed' ? 'Selesai' : 'Draf (Belum Selesai)' }}
                        </span>
                    @else
                        <span class="text-xs font-bold text-slate-400 bg-slate-50 border border-slate-200 px-2.5 py-0.5 rounded-lg">Belum Dimulai</span>
                    @endif
                </div>

                <h3 class="font-extrabold text-slate-800 text-xl mb-2">Pre-Test Wellbeing</h3>
                <p class="text-sm text-slate-500 leading-relaxed mb-6">Dilakukan di awal program sebelum membaca modul bimbingan ataupun berdiskusi dengan konselor sebaya Anda.</p>

                @if($preTest)
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl mb-6">
                        <div class="flex justify-between text-xs text-slate-500 mb-1.5">
                            <span>Nama Pengisi:</span>
                            <span class="font-bold text-slate-700">{{ $preTest->konseli_name }}</span>
                        </div>
                        @if($preTest->status === 'completed')
                            <div class="flex justify-between text-xs text-slate-500 mb-1.5">
                                <span>Skor Diperoleh:</span>
                                <span class="font-bold text-blue-600">{{ $preTest->total_score }} Poin</span>
                            </div>
                            <div class="flex justify-between text-xs text-slate-500">
                                <span>Tanggal Selesai:</span>
                                <span class="font-medium text-slate-700">{{ $preTest->completed_at->format('d M Y') }}</span>
                            </div>
                        @else
                            <p class="text-xs text-amber-600 font-bold">Ujian draf Anda sedang aktif.</p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="pt-4 border-t border-slate-100 mt-6">
                @if(!$preTest)
                    {{-- Start form --}}
                    <form action="{{ route('konseli.wellbeing.start', 'pre_test') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name_pre" class="form-label text-xs">Masukkan Nama Lengkap Anda</label>
                            <input type="text" id="name_pre" name="konseli_name" required class="form-input bg-slate-50" placeholder="Ketik nama lengkap untuk sertifikat/laporan..." />
                        </div>
                        <button type="submit" class="w-full btn-primary bg-gradient-to-r from-blue-500 to-blue-600 py-3 font-bold">
                            Mulai Pre-Test Sekarang
                        </button>
                    </form>
                @elseif($preTest->status === 'draft')
                    <a href="{{ route('konseli.wellbeing.show', 'pre_test') }}" class="w-full btn-primary bg-gradient-to-r from-blue-500 to-blue-600 py-3 font-bold text-center">
                        Lanjutkan Draf Pre-Test
                    </a>
                @else
                    <a href="{{ route('konseli.wellbeing.result', 'pre_test') }}" class="w-full btn-secondary py-3 font-bold text-center">
                        Lihat Hasil Pre-Test
                    </a>
                @endif
            </div>
        </div>

        {{-- Card 2: Post-Test --}}
        <div class="card p-6 bg-white relative overflow-hidden flex flex-col justify-between {{ !$canTakePostTest ? 'opacity-70 bg-slate-50/50' : '' }}">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-indigo-50 text-indigo-700 text-xs px-2.5 py-1 rounded-lg font-bold border border-indigo-100 uppercase tracking-wider">Tahap Akhir</span>
                    @if($postTest)
                        <span class="text-xs font-bold px-2.5 py-0.5 rounded-lg border {{ $postTest->status === 'completed' ? 'text-emerald-600 bg-emerald-50 border-emerald-100' : 'text-amber-600 bg-amber-50 border-amber-100' }}">
                            {{ $postTest->status === 'completed' ? 'Selesai' : 'Draf (Belum Selesai)' }}
                        </span>
                    @else
                        <span class="text-xs font-bold text-slate-400 bg-slate-50 border border-slate-200 px-2.5 py-0.5 rounded-lg">Belum Dimulai</span>
                    @endif
                </div>

                <h3 class="font-extrabold text-slate-800 text-xl mb-2">Post-Test Wellbeing</h3>
                <p class="text-sm text-slate-500 leading-relaxed mb-6">Dilakukan di akhir program setelah Anda selesai membaca modul kearifan budaya dan menyelesaikan refleksi WDEP.</p>

                @if($postTest)
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl mb-6">
                        <div class="flex justify-between text-xs text-slate-500 mb-1.5">
                            <span>Nama Pengisi:</span>
                            <span class="font-bold text-slate-700">{{ $postTest->konseli_name }}</span>
                        </div>
                        @if($postTest->status === 'completed')
                            <div class="flex justify-between text-xs text-slate-500 mb-1.5">
                                <span>Skor Diperoleh:</span>
                                <span class="font-bold text-indigo-600">{{ $postTest->total_score }} Poin</span>
                            </div>
                            <div class="flex justify-between text-xs text-slate-500">
                                <span>Tanggal Selesai:</span>
                                <span class="font-medium text-slate-700">{{ $postTest->completed_at->format('d M Y') }}</span>
                            </div>
                        @else
                            <p class="text-xs text-amber-600 font-bold">Ujian draf Anda sedang aktif.</p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="pt-4 border-t border-slate-100 mt-6">
                @if(!$canTakePostTest)
                    <div class="text-center p-3 bg-slate-100 rounded-2xl border border-slate-200 text-slate-400 text-xs font-semibold">
                        Selesaikan Pre-Test Terlebih Dahulu
                    </div>
                @else
                    @if(!$postTest)
                        {{-- Start form --}}
                        <form action="{{ route('konseli.wellbeing.start', 'post_test') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="name_post" class="form-label text-xs">Masukkan Nama Lengkap Anda</label>
                                <input type="text" id="name_post" name="konseli_name" required class="form-input bg-slate-50" placeholder="Ketik nama lengkap untuk sertifikat/laporan..." />
                            </div>
                            <button type="submit" class="w-full btn-primary bg-gradient-to-r from-blue-500 to-blue-600 py-3 font-bold">
                                Mulai Post-Test Sekarang
                            </button>
                        </form>
                    @elseif($postTest->status === 'draft')
                        <a href="{{ route('konseli.wellbeing.show', 'post_test') }}" class="w-full btn-primary bg-gradient-to-r from-blue-500 to-blue-600 py-3 font-bold text-center">
                            Lanjutkan Draf Post-Test
                        </a>
                    @else
                        <a href="{{ route('konseli.wellbeing.result', 'post_test') }}" class="w-full btn-secondary py-3 font-bold text-center">
                            Lihat Hasil Post-Test
                        </a>
                    @endif
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
