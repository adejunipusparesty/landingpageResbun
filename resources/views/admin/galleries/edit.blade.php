@extends('layouts.admin')

@section('title', 'Edit Foto Galeri - RSIA Restu Bunda')
@section('page-title', 'Edit Foto Galeri')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.galleries.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Galeri Foto</span>
        </a>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5 text-xs">
            @csrf
            @method('PUT')

            <!-- Upload Foto Galeri & Preview -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                    <i class="fa-solid fa-image text-brand-600 mr-1.5"></i> File Foto Dokumentasi
                </label>
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="relative w-full sm:w-56 aspect-[4/3] rounded-2xl overflow-hidden border-2 border-emerald-500/20 bg-slate-200 shadow-sm shrink-0">
                        <img id="galleryPreview" src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                        <span class="absolute bottom-2 left-2 bg-slate-900/80 text-white text-[9px] font-bold px-2 py-0.5 rounded-full">
                            Foto Saat Ini
                        </span>
                    </div>

                    <div class="flex-1 space-y-2 text-center sm:text-left w-full">
                        <label for="image_file" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span>Ganti File Foto</span>
                        </label>
                        <input type="file" id="image_file" name="image_file" accept="image/*" class="hidden" onchange="previewGalleryImage(this)">
                        <p class="text-[11px] text-slate-500">
                            Kosongkan jika tidak ingin mengganti foto yang sudah ada.
                        </p>
                        <div class="pt-1">
                            <span class="text-[10px] text-slate-400 block font-medium">Atau gunakan nama file foto bawaan:</span>
                            <input type="text" name="image" value="{{ $gallery->image }}" class="mt-1 w-full max-w-sm p-2 rounded-lg border border-slate-200 bg-white text-xs text-slate-700 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Judul / Caption Foto</label>
                <input type="text" name="title" value="{{ $gallery->title }}" required class="w-full p-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none text-slate-800 font-semibold">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Kategori Galeri</label>
                    <select name="category" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $gallery->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tanggal Kegiatan</label>
                    <input type="date" name="event_date" value="{{ $gallery->event_date ? $gallery->event_date->format('Y-m-d') : date('Y-m-d') }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Urutan Tampil</label>
                    <input type="number" name="order_num" value="{{ $gallery->order_num }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Keterangan / Narasi Foto (Rich Text Editor)</label>
                <input type="hidden" name="description" id="gallery_description" value="{{ $gallery->description }}">
                <div id="quill-gallery-desc" class="rounded-2xl border border-slate-200"></div>
                <span class="text-[11px] text-slate-400 mt-1 block">Tuliskan penjelasan kegiatan, dokter/petugas yang terlibat, atau informasi fasilitas terkait.</span>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $gallery->is_active ? 'checked' : '' }} class="rounded text-brand-600 focus:ring-brand-500">
                <label for="is_active" class="font-bold text-slate-700 cursor-pointer">Tampilkan Foto ini di Website Publik</label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.galleries.index') }}" class="py-2.5 px-5 rounded-xl border border-slate-200 font-bold text-slate-600 hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="py-2.5 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold shadow transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>

@push('scripts')
<script>
    function previewGalleryImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('galleryPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        window.initRichEditor('quill-gallery-desc', 'gallery_description', 'Tuliskan deskripsi foto atau keterangan kegiatan di sini...');
    });
</script>
@endpush
@endsection
