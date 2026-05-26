@props(['action', 'method', 'isEdit' => false, 'lesson' => null])

@php
    $sectionsData = [];
    if ($isEdit && $lesson && $lesson->sections) {
        $sectionsData = $lesson->sections->map(function($sec) {
            return [
                'id' => uniqid(),
                'id_db' => $sec->id,
                'type' => $sec->type,
                'content_text' => $sec->content_text,
                'link_url' => $sec->link_url,
                'link_title' => $sec->link_title,
                'file_path' => $sec->file_path,
            ];
        });
    }
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" id="lessonForm">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif
    
    <div x-data="lessonBuilder({{ Js::from($sectionsData) }})" 
         @dragover.prevent="dragOverMain" 
         @drop="dropEmpty" 
         class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start relative">
        
        {{-- Kiri (2 Kolom): Builder --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 min-h-[400px]">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-slate-800">Konten Lesson</h3>
                    <span class="text-sm font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full" x-text="sections.length + ' Section'"></span>
                </div>

                {{-- Empty State --}}
                <div x-show="sections.length === 0" class="text-center py-12 border-2 border-dashed border-slate-200 rounded-xl"
                     :class="{'bg-blue-50 border-blue-300': dragOverIndex === 'empty'}">
                    <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3"
                         :class="{'text-blue-500 bg-blue-100': dragOverIndex === 'empty'}">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <p class="text-slate-500 font-medium">Belum ada konten.</p>
                    <p class="text-sm text-slate-400 mt-1">Seret jenis konten dari panel kanan ke sini atau klik.</p>
                </div>

                {{-- Sections List --}}
                <div class="space-y-4" id="sections-container" @dragleave="dragLeave">
                    <template x-for="(section, index) in sections" :key="section.id">
                        <div class="relative">
                            {{-- Drop indicator top --}}
                            <div x-show="dragOverIndex === index && dragPosition === 'top'" class="h-1 bg-blue-500 rounded-full absolute -top-2 left-0 right-0 z-10 pointer-events-none"></div>

                            <div class="relative border border-slate-200 rounded-xl bg-slate-50 p-4 group transition-opacity" 
                                 draggable="true" 
                                 @dragstart="dragStart(index, $event)" 
                                 @dragend="dragEnd($event)"
                                 @dragover.prevent="dragOver(index, $event)" 
                                 @drop="drop(index)">
                                
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold px-2 py-1 bg-slate-200 text-slate-600 rounded" x-text="getTypeLabel(section.type)"></span>
                                        <span class="text-sm text-slate-400 font-medium" x-text="'Bagian ' + (index + 1)"></span>
                                    </div>
                                    
                                    {{-- Controls --}}
                                    <div class="flex items-center gap-1 z-20">
                                        <button type="button" @click="moveUp(index)" x-show="index > 0" class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                        </button>
                                        <button type="button" @click="moveDown(index)" x-show="index < sections.length - 1" class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </button>
                                        <button type="button" @click="promptDuplicate(index)" class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/></svg>
                                        </button>
                                        <button type="button" @click="promptDelete(index)" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                        <div class="w-px h-4 bg-slate-300 mx-1"></div>
                                        <div class="p-1.5 text-slate-400 cursor-grab active:cursor-grabbing hover:bg-slate-200 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 6a2 2 0 11-4 0 2 2 0 014 0zM8 12a2 2 0 11-4 0 2 2 0 014 0zM8 18a2 2 0 11-4 0 2 2 0 014 0zM20 6a2 2 0 11-4 0 2 2 0 014 0zM20 12a2 2 0 11-4 0 2 2 0 014 0zM20 18a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        </div>
                                    </div>
                                </div>

                                {{-- Hidden Inputs --}}
                                <input type="hidden" :name="'sections['+index+'][type]'" :value="section.type">
                                <input type="hidden" :name="'sections['+index+'][order]'" :value="index">
                                <input type="hidden" :name="'sections['+index+'][id]'" :value="section.id_db || ''">
                                <input type="hidden" :name="'sections['+index+'][file_path]'" :value="section.file_path || ''">

                                {{-- Teks --}}
                                <template x-if="section.type === 'text'">
                                    <textarea :name="'sections['+index+'][content_text]'" x-model="section.content_text" rows="4" class="w-full bg-white border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm" placeholder="Tuliskan materi teks di sini..."></textarea>
                                </template>

                                {{-- Image, PDF, Video Upload --}}
                                <template x-if="['image', 'pdf', 'video'].includes(section.type)">
                                    <div x-data="fileUploader(section.type, section.file_path)" 
                                         class="relative border-2 border-dashed rounded-2xl p-6 text-center transition-colors"
                                         :class="isDragging ? 'border-blue-500 bg-blue-50' : 'border-slate-300 bg-white hover:bg-slate-50'"
                                         @dragover.prevent="isDragging = true"
                                         @dragleave.prevent="isDragging = false"
                                         @drop.prevent="handleDrop($event, $refs.fileInput)">
                                         
                                         <input type="file" :name="'sections['+index+'][file]'" x-ref="fileInput" @change="handleChange($event)"
                                                :accept="section.type === 'image' ? 'image/*' : (section.type === 'video' ? 'video/mp4,video/x-m4v,video/*' : 'application/pdf')" 
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" :required="!section.file_path">
                                                
                                         <div class="pointer-events-none relative z-0">
                                             {{-- Preview Image/Video --}}
                                             <template x-if="preview && preview !== 'pdf'">
                                                 <div class="mb-4 relative rounded-xl overflow-hidden inline-block bg-slate-900 max-h-64 shadow-md w-full sm:w-auto">
                                                    <template x-if="section.type === 'video' || (preview && preview.startsWith('blob') && !preview.includes('image'))">
                                                         <video :src="preview" controls class="max-h-64 mx-auto"></video>
                                                    </template>
                                                    <template x-if="section.type === 'image'">
                                                         <img :src="preview" class="max-h-64 mx-auto object-contain">
                                                    </template>
                                                 </div>
                                             </template>
                                             
                                             {{-- Preview PDF --}}
                                             <template x-if="preview === 'pdf' || (preview && section.type === 'pdf')">
                                                 <div class="mb-4 p-4 bg-red-50 border border-red-100 text-red-600 rounded-xl inline-flex flex-col items-center gap-2 shadow-sm">
                                                     <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                     <span class="font-bold text-sm">Dokumen PDF Terpilih</span>
                                                 </div>
                                             </template>

                                             {{-- Empty State / Instructions --}}
                                             <template x-if="!preview">
                                                 <div class="text-slate-500 py-4">
                                                     <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-400">
                                                         <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                                     </div>
                                                     <p class="font-bold text-slate-700">Pilih atau seret file ke sini</p>
                                                     <p class="text-xs text-slate-400 mt-1" x-text="section.type === 'image' ? 'Mendukung: JPG, PNG, GIF' : (section.type === 'video' ? 'Mendukung: MP4, MOV' : 'Mendukung: PDF')"></p>
                                                 </div>
                                             </template>
                                             <template x-if="preview">
                                                 <p class="text-sm font-medium text-blue-600 mt-2 bg-blue-50 py-1.5 px-4 rounded-full inline-block">Ganti File</p>
                                             </template>
                                         </div>
                                    </div>
                                </template>

                                {{-- YouTube --}}
                                <template x-if="section.type === 'youtube'">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-bold text-slate-700 mb-1">Tautan YouTube</label>
                                            <input type="text" :name="'sections['+index+'][content_text]'" x-model="section.content_text" class="w-full bg-white border-slate-300 rounded-xl shadow-sm focus:border-red-500 focus:ring focus:ring-red-200" placeholder="https://youtube.com/watch?v=... atau tempel kode <iframe>" required>
                                        </div>
                                        <div class="aspect-video bg-slate-100 rounded-2xl overflow-hidden border border-slate-200 relative shadow-sm">
                                            <template x-if="getYoutubeId(section.content_text)">
                                                <iframe class="w-full h-full absolute inset-0" :src="'https://www.youtube.com/embed/' + getYoutubeId(section.content_text)" frameborder="0" allowfullscreen></iframe>
                                            </template>
                                            <template x-if="!getYoutubeId(section.content_text)">
                                                <div class="flex flex-col items-center justify-center w-full h-full text-slate-400 p-6 text-center">
                                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm text-red-500">
                                                        <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                                    </div>
                                                    <p class="font-medium">Preview video akan muncul di sini</p>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                {{-- Link --}}
                                <template x-if="section.type === 'link'">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-700 mb-1">Judul Tautan</label>
                                            <input type="text" :name="'sections['+index+'][link_title]'" x-model="section.link_title" class="w-full bg-white border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm" placeholder="Teks untuk tautan">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-700 mb-1">URL</label>
                                            <input type="url" :name="'sections['+index+'][link_url]'" x-model="section.link_url" class="w-full bg-white border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm" placeholder="https://...">
                                        </div>
                                    </div>
                                </template>

                            </div>
                            
                            {{-- Drop indicator bottom --}}
                            <div x-show="dragOverIndex === index && dragPosition === 'bottom'" class="h-1 bg-blue-500 rounded-full absolute -bottom-2 left-0 right-0 z-10 pointer-events-none"></div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- Kanan (1 Kolom): Metadata & Tambah Section --}}
        <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-24">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Informasi Utama</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Judul Lesson *</label>
                        <input type="text" name="title" value="{{ $isEdit ? $lesson->title : '' }}" required class="w-full border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Masukkan judul...">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kategori / Tag</label>
                        <input type="text" name="tag" value="{{ $isEdit ? $lesson->tag : '' }}" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Misal: Psikologi, Tips, dll.">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-sm font-bold text-slate-800 mb-3">Tambah Konten</h3>
                <p class="text-xs text-slate-500 mb-4">Klik untuk menambahkan ke bawah, atau seret (drag) ke posisi yang diinginkan di sebelah kiri.</p>
                
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" @click="addSection('text')" draggable="true" @dragstart="dragStartNew('text', $event)" @dragend="dragEndNew($event)"
                            class="flex flex-col items-center justify-center p-3 border border-slate-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 cursor-grab active:cursor-grabbing transition-colors group relative">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        <span class="text-xs font-medium text-slate-600 group-hover:text-blue-700">Teks</span>
                    </button>
                    
                    <button type="button" @click="addSection('image')" draggable="true" @dragstart="dragStartNew('image', $event)" @dragend="dragEndNew($event)"
                            class="flex flex-col items-center justify-center p-3 border border-slate-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 cursor-grab active:cursor-grabbing transition-colors group relative">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-xs font-medium text-slate-600 group-hover:text-blue-700">Gambar</span>
                    </button>
                    
                    <button type="button" @click="addSection('video')" draggable="true" @dragstart="dragStartNew('video', $event)" @dragend="dragEndNew($event)"
                            class="flex flex-col items-center justify-center p-3 border border-slate-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 cursor-grab active:cursor-grabbing transition-colors group relative">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span class="text-xs font-medium text-slate-600 group-hover:text-blue-700">Video</span>
                    </button>
                    
                    <button type="button" @click="addSection('youtube')" draggable="true" @dragstart="dragStartNew('youtube', $event)" @dragend="dragEndNew($event)"
                            class="flex flex-col items-center justify-center p-3 border border-slate-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 cursor-grab active:cursor-grabbing transition-colors group relative">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-red-500 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        <span class="text-xs font-medium text-slate-600 group-hover:text-red-700">YouTube</span>
                    </button>
                    
                    <button type="button" @click="addSection('pdf')" draggable="true" @dragstart="dragStartNew('pdf', $event)" @dragend="dragEndNew($event)"
                            class="flex flex-col items-center justify-center p-3 border border-slate-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 cursor-grab active:cursor-grabbing transition-colors group relative">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span class="text-xs font-medium text-slate-600 group-hover:text-blue-700">PDF</span>
                    </button>
                    
                    <button type="button" @click="addSection('link')" draggable="true" @dragstart="dragStartNew('link', $event)" @dragend="dragEndNew($event)"
                            class="flex flex-col items-center justify-center p-3 border border-slate-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 cursor-grab active:cursor-grabbing transition-colors group relative">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        <span class="text-xs font-medium text-slate-600 group-hover:text-blue-700">Tautan Luar</span>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-sm transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                {{ $isEdit ? 'Perbarui Lesson' : 'Simpan Lesson' }}
            </button>
        </div>

        {{-- Modal Konfirmasi --}}
        <div x-show="modal.open" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0" style="display: none;">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" @click="closeModal"></div>
            <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full relative z-10 p-6 sm:p-8 animate-fade-in">
                <h4 class="text-xl font-bold text-slate-800 mb-2" x-text="modal.title"></h4>
                <p class="text-slate-600 text-sm sm:text-base mb-8 leading-relaxed" x-text="modal.message"></p>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3">
                    <button type="button" @click="closeModal" class="px-5 py-3 sm:py-2.5 text-sm font-bold text-slate-600 hover:text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors order-2 sm:order-1">Batal</button>
                    <button type="button" @click="confirmModal" 
                            class="px-5 py-3 sm:py-2.5 text-sm font-bold text-white rounded-xl transition-colors order-1 sm:order-2 shadow-sm"
                            :class="modal.type === 'delete' ? 'bg-red-600 hover:bg-red-700' : 'bg-blue-600 hover:bg-blue-700'">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
document.addEventListener('alpine:init', () => {
    window.lessonBuilder = function(initialData = []) {
        return {
            sections: initialData,
            
            // Drag states
            draggedIndex: null,
            draggedNewType: null,
            dragOverIndex: null,
            dragPosition: null, // 'top' or 'bottom'
            
            // Modal states
            modal: { open: false, type: '', index: null, title: '', message: '' },
            
            addSection(type) {
                this.sections.push(this.createNewSection(type));
                setTimeout(() => {
                    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
                }, 100);
            },
            
            createNewSection(type) {
                return {
                    id: Date.now() + Math.random().toString(36).substr(2, 9),
                    type: type,
                    content_text: '',
                    link_title: '',
                    link_url: '',
                    file_path: ''
                };
            },

            promptDelete(index) {
                this.modal = { 
                    open: true, 
                    type: 'delete', 
                    index: index, 
                    title: 'Hapus Section', 
                    message: 'Apakah Anda yakin ingin menghapus section materi ini? Aksi ini akan menghapus form isian (file akan benar-benar terhapus setelah Anda menyimpan).' 
                };
            },
            
            promptDuplicate(index) {
                this.modal = { 
                    open: true, 
                    type: 'duplicate', 
                    index: index, 
                    title: 'Duplikat Section', 
                    message: 'Buat salinan dari section ini?' 
                };
            },
            
            confirmModal() {
                if (this.modal.type === 'delete') {
                    this.sections.splice(this.modal.index, 1);
                } else if (this.modal.type === 'duplicate') {
                    const sec = this.sections[this.modal.index];
                    this.sections.splice(this.modal.index + 1, 0, {
                        ...sec,
                        id: Date.now() + Math.random().toString(36).substr(2, 9),
                        id_db: null
                    });
                }
                this.modal.open = false;
            },
            
            closeModal() {
                this.modal.open = false;
            },
            
            moveUp(index) {
                if (index > 0) {
                    const temp = this.sections[index];
                    this.sections[index] = this.sections[index - 1];
                    this.sections[index - 1] = temp;
                }
            },
            
            moveDown(index) {
                if (index < this.sections.length - 1) {
                    const temp = this.sections[index];
                    this.sections[index] = this.sections[index + 1];
                    this.sections[index + 1] = temp;
                }
            },
            
            dragStart(index, event) {
                this.draggedIndex = index;
                this.draggedNewType = null;
                event.dataTransfer.effectAllowed = 'move';
                
                // Opacity during drag
                setTimeout(() => {
                    event.target.classList.add('opacity-80');
                }, 10);
            },
            
            dragEnd(event) {
                event.target.classList.remove('opacity-80');
                this.clearDragState();
            },
            
            dragStartNew(type, event) {
                this.draggedNewType = type;
                this.draggedIndex = null;
                event.dataTransfer.effectAllowed = 'copy';
                
                setTimeout(() => {
                    event.target.classList.add('opacity-50');
                }, 10);
            },
            
            dragEndNew(event) {
                event.target.classList.remove('opacity-50');
                this.clearDragState();
            },
            
            dragOverMain(event) {
                // If dragging over empty area and no sections exist
                if (this.sections.length === 0) {
                    this.dragOverIndex = 'empty';
                }
            },

            dragOver(index, event) {
                this.dragOverIndex = index;
                const rect = event.currentTarget.getBoundingClientRect();
                const y = event.clientY - rect.top;
                
                // Show line at top if mouse is in top half, bottom if in bottom half
                this.dragPosition = (y < rect.height / 2) ? 'top' : 'bottom';
            },
            
            dragLeave() {
                this.dragOverIndex = null;
                this.dragPosition = null;
            },
            
            drop(index) {
                let targetIndex = this.dragPosition === 'bottom' ? index + 1 : index;
                
                if (this.draggedNewType) {
                    // Dropping a new section button
                    this.sections.splice(targetIndex, 0, this.createNewSection(this.draggedNewType));
                } else if (this.draggedIndex !== null) {
                    // Reordering existing sections
                    if (this.draggedIndex === index) {
                        this.clearDragState();
                        return;
                    }
                    
                    if (this.draggedIndex < targetIndex) {
                        targetIndex--;
                    }
                    
                    const draggedItem = this.sections.splice(this.draggedIndex, 1)[0];
                    this.sections.splice(targetIndex, 0, draggedItem);
                }
                this.clearDragState();
            },
            
            dropEmpty() {
                if (this.sections.length === 0 && this.draggedNewType) {
                    this.sections.push(this.createNewSection(this.draggedNewType));
                }
                this.clearDragState();
            },
            
            clearDragState() {
                this.draggedIndex = null;
                this.draggedNewType = null;
                this.dragOverIndex = null;
                this.dragPosition = null;
            },
            
            getTypeLabel(type) {
                const labels = {
                    'text': 'Teks',
                    'image': 'Gambar',
                    'video': 'Video File',
                    'youtube': 'YouTube',
                    'pdf': 'PDF',
                    'link': 'Tautan'
                };
                return labels[type] || type;
            },
            
            getYoutubeId(url) {
                if (!url) return null;
                const regExp = /(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
                const match = url.match(regExp);
                return match ? match[1] : null;
            }
        }
    }
    
    window.fileUploader = function(type, existingPath) {
        return {
            isDragging: false,
            preview: existingPath ? '/storage/' + existingPath : null,
            
            handleDrop(e, inputRef) {
                this.isDragging = false;
                if (e.dataTransfer.files.length > 0) {
                    const file = e.dataTransfer.files[0];
                    if (this.isValidType(file, type)) {
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        inputRef.files = dt.files;
                        this.updatePreview(file, type);
                    } else {
                        alert('Tipe file tidak didukung untuk bagian ini.');
                    }
                }
            },
            
            handleChange(e) {
                if (e.target.files.length > 0) {
                    this.updatePreview(e.target.files[0], type);
                }
            },
            
            isValidType(file, type) {
                if (type === 'image' && file.type.startsWith('image/')) return true;
                if (type === 'video' && file.type.startsWith('video/')) return true;
                if (type === 'pdf' && file.type === 'application/pdf') return true;
                return false;
            },
            
            updatePreview(file, type) {
                if (file.type.startsWith('image/') || file.type.startsWith('video/')) {
                    this.preview = URL.createObjectURL(file);
                } else if (file.type === 'application/pdf') {
                    this.preview = 'pdf';
                }
            }
        }
    }
});
</script>
