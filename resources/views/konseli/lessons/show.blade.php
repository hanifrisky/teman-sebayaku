@extends('layouts.konseli')

@section('page-title', 'Membaca Lesson')

@section('content')
<div class="max-w-3xl mx-auto pb-20">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-slate-500 font-medium mb-6">
        <a href="{{ route('konseli.lessons.index') }}" class="hover:text-blue-600 transition-colors">Pembelajaran</a>
        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-800 truncate" aria-current="page">{{ $lesson->title }}</span>
    </nav>

    {{-- Header --}}
    <header class="mb-10 text-center">
        @if($lesson->tag)
            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full mb-4">
                {{ $lesson->tag }}
            </span>
        @endif
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight mb-4">{{ $lesson->title }}</h1>
        <div class="flex items-center justify-center gap-4 text-sm text-slate-500 font-medium">
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>Oleh: {{ $lesson->creator->name ?? 'Tim Konselor' }}</span>
            </div>
            <div class="w-1 h-1 bg-slate-300 rounded-full"></div>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Diterbitkan: {{ $lesson->created_at->translatedFormat('d F Y') }}</span>
            </div>
        </div>
    </header>

    {{-- Sections Content --}}
    <article class="space-y-8 bg-white p-6 md:p-10 rounded-3xl shadow-sm border border-slate-200">
        @forelse($lesson->sections as $section)
            <div class="lesson-section">
                @if($section->type === 'text')
                    <div class="prose prose-slate prose-lg max-w-none prose-headings:font-bold prose-a:text-blue-600 prose-img:rounded-xl">
                        {!! nl2br(e($section->content_text)) !!}
                    </div>
                
                @elseif($section->type === 'image')
                    @if($section->file_path)
                        <figure class="my-6">
                            <img src="{{ asset('storage/' . $section->file_path) }}" alt="Gambar" class="w-full h-auto rounded-2xl shadow-sm">
                        </figure>
                    @endif
                
                @elseif($section->type === 'video')
                    @if($section->file_path)
                        <div class="my-6 aspect-video bg-slate-900 rounded-2xl overflow-hidden shadow-sm relative">
                            <video controls class="w-full h-full object-cover">
                                <source src="{{ asset('storage/' . $section->file_path) }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutar video ini.
                            </video>
                        </div>
                    @endif

                @elseif($section->type === 'youtube')
                    @if($section->content_text)
                        @php
                            $youtubeUrl = $section->content_text;
                            preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $youtubeUrl, $match);
                            $youtubeId = $match[1] ?? null;
                        @endphp
                        
                        <div class="my-6 aspect-video bg-slate-100 rounded-2xl overflow-hidden shadow-sm relative border border-slate-200">
                            @if($youtubeId)
                                <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-slate-400">
                                    Format tautan YouTube tidak valid.
                                </div>
                            @endif
                        </div>
                    @endif
                
                @elseif($section->type === 'pdf')
                    @if($section->file_path)
                        <div class="my-6">
                            <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 text-sm">Dokumen PDF</h4>
                                        <p class="text-xs text-slate-500">Klik untuk melihat atau mengunduh dokumen.</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $section->file_path) }}" target="_blank" class="px-4 py-2 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-sm font-bold rounded-lg shadow-sm transition-all">
                                    Buka File
                                </a>
                            </div>
                        </div>
                    @endif
                
                @elseif($section->type === 'link')
                    @if($section->link_url)
                        <div class="my-6">
                            <a href="{{ $section->link_url }}" target="_blank" class="block p-4 bg-blue-50/50 hover:bg-blue-50 border border-blue-100 hover:border-blue-200 rounded-xl transition-all group">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-blue-900 text-sm group-hover:text-blue-700 transition-colors">{{ $section->link_title ?: 'Tautan Eksternal' }}</h4>
                                            <p class="text-xs text-blue-500 truncate max-w-[200px] sm:max-w-xs">{{ $section->link_url }}</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-blue-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </div>
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        @empty
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
                <h3 class="font-bold text-slate-700">Materi Masih Kosong</h3>
                <p class="text-slate-500 text-sm mt-1">Belum ada konten yang ditambahkan pada lesson ini.</p>
            </div>
        @endforelse
    </article>
</div>
@endsection
