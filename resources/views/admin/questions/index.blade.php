@extends('layouts.admin')

@section('title', 'Soal Instrumen Wellbeing')
@section('page-title', 'Soal Instrumen')

@section('header-actions')
<a href="{{ route('admin.questions.create') }}" class="btn-primary">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Tambah Soal Baru
</a>
@endsection

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="table-container">
        <div class="p-6 border-b border-slate-200/60 bg-white">
            <h3 class="font-bold text-slate-800 text-lg">Daftar Pertanyaan Kuesioner</h3>
            <p class="text-sm text-slate-500 mt-1">Daftar pertanyaan yang akan dikerjakan konseli untuk mengukur tingkat Kesejahteraan Psikologis (Wellbeing) mereka.</p>
        </div>

        @if($questions->isEmpty())
            <div class="text-center py-16 bg-white">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <h4 class="text-lg font-bold text-slate-700">Belum Ada Soal</h4>
                <p class="text-sm text-slate-500 mt-1 mb-6">Mulai dengan menambahkan soal kuesioner pertama Anda.</p>
                <a href="{{ route('admin.questions.create') }}" class="btn-primary">Tambah Soal Baru</a>
            </div>
        @else
            <div class="overflow-x-auto bg-white">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="w-16 text-center">No Urut</th>
                            <th>Teks Pertanyaan</th>
                            <th>Grup Pilihan Jawaban</th>
                            <th class="w-40 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($questions as $question)
                            <tr>
                                <td class="text-center font-bold text-slate-500">{{ $question->order }}</td>
                                <td class="font-medium text-slate-800 py-4 max-w-lg">{{ $question->text }}</td>
                                <td>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $question->optionGroup->name }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.questions.edit', $question) }}" class="btn-secondary btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
