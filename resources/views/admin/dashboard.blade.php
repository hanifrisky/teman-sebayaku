@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-8 animate-fade-in">
    {{-- Welcome card --}}
    <div class="p-6 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-3xl text-white shadow-xl shadow-blue-500/10">
        <h3 class="text-2xl font-bold">Selamat Datang kembali, {{ auth()->user()->name }}!</h3>
        <p class="text-blue-100 mt-1.5 text-sm">Kelola instrumen kesejahteraan psikologis, suku budaya, materi self-help, dan data konselor dari satu tempat.</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Stat 1: Konseli --}}
        <div class="stat-card">
            <div class="stat-icon bg-blue-100 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Konseli</p>
                <h4 class="text-2xl font-bold text-slate-800 mt-0.5">{{ \App\Models\User::where('role', 'konseli')->count() }}</h4>
            </div>
        </div>

        {{-- Stat 2: Konselor --}}
        <div class="stat-card">
            <div class="stat-icon bg-emerald-100 text-emerald-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Konselor Sebaya</p>
                <h4 class="text-2xl font-bold text-slate-800 mt-0.5">{{ \App\Models\User::where('role', 'konselor')->count() }}</h4>
            </div>
        </div>

        {{-- Stat 3: Suku Budaya --}}
        <div class="stat-card">
            <div class="stat-icon bg-amber-100 text-amber-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Suku Budaya</p>
                <h4 class="text-2xl font-bold text-slate-800 mt-0.5">{{ \App\Models\Tribe::count() }}</h4>
            </div>
        </div>

        {{-- Stat 4: Pertanyaan --}}
        <div class="stat-card">
            <div class="stat-icon bg-indigo-100 text-indigo-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Soal Kuesioner</p>
                <h4 class="text-2xl font-bold text-slate-800 mt-0.5">{{ \App\Models\Question::count() }}</h4>
            </div>
        </div>
    </div>

    {{-- Quick actions and details --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left side --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="card p-6">
                <h3 class="font-bold text-lg text-slate-800 mb-4">Pengguna Terdaftar Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-slate-100 text-slate-400 font-semibold">
                                <th class="py-2.5">Nama</th>
                                <th class="py-2.5">Email</th>
                                <th class="py-2.5">Role</th>
                                <th class="py-2.5 text-right">Daftar Pada</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach(\App\Models\User::latest()->take(5)->get() as $u)
                                <tr class="text-slate-600">
                                    <td class="py-3 font-medium text-slate-800">{{ $u->name }}</td>
                                    <td class="py-3">{{ $u->email }}</td>
                                    <td class="py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $u->role === 'admin' ? 'bg-rose-100 text-rose-800' : ($u->role === 'konselor' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ $u->role }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right text-slate-400 text-xs">{{ $u->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Right side: Quick links --}}
        <div class="space-y-6">
            <div class="card p-6">
                <h3 class="font-bold text-lg text-slate-800 mb-4">Pintasan Manajemen</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.option-groups.create') }}" class="flex items-center justify-between p-3.5 bg-slate-50 hover:bg-blue-50/50 hover:text-blue-600 rounded-2xl border border-slate-100 transition-all duration-200">
                        <span class="text-sm font-semibold text-slate-700 hover:text-blue-600">Buat Grup Opsi Jawaban</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('admin.questions.create') }}" class="flex items-center justify-between p-3.5 bg-slate-50 hover:bg-blue-50/50 hover:text-blue-600 rounded-2xl border border-slate-100 transition-all duration-200">
                        <span class="text-sm font-semibold text-slate-700 hover:text-blue-600">Tambah Pertanyaan Baru</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('admin.counselors.create') }}" class="flex items-center justify-between p-3.5 bg-slate-50 hover:bg-blue-50/50 hover:text-blue-600 rounded-2xl border border-slate-100 transition-all duration-200">
                        <span class="text-sm font-semibold text-slate-700 hover:text-blue-600">Tambah Konselor Baru</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('admin.tribes.create') }}" class="flex items-center justify-between p-3.5 bg-slate-50 hover:bg-blue-50/50 hover:text-blue-600 rounded-2xl border border-slate-100 transition-all duration-200">
                        <span class="text-sm font-semibold text-slate-700 hover:text-blue-600">Tambah Suku Baru</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
