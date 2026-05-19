@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')

@section('content')
<div class="space-y-6 animate-fade-in">
    {{-- Search & Filter card --}}
    <div class="card p-6 bg-white">
        <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div class="md:col-span-2">
                <label for="search" class="form-label text-xs">Cari Pengguna</label>
                <input type="text" 
                       id="search" 
                       name="search" 
                       value="{{ request('search') }}" 
                       class="form-input" 
                       placeholder="Cari berdasarkan nama atau email..." />
            </div>
            <div>
                <label for="role" class="form-label text-xs">Filter Role</label>
                <select id="role" name="role" class="form-input">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="konselor" {{ request('role') === 'konselor' ? 'selected' : '' }}>Konselor</option>
                    <option value="konseli" {{ request('role') === 'konseli' ? 'selected' : '' }}>Konseli</option>
                </select>
            </div>
            <div class="flex items-center gap-2">
                <button type="submit" class="btn-primary w-full py-2.5">
                    Filter
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary w-full py-2.5 text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Users Table --}}
    <div class="table-container bg-white">
        @if($users->isEmpty())
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <h4 class="text-lg font-bold text-slate-700">Tidak Ada Pengguna Ditemukan</h4>
                <p class="text-sm text-slate-500 mt-1">Coba sesuaikan kata kunci pencarian atau filter role Anda.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Alamat Email</th>
                            <th>Role</th>
                            <th>Terdaftar Pada</th>
                            <th class="w-40 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $user)
                            <tr class="text-slate-600">
                                <td class="font-bold text-slate-800 py-3.5">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-rose-100 text-rose-800' : ($user->role === 'konselor' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="text-slate-400 text-xs">{{ $user->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn-secondary btn-sm">
                                            Edit
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger btn-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-400 font-semibold italic">Akun Anda</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
