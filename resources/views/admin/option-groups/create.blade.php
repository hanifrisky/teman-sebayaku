@extends('layouts.admin')

@section('title', 'Buat Grup Pilihan Jawaban')
@section('page-title', 'Buat Grup Pilihan')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 animate-fade-in">
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Form Grup Pilihan Baru</h3>
            <a href="{{ route('admin.option-groups.index') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Kembali ke Daftar</a>
        </div>

        <form action="{{ route('admin.option-groups.store') }}" method="POST" class="space-y-6" x-data="{ 
            items: [
                { label: 'Sangat Sesuai', score: 4 },
                { label: 'Sesuai', score: 3 },
                { label: 'Tidak Sesuai', score: 2 },
                { label: 'Sangat Tidak Sesuai', score: 1 }
            ],
            addItem() {
                this.items.push({ label: '', score: 1 });
            },
            removeItem(index) {
                if (this.items.length > 1) {
                    this.items.splice(index, 1);
                } else {
                    alert('Minimal harus ada 1 opsi pilihan jawaban.');
                }
            }
        }">
            @csrf

            <!-- Group Name -->
            <div>
                <label for="name" class="form-label">Nama Grup Pilihan</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       class="form-input" 
                       placeholder="Contoh: Skala Kesejahteraan 4 Opsi" />
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dynamic Items -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <label class="form-label mb-0">Item Opsi Pilihan & Skor</label>
                    <button type="button" @click="addItem()" class="inline-flex items-center gap-1.5 text-xs text-blue-600 hover:text-blue-700 font-bold bg-blue-50 hover:bg-blue-100/85 px-3 py-1.5 rounded-xl border border-blue-100 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Tambah Opsi
                    </button>
                </div>

                <div class="space-y-3">
                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex items-center gap-3 p-3 bg-slate-50 border border-slate-100 rounded-2xl animate-fade-in">
                            <div class="flex-1">
                                <input type="text" 
                                       :name="'items[' + index + '][label]'" 
                                       x-model="item.label" 
                                       required 
                                       class="form-input bg-white" 
                                       placeholder="Label Opsi (misal: Sesuai)" />
                            </div>
                            <div class="w-24">
                                <input type="number" 
                                       :name="'items[' + index + '][score]'" 
                                       x-model.number="item.score" 
                                       required 
                                       class="form-input bg-white text-center" 
                                       placeholder="Skor" />
                            </div>
                            <button type="button" @click="removeItem(index)" class="p-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-all border border-transparent hover:border-red-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.option-groups.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Grup</button>
            </div>
        </form>
    </div>
</div>
@endsection
