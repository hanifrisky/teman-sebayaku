@extends('layouts.admin')

@section('title', 'Detail Suku & Materi')
@section('page-title', $tribe->name)

@section('header-actions')
<div class="flex items-center gap-2">
    <a href="{{ route('admin.tribes.index') }}" class="btn-secondary">Kembali</a>
    <a href="{{ route('admin.tribes.materials.create', $tribe) }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Materi Baru
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="card p-6">
        <div class="border-b border-slate-100 pb-4 mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Materi Self-Help Suku {{ $tribe->name }}</h3>
            <p class="text-sm text-slate-500 mt-1">Daftar materi pembelajaran mandiri yang dikelompokkan berdasarkan kearifan lokal suku ini.</p>
        </div>

        @if($tribe->materials->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <h4 class="text-lg font-bold text-slate-700">Belum Ada Materi</h4>
                <p class="text-sm text-slate-500 mt-1 mb-6">Mulai dengan menambahkan materi self-help baru untuk Suku {{ $tribe->name }}.</p>
                <a href="{{ route('admin.tribes.materials.create', $tribe) }}" class="btn-primary">Tambah Materi Baru</a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($tribe->materials->sortBy('order') as $material)
                    <div class="border border-slate-200/80 rounded-3xl p-6 bg-white shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 border-b border-slate-100 pb-4 mb-4">
                            <div>
                                <h4 class="font-extrabold text-slate-800 text-lg">{{ $material->title }}</h4>
                                @if($material->values)
                                    <div class="flex items-center gap-1.5 mt-2">
                                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-100">
                                            Nilai Budaya: {{ $material->values }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.tribes.materials.edit', [$tribe, $material]) }}" class="btn-secondary btn-sm">
                                    Edit Materi & Soal
                                </a>
                                <form action="{{ route('admin.tribes.materials.destroy', [$tribe, $material]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            {{-- Description --}}
                            <div class="lg:col-span-1">
                                <h5 class="font-bold text-slate-700 text-sm mb-2">Deskripsi Filosofi</h5>
                                <p class="text-sm text-slate-500 leading-relaxed">
                                    {{ $material->description ?: 'Tidak ada deskripsi.' }}
                                </p>
                            </div>

                            {{-- WDEP Questions --}}
                            <div class="lg:col-span-2 space-y-3">
                                <h5 class="font-bold text-slate-700 text-sm mb-2">Pertanyaan Refleksi WDEP</h5>
                                @if($material->questions->isEmpty())
                                    <p class="text-xs text-amber-600 bg-amber-50 px-3 py-2 rounded-xl border border-amber-100 font-medium">Belum ada pertanyaan refleksi WDEP untuk materi ini.</p>
                                @else
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        @foreach($material->questions->sortBy('order') as $q)
                                            <div class="p-3 bg-slate-50 border border-slate-100 rounded-2xl flex items-start gap-2.5">
                                                <span class="w-7 h-7 rounded-lg bg-blue-600 text-white font-extrabold text-xs flex items-center justify-center flex-shrink-0">
                                                    {{ $q->category }}
                                                </span>
                                                <div class="min-w-0">
                                                    <span class="text-xs font-bold text-slate-400">
                                                        {{ $q->category === 'W' ? 'Wants (Keinginan)' : ($q->category === 'D' ? 'Doing (Tindakan)' : ($q->category === 'E' ? 'Evaluation (Evaluasi)' : 'Planning (Rencana)')) }}
                                                    </span>
                                                    <p class="text-xs font-medium text-slate-600 mt-0.5 leading-relaxed">{{ $q->text }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
