@extends('layouts.admin')

@section('title', 'Grup Pilihan Jawaban')
@section('page-title', 'Grup Pilihan Jawaban')

@section('header-actions')
<a href="{{ route('admin.option-groups.create') }}" class="btn-primary">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Buat Grup Baru
</a>
@endsection

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="card p-6">
        <p class="text-sm text-slate-500 mb-6">Grup pilihan jawaban digunakan untuk mengelompokkan opsi jawaban kuesioner wellbeing beserta bobot skornya masing-masing.</p>

        @if($groups->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <h4 class="text-lg font-bold text-slate-700">Belum Ada Grup Pilihan</h4>
                <p class="text-sm text-slate-500 mt-1 mb-6">Mulai dengan membuat grup pilihan jawaban pertama Anda.</p>
                <a href="{{ route('admin.option-groups.create') }}" class="btn-primary">Buat Grup Baru</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($groups as $group)
                    <div class="border border-slate-200/80 rounded-2xl p-5 hover:border-blue-400/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-bold text-slate-800 text-lg">{{ $group->name }}</h4>
                                <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-semibold border border-blue-100">
                                    {{ $group->items->count() }} Pilihan
                                </span>
                            </div>
                            
                            <div class="mt-4 space-y-2">
                                @foreach($group->items->sortBy('order') as $item)
                                    <div class="flex items-center justify-between p-2.5 bg-slate-50 rounded-xl text-sm border border-slate-100">
                                        <span class="font-medium text-slate-700">{{ $item->label }}</span>
                                        <span class="font-bold text-blue-600 bg-white border border-slate-200 px-2 py-0.5 rounded-lg text-xs">Skor: {{ $item->score }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mt-6 pt-4 border-t border-slate-100">
                            <a href="{{ route('admin.option-groups.edit', $group) }}" class="btn-secondary btn-sm flex-1">
                                Edit
                            </a>
                            <form action="{{ route('admin.option-groups.destroy', $group) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus grup pilihan ini? Seluruh pertanyaan yang menggunakan grup ini juga akan terpengaruh.')">
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
