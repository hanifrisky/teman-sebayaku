@extends('layouts.konselor')

@section('title', 'Hasil Wellbeing Konseli')
@section('page-title', 'Hasil Wellbeing: ' . $user->name)

@section('header-actions')
<a href="{{ route('konselor.dashboard') }}" class="btn-secondary">Kembali</a>
@endsection

@section('content')
<div class="space-y-8 animate-fade-in pb-16">
    
    {{-- Comparison Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        {{-- Pre-Test Card --}}
        <div class="card p-6 bg-white border border-slate-200/80 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                    <h3 class="font-extrabold text-slate-800 text-lg">Hasil Pre-Test Wellbeing</h3>
                    <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg border border-blue-100 font-bold uppercase tracking-wider">Awal</span>
                </div>

                @if($preTest)
                    <div class="space-y-4">
                        <div class="p-4 bg-slate-50 border border-slate-100 rounded-3xl text-center">
                            <span class="text-xs font-semibold text-slate-400 block uppercase tracking-wider">Skor Total</span>
                            <span class="text-4xl font-extrabold text-blue-600 block mt-1">{{ $preTest->total_score }} Poin</span>
                            <span class="text-xs text-slate-400 font-semibold block mt-1">Selesai: {{ $preTest->completed_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="p-4 bg-blue-50/20 border border-blue-100/50 rounded-2xl">
                            <span class="text-xs font-extrabold text-blue-600 uppercase tracking-widest block mb-1">Interpretasi Hasil</span>
                            <p class="text-xs font-bold text-slate-600 leading-relaxed">{{ $preTest->interpretation->description ?? 'Tidak ditemukan deskripsi.' }}</p>
                        </div>
                        <div class="pt-2 border-t border-slate-100 flex justify-end">
                            <form action="{{ route('konselor.konseli.wellbeing.reset', [$user, 'pre_test']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset hasil Pre-Test ini? Konseli harus mengisi ulang dari awal.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-extrabold text-red-600 bg-red-50 hover:bg-red-100 hover:text-red-700 rounded-xl border border-red-100 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500/20 active:scale-95 duration-150">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Reset Pre-Test
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-slate-400 font-medium text-sm">
                        Konseli belum menyelesaikan Pre-Test.
                    </div>
                @endif
            </div>
        </div>

        {{-- Post-Test Card --}}
        <div class="card p-6 bg-white border border-slate-200/80 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                    <h3 class="font-extrabold text-slate-800 text-lg">Hasil Post-Test Wellbeing</h3>
                    <span class="bg-indigo-50 text-indigo-700 text-xs px-2.5 py-1 rounded-lg border border-indigo-100 font-bold uppercase tracking-wider">Akhir</span>
                </div>

                @if($postTest)
                    <div class="space-y-4">
                        <div class="p-4 bg-slate-50 border border-slate-100 rounded-3xl text-center">
                            <span class="text-xs font-semibold text-slate-400 block uppercase tracking-wider">Skor Total</span>
                            <span class="text-4xl font-extrabold text-indigo-600 block mt-1">{{ $postTest->total_score }} Poin</span>
                            <span class="text-xs text-slate-400 font-semibold block mt-1">Selesai: {{ $postTest->completed_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="p-4 bg-indigo-50/20 border border-indigo-100/50 rounded-2xl">
                            <span class="text-xs font-extrabold text-indigo-600 uppercase tracking-widest block mb-1">Interpretasi Hasil</span>
                            <p class="text-xs font-bold text-slate-600 leading-relaxed">{{ $postTest->interpretation->description ?? 'Tidak ditemukan deskripsi.' }}</p>
                        </div>
                        <div class="pt-2 border-t border-slate-100 flex justify-end">
                            <form action="{{ route('konselor.konseli.wellbeing.reset', [$user, 'post_test']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset hasil Post-Test ini? Konseli harus mengisi ulang dari awal.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-extrabold text-red-600 bg-red-50 hover:bg-red-100 hover:text-red-700 rounded-xl border border-red-100 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500/20 active:scale-95 duration-150">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"/></svg>
                                    Reset Post-Test
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-slate-400 font-medium text-sm">
                        Konseli belum menyelesaikan Post-Test.
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- Detail Questions Analysis --}}
    @if($preTest || $postTest)
        <div class="card p-6 bg-white border border-slate-200/80">
            <h4 class="font-extrabold text-slate-800 text-base border-b border-slate-100 pb-3 mb-6">Analisis Perbandingan Butir Jawaban</h4>
            
            <div class="space-y-4">
                @php
                    $questions = \App\Models\Question::orderBy('order')->get();
                    $preDetails = $preTest ? $preTest->details->keyBy('question_id') : collect();
                    $postDetails = $postTest ? $postTest->details->keyBy('question_id') : collect();
                @endphp

                @foreach($questions as $idx => $q)
                    @php
                        $preAns = $preDetails->get($q->id);
                        $postAns = $postDetails->get($q->id);
                    @endphp
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-3xl flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start gap-3 min-w-0 flex-1">
                            <span class="w-7 h-7 rounded-lg bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">{{ $idx + 1 }}</span>
                            <p class="text-sm font-bold text-slate-700 leading-relaxed">{{ $q->text }}</p>
                        </div>
                        <div class="flex items-center gap-3 flex-shrink-0">
                            {{-- Pre answer value --}}
                            <div class="text-center bg-white border border-slate-200/80 p-2.5 rounded-2xl w-28 shadow-sm">
                                <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest block">Pre-Test</span>
                                <span class="text-xs font-extrabold text-blue-600 mt-1 block">
                                    {{ $preAns ? $preAns->score . ' Poin' : '-' }}
                                </span>
                            </div>

                            {{-- Post answer value --}}
                            <div class="text-center bg-white border border-slate-200/80 p-2.5 rounded-2xl w-28 shadow-sm">
                                <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest block">Post-Test</span>
                                <span class="text-xs font-extrabold text-indigo-600 mt-1 block">
                                    {{ $postAns ? $postAns->score . ' Poin' : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
