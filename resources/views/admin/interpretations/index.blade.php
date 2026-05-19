@extends('layouts.admin')

@section('title', 'Interpretasi Hasil Wellbeing')
@section('page-title', 'Interpretasi Hasil')

@section('header-actions')
<a href="{{ route('admin.interpretations.create') }}" class="btn-primary">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Tambah Interpretasi Baru
</a>
@endsection

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="card p-6">
        <p class="text-sm text-slate-500 mb-6">Interpretasi hasil digunakan untuk mengklasifikasikan total skor wellbeing konseli ke dalam level-level kesehatan mental tertentu beserta rekomendasi tindak lanjutnya.</p>

        @if($interpretations->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                <h4 class="text-lg font-bold text-slate-700">Belum Ada Interpretasi</h4>
                <p class="text-sm text-slate-500 mt-1 mb-6">Mulai dengan menambahkan rentang skor interpretasi pertama Anda.</p>
                <a href="{{ route('admin.interpretations.create') }}" class="btn-primary">Tambah Interpretasi Baru</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($interpretations as $interp)
                    <div class="border border-slate-200/80 rounded-2xl p-5 hover:border-blue-400/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-3">
                                <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-bold border border-blue-100 uppercase tracking-wider">
                                    Rentang Skor
                                </span>
                                <span class="font-extrabold text-blue-600 text-lg">
                                    {{ $interp->min_score }} – {{ $interp->max_score }}
                                </span>
                            </div>
                            
                            <p class="text-sm text-slate-600 mt-4 leading-relaxed font-medium">
                                {{ $interp->description }}
                            </p>
                        </div>

                        <div class="flex items-center gap-2 mt-6 pt-4 border-t border-slate-100">
                            <a href="{{ route('admin.interpretations.edit', $interp) }}" class="btn-secondary btn-sm flex-1">
                                Edit
                            </a>
                            <form action="{{ route('admin.interpretations.destroy', $interp) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus interpretasi ini?')">
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
