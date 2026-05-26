@extends('layouts.konseli')
@section('page-title', 'Pembelajaran')
@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Pembelajaran</h1>
    <p class="text-slate-500 mt-2 text-lg max-w-2xl">Jelajahi berbagai materi edukasi, tips, dan panduan yang telah disusun khusus untuk membantu perkembangan dan kesejahteraan Anda.</p>
</div>
{{-- Search Bar --}}
    <div class="sticky top-0 z-20 bg-slate-50/90 backdrop-blur pb-5 mb-8">
        <form action="{{ route('konseli.lessons.index') }}" method="GET">
            <div class="flex items-center gap-3 max-w-3xl mx-auto">

                {{-- Input --}}
                <div class="relative flex-1">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari pembelajaran..."
                        class="w-full h-12 pl-12 pr-4 rounded-full border border-slate-300 bg-white shadow-sm text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    >
                </div>

                {{-- Button --}}
                <button
                    type="submit"
                    class="h-12 px-6 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition shadow-sm whitespace-nowrap"
                >
                    Cari
                </button>
            </div>
        </form>
    </div>

{{-- Lessons Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pb-20">
    @forelse($lessons as $lesson)
        <a href="{{ route('konseli.lessons.show', $lesson) }}" class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
            <div class="aspect-video w-full bg-slate-100 relative overflow-hidden">
                <img src="{{ $lesson->thumbnail }}" alt="{{ $lesson->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <!-- @if($lesson->tag)
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur text-slate-800 text-xs font-bold rounded-full shadow-sm">
                            {{ $lesson->tag }}
                        </span>
                    </div>
                @endif -->
            </div>
            <div class="p-5 flex-1 flex flex-col">
                <h3 class="font-bold text-lg text-slate-800 line-clamp-2 mb-2 group-hover:text-blue-600 transition-colors">{{ $lesson->title }}</h3>
                
                <!-- <div class="mt-auto flex items-center justify-between text-xs text-slate-500 font-medium">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>{{ $lesson->creator->name ?? 'Tim Konselor' }}</span>
                    </div>
                </div> -->
                @if($lesson->tag)
                <div class="mt-auto flex items-center justify-between text-xs text-slate-500 font-medium">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.0498 7.0498H7.0598M10.5118 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V10.5118C3 11.2455 3 11.6124 3.08289 11.9577C3.15638 12.2638 3.27759 12.5564 3.44208 12.8249C3.6276 13.1276 3.88703 13.387 4.40589 13.9059L9.10589 18.6059C10.2939 19.7939 10.888 20.388 11.5729 20.6105C12.1755 20.8063 12.8245 20.8063 13.4271 20.6105C14.112 20.388 14.7061 19.7939 15.8941 18.6059L18.6059 15.8941C19.7939 14.7061 20.388 14.112 20.6105 13.4271C20.8063 12.8245 20.8063 12.1755 20.6105 11.5729C20.388 10.888 19.7939 10.2939 18.6059 9.10589L13.9059 4.40589C13.387 3.88703 13.1276 3.6276 12.8249 3.44208C12.5564 3.27759 12.2638 3.15638 11.9577 3.08289C11.6124 3 11.2455 3 10.5118 3ZM7.5498 7.0498C7.5498 7.32595 7.32595 7.5498 7.0498 7.5498C6.77366 7.5498 6.5498 7.32595 6.5498 7.0498C6.5498 6.77366 6.77366 6.5498 7.0498 6.5498C7.32595 6.5498 7.5498 6.77366 7.5498 7.0498Z"/></svg>
                        <span>{{ $lesson->tag }}</span>
                    </div>
                </div>
                @endif
                <!-- <div class="mt-auto flex items-center justify-between text-xs text-slate-500 font-medium">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $lesson->created_at->diffForHumans() }}</span>
                    </div>
                </div> -->
            </div>
        </a>
    @empty
        <div class="col-span-full py-20 text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-700 mb-1">Tidak ada materi ditemukan</h3>
            <p class="text-slate-500">Silakan coba kata kunci lain atau periksa kembali nanti.</p>
        </div>
    @endforelse
</div>
{{-- Pagination --}}
<div class="mt-8">
    {{ $lessons->links() }}
</div>
@endsection