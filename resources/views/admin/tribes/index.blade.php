@extends('layouts.admin')

@section('title', 'Manajemen Suku & Kebudayaan')
@section('page-title', 'Suku & Kebudayaan')

@section('header-actions')
<a href="{{ route('admin.tribes.create') }}" class="btn-primary">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Tambah Suku
</a>
@endsection

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="card p-6">
        <p class="text-sm text-slate-500 mb-6">Kelola daftar suku budaya. Setiap suku dapat memiliki beberapa materi pembelajaran self-help yang dirancang dengan metode refleksi kognitif WDEP (Wants, Doing, Evaluation, Planning).</p>

        @if($tribes->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h2a2.5 2.5 0 002.5-2.5V8a2.5 2.5 0 012.5-2.5h.5m-6 9v3m0 0l3-3m-3 3l-3-3"/></svg>
                <h4 class="text-lg font-bold text-slate-700">Belum Ada Suku Budaya</h4>
                <p class="text-sm text-slate-500 mt-1 mb-6">Mulai dengan menambahkan suku budaya pertama Anda.</p>
                <a href="{{ route('admin.tribes.create') }}" class="btn-primary">Tambah Suku</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tribes as $tribe)
                    <div class="border border-slate-200/80 rounded-3xl p-5 hover:border-blue-400/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between bg-white relative overflow-hidden">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-bold border border-blue-100 uppercase tracking-wider">
                                    Suku Budaya
                                </span>
                                <span class="font-extrabold text-slate-400 text-xs">ID: #{{ $tribe->id }}</span>
                            </div>
                            
                            <h4 class="font-bold text-slate-800 text-xl mb-2">{{ $tribe->name }}</h4>
                            <p class="text-xs text-slate-400 font-semibold">{{ $tribe->materials->count() }} Materi Self-Help terdaftar</p>
                        </div>

                        <div class="space-y-2 mt-6 pt-4 border-t border-slate-100">
                            <a href="{{ route('admin.tribes.show', $tribe) }}" class="btn-primary btn-sm w-full flex items-center justify-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Kelola Materi & Soal WDEP
                            </a>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.tribes.edit', $tribe) }}" class="btn-secondary btn-sm flex-1">
                                    Edit Nama
                                </a>
                                <form action="{{ route('admin.tribes.destroy', $tribe) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus suku ini beserta seluruh materi didalamnya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger btn-sm w-full">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
