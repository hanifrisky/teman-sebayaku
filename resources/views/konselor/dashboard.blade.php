@extends('layouts.konselor')

@section('title', 'Dashboard Bimbingan')
@section('page-title', 'Dashboard Bimbingan')

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="card p-6 bg-white border border-slate-200/80">
        <h3 class="font-extrabold text-slate-800 text-lg mb-2">Selamat Datang di Panel Konselor Sebaya</h3>
        <p class="text-sm text-slate-500">Berikut adalah daftar peserta (konseli) bimbingan yang telah memilih Anda sebagai pendamping mereka. Anda dapat meninjau hasil Wellbeing serta lembar refleksi kognitif WDEP mereka secara mendalam.</p>
    </div>

    {{-- Konseli Table/List --}}
    <div class="table-container bg-white">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h4 class="font-bold text-slate-800 text-base">Konseli Pendampingan Anda</h4>
            <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-bold border border-blue-100">{{ $konseliList->count() }} Orang Terdaftar</span>
        </div>

        @if($konseliList->isEmpty())
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <h4 class="text-lg font-bold text-slate-700">Belum Ada Konseli</h4>
                <p class="text-sm text-slate-500 mt-1">Saat ini belum ada konseli yang memilih Anda sebagai pendamping.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Konseli</th>
                            <th>Suku Pilihan</th>
                            <th class="text-center">Pre-Test</th>
                            <th class="text-center">Post-Test</th>
                            <th class="text-center">Refleksi Self-Help</th>
                            <th class="w-64 text-center">Tindakan Peninjauan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($konseliList as $konseli)
                            <tr class="text-slate-600">
                                <td class="py-4">
                                    <h5 class="font-extrabold text-slate-800 text-sm">{{ $konseli->name }}</h5>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $konseli->email }}</p>
                                </td>
                                <td>
                                    @if($konseli->selectedTribe)
                                        <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg border border-blue-100 font-bold uppercase tracking-wide">
                                            Suku {{ $konseli->selectedTribe->name }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 italic font-semibold">Belum memilih</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($konseli->pre_test)
                                        <span class="text-xs font-bold text-blue-600 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded-lg">
                                            {{ $konseli->pre_test->total_score }} Poin
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum mengisi</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($konseli->post_test)
                                        <span class="text-xs font-bold text-indigo-600 bg-indigo-50 border border-indigo-100 px-2 py-0.5 rounded-lg">
                                            {{ $konseli->post_test->total_score }} Poin
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum mengisi</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="text-xs font-extrabold text-slate-600 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-lg">
                                        {{ $konseli->self_help_count }} Jawaban
                                    </span>
                                </td>
                                <td>
                                    <div class="flex flex-col gap-1.5 justify-center">
                                        <a href="{{ route('konselor.konseli.wellbeing', $konseli) }}" class="btn-primary btn-sm text-xs py-1.5 text-center flex items-center justify-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                                            Hasil Tes Wellbeing
                                        </a>
                                        <a href="{{ route('konselor.konseli.self-help', $konseli) }}" class="btn-secondary btn-sm text-xs py-1.5 text-center flex items-center justify-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                            Refleksi Self-Help
                                        </a>
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
