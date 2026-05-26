@extends('layouts.konselor')

@section('page-title', 'Manajemen Lesson')

@section('header-actions')
<a href="{{ route('konselor.lessons.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Buat Lesson
</a>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200">
        <h3 class="text-lg font-bold text-slate-800">Daftar Lesson</h3>
        <p class="text-slate-500 text-sm mt-1">Kelola materi edukasi untuk konseli</p>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-sm border-b border-slate-200">
                    <th class="px-6 py-4 font-medium">Judul Lesson</th>
                    <th class="px-6 py-4 font-medium">Kategori/Tag</th>
                    <th class="px-6 py-4 font-medium">Pembuat</th>
                    <th class="px-6 py-4 font-medium">Jumlah Section</th>
                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($lessons as $lesson)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-slate-800">{{ $lesson->title }}</div>
                        <div class="text-xs text-slate-500 mt-1">{{ $lesson->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($lesson->tag)
                            <span class="px-2.5 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">{{ $lesson->tag }}</span>
                        @else
                            <span class="text-slate-400 text-sm">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-slate-700">{{ $lesson->creator->name ?? 'Sistem' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-semibold rounded-lg">{{ $lesson->sections_count }} Section</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('konselor.lessons.edit', $lesson) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('konselor.lessons.destroy', $lesson) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lesson ini? Semua media terkait akan dihapus.')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                        Belum ada lesson yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
