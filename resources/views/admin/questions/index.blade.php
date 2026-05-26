@extends('layouts.admin')

@section('title', 'Soal Instrumen Wellbeing')
@section('page-title', 'Soal Instrumen')

@section('header-actions')
<div class="flex items-center gap-3">
    <form id="reorder-form" action="{{ route('admin.questions.reorder') }}" method="POST" class="inline-block">
        @csrf
        <input type="hidden" name="question_order" id="question-order-input">
        <button type="submit" id="btn-save-order" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-slate-100 to-slate-200 text-slate-400 font-semibold rounded-xl border border-slate-200 transition-all duration-200 text-sm cursor-not-allowed" disabled>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
            Simpan Urutan
        </button>
    </form>
    <a href="{{ route('admin.questions.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Soal Baru
    </a>
</div>
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
                            <th class="w-32 text-center">No Urut</th>
                            <th>Teks Pertanyaan</th>
                            <th>Grup Pilihan Jawaban</th>
                            <th class="w-40 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($questions as $question)
                            <tr draggable="true" data-id="{{ $question->id }}" class="drag-row cursor-grab active:cursor-grabbing hover:bg-slate-50/80">
                                <td>
                                    <div class="flex items-center justify-center gap-2.5 py-2">
                                        <!-- Drag Handle -->
                                        <div class="text-slate-300 hover:text-slate-500 drag-handle flex-shrink-0" title="Tarik untuk mengurutkan">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M9 8h2v2H9V8zm0 4h2v2H9v-2zm0 4h2v2H9v-2zm4-8h2v2h-2V8zm0 4h2v2h-2v-2zm0 4h2v2h-2v-2z"/>
                                            </svg>
                                        </div>
                                        
                                        <!-- Visual Number -->
                                        <span class="font-bold text-slate-500 text-sm row-number min-w-[20px] text-center select-none">{{ $loop->iteration }}</span>
                                        
                                        <!-- Move Buttons -->
                                        <div class="flex flex-col gap-0.5 flex-shrink-0">
                                            <button type="button" class="btn-move-up p-0.5 text-slate-400 hover:text-blue-600 rounded hover:bg-slate-100 transition-colors" title="Pindah ke Atas">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/></svg>
                                            </button>
                                            <button type="button" class="btn-move-down p-0.5 text-slate-400 hover:text-blue-600 rounded hover:bg-slate-100 transition-colors" title="Pindah ke Bawah">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="font-medium text-slate-800 py-4 max-w-lg select-none">{{ $question->text }}</td>
                                <td>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100 select-none">
                                        {{ $question->optionGroup->name }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.questions.edit', $question) }}" class="btn-secondary btn-sm select-none">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger btn-sm select-none">
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

@push('styles')
<style>
    /* Styling untuk baris yang sedang didrag */
    .drag-row {
        transition: background-color 0.15s, opacity 0.15s;
    }
    .drag-row.dragging {
        opacity: 0.4;
        background-color: #f1f5f9 !important;
    }
    
    /* Highlight garis biru tebal saat drag over */
    .drag-row.drag-over-top td {
        border-top: 3px solid #3b82f6 !important;
    }
    .drag-row.drag-over-bottom td {
        border-bottom: 3px solid #3b82f6 !important;
    }
    
    /* Pointer style */
    .drag-handle {
        cursor: grab;
    }
    .drag-handle:active {
        cursor: grabbing;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.querySelector('tbody');
    const btnSave = document.getElementById('btn-save-order');
    const orderInput = document.getElementById('question-order-input');

    if (!tbody || !btnSave || !orderInput) return;

    let draggedRow = null;

    // Fungsi untuk memperbarui nomor urutan dan tombol up/down di UI
    function updateUIState() {
        const rows = tbody.querySelectorAll('tr.drag-row');
        rows.forEach((row, index) => {
            // Update nomor urut visual
            const numSpan = row.querySelector('.row-number');
            if (numSpan) {
                numSpan.textContent = index + 1;
            }
            
            // Atur status aktif/tidaknya tombol panah
            const btnUp = row.querySelector('.btn-move-up');
            const btnDown = row.querySelector('.btn-move-down');
            
            if (btnUp) {
                if (index === 0) {
                    btnUp.disabled = true;
                    btnUp.classList.add('opacity-25', 'pointer-events-none');
                } else {
                    btnUp.disabled = false;
                    btnUp.classList.remove('opacity-25', 'pointer-events-none');
                }
            }
            
            if (btnDown) {
                if (index === rows.length - 1) {
                    btnDown.disabled = true;
                    btnDown.classList.add('opacity-25', 'pointer-events-none');
                } else {
                    btnDown.disabled = false;
                    btnDown.classList.remove('opacity-25', 'pointer-events-none');
                }
            }
        });
    }

    // Fungsi untuk memicu perubahan urutan
    function onOrderChanged() {
        // Aktifkan tombol Simpan
        btnSave.disabled = false;
        btnSave.classList.remove('from-slate-100', 'to-slate-200', 'text-slate-400', 'cursor-not-allowed', 'border-slate-200');
        btnSave.classList.add('from-emerald-600', 'to-emerald-700', 'text-white', 'shadow-lg', 'shadow-emerald-500/25', 'hover:shadow-emerald-500/40', 'hover:from-emerald-700', 'hover:to-emerald-800');
        
        // Kumpulkan ID terurut dalam format JSON
        const rows = tbody.querySelectorAll('tr.drag-row');
        const ids = Array.from(rows).map(row => row.dataset.id);
        orderInput.value = JSON.stringify(ids);
    }

    // Menginisialisasi event listener untuk setiap baris
    function initRow(row) {
        // Drag Start
        row.addEventListener('dragstart', function(e) {
            draggedRow = this;
            this.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', this.dataset.id);
        });

        // Drag End
        row.addEventListener('dragend', function() {
            draggedRow = null;
            this.classList.remove('dragging');
            
            // Hapus kelas highlight dari seluruh baris
            tbody.querySelectorAll('tr.drag-row').forEach(r => {
                r.classList.remove('drag-over-top', 'drag-over-bottom');
            });
        });

        // Drag Over
        row.addEventListener('dragover', function(e) {
            if (draggedRow === this) return;
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';

            const rect = this.getBoundingClientRect();
            const midpoint = rect.top + rect.height / 2;
            
            if (e.clientY < midpoint) {
                this.classList.add('drag-over-top');
                this.classList.remove('drag-over-bottom');
            } else {
                this.classList.add('drag-over-bottom');
                this.classList.remove('drag-over-top');
            }
        });

        // Drag Leave
        row.addEventListener('dragleave', function() {
            this.classList.remove('drag-over-top', 'drag-over-bottom');
        });

        // Drop
        row.addEventListener('drop', function(e) {
            e.preventDefault();
            if (draggedRow === this) return;

            const rect = this.getBoundingClientRect();
            const midpoint = rect.top + rect.height / 2;
            const insertBefore = e.clientY < midpoint;

            if (insertBefore) {
                tbody.insertBefore(draggedRow, this);
            } else {
                tbody.insertBefore(draggedRow, this.nextSibling);
            }

            this.classList.remove('drag-over-top', 'drag-over-bottom');
            updateUIState();
            onOrderChanged();
        });

        // Tombol Move Up
        const btnUp = row.querySelector('.btn-move-up');
        if (btnUp) {
            btnUp.addEventListener('click', function(e) {
                e.preventDefault();
                const prev = row.previousElementSibling;
                if (prev && prev.classList.contains('drag-row')) {
                    tbody.insertBefore(row, prev);
                    updateUIState();
                    onOrderChanged();
                }
            });
        }

        // Tombol Move Down
        const btnDown = row.querySelector('.btn-move-down');
        if (btnDown) {
            btnDown.addEventListener('click', function(e) {
                e.preventDefault();
                const next = row.nextElementSibling;
                if (next && next.classList.contains('drag-row')) {
                    tbody.insertBefore(next, row);
                    updateUIState();
                    onOrderChanged();
                }
            });
        }
    }

    // Inisialisasi awal
    const rows = tbody.querySelectorAll('tr.drag-row');
    rows.forEach(row => initRow(row));
    
    // Panggil sekali untuk menonaktifkan tombol panah atas baris pertama, dll.
    updateUIState();
});
</script>
@endpush
@endsection
