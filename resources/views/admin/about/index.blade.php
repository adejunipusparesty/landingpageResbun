@extends('layouts.admin')

@section('title', 'Kelola Tentang Kami & Direksi - RSIA Restu Bunda')
@section('page-title', 'Tentang Kami & Jajaran Direksi')

@push('styles')
    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    <style>
        .cropper-view-box,
        .cropper-face {
            border-radius: 1rem;
        }
    </style>
@endpush

@section('content')
<div class="space-y-6">

    <!-- Header Description Card -->
    <div class="bg-gradient-to-r from-emerald-800 to-teal-900 rounded-3xl p-6 sm:p-8 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-200 text-[11px] font-bold uppercase tracking-wider mb-3">
                <i class="fa-solid fa-hospital"></i> Profil Institusi
            </span>
            <h2 class="text-xl sm:text-2xl font-black font-heading tracking-tight">Profil, Visi Misi, Sejarah &amp; Direksi</h2>
            <!-- <p class="text-xs sm:text-sm text-emerald-100/80 mt-1 leading-relaxed">
                Kelola informasi resmi identitas rumah sakit. Seluruh inputan narasi telah dilengkapi <strong>Rich Text Editor (format email: Bold, Miring, Bullet list, Heading, Warna)</strong> agar tampil indah di website publik.
            </p> -->
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex items-center gap-2 border-b border-slate-200 text-xs font-bold overflow-x-auto pb-1">
        <button type="button" onclick="switchTab('tab-visi-misi')" id="btn-tab-visi-misi" class="about-tab-btn px-5 py-3 rounded-2xl bg-brand-600 text-white shadow-sm flex items-center gap-2 transition shrink-0">
            <i class="fa-solid fa-compass"></i>
            <span>Visi, Misi &amp; Moto</span>
        </button>
        <button type="button" onclick="switchTab('tab-sejarah')" id="btn-tab-sejarah" class="about-tab-btn px-5 py-3 rounded-2xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 flex items-center gap-2 transition shrink-0">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>Sejarah &amp; Perjalanan RS</span>
        </button>
        <button type="button" onclick="switchTab('tab-direksi')" id="btn-tab-direksi" class="about-tab-btn px-5 py-3 rounded-2xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 flex items-center gap-2 transition shrink-0">
            <i class="fa-solid fa-users-line"></i>
            <span>Jajaran Direksi ({{ $directors->count() }})</span>
        </button>
    </div>

    <!-- TAB 1: VISI, MISI & MOTO -->
    <div id="tab-visi-misi" class="about-tab-content space-y-6">
        <form action="{{ route('admin.about.info.update') }}" method="POST" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6 text-xs">
            @csrf

            <!-- Moto Pelayanan -->
            <div>
                <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider mb-1.5">
                    <i class="fa-solid fa-quote-left text-brand-600 mr-1.5"></i> Moto / Semboyan Pelayanan
                </label>
                <input type="text" name="about_motto" value="{{ $settings['about_motto'] ?? 'Melayani Sepenuh Hati dengan Kasih Bunda' }}" required placeholder="Contoh: Melayani Sepenuh Hati dengan Kasih Bunda" class="w-full p-3.5 rounded-2xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500">
                <span class="text-[11px] text-slate-400 mt-1 block">Moto ini akan menjadi slogan utama di header dan banner Tentang Kami.</span>
            </div>

            <!-- Visi Rumah Sakit -->
            <div>
                <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider mb-1.5">
                    <i class="fa-regular fa-eye text-brand-600 mr-1.5"></i> Visi Rumah Sakit
                </label>
                <!-- Hidden input synced with Quill -->
                <input type="hidden" name="about_vision" id="about_vision" value="{{ $settings['about_vision'] ?? '' }}">
                <div id="quill-vision" class="rounded-2xl border border-slate-200"></div>
                <span class="text-[11px] text-slate-400 mt-1 block">Cita-cita jangka panjang dan arah pengembangan RSIA Restu Bunda.</span>
            </div>

            <!-- Misi Rumah Sakit -->
            <div>
                <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider mb-1.5">
                    <i class="fa-solid fa-list-check text-brand-600 mr-1.5"></i> Misi Rumah Sakit (Bisa Bullet / Numbering)
                </label>
                <!-- Hidden input synced with Quill -->
                <input type="hidden" name="about_mission" id="about_mission" value="{{ $settings['about_mission'] ?? '' }}">
                <div id="quill-mission" class="rounded-2xl border border-slate-200"></div>
                <span class="text-[11px] text-slate-400 mt-1 block">Gunakan fitur <strong>Bullet List (titik)</strong> di toolbar atas untuk merapikan butir-butir misi.</span>
            </div>

            <!-- Nilai-Nilai Budaya (Core Values) -->
            <div>
                <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider mb-1.5">
                    <i class="fa-solid fa-heart-pulse text-brand-600 mr-1.5"></i> Nilai-Nilai Utama / Budaya Kerja (Care, Professional, dll)
                </label>
                <input type="hidden" name="about_core_values" id="about_core_values" value="{{ $settings['about_core_values'] ?? '' }}">
                <div id="quill-core-values" class="rounded-2xl border border-slate-200"></div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="py-3 px-8 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs shadow-md shadow-emerald-600/20 transition active:scale-95 flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Visi, Misi &amp; Moto</span>
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 2: SEJARAH & PERJALANAN RS -->
    <div id="tab-sejarah" class="about-tab-content space-y-6 hidden">
        <form action="{{ route('admin.about.info.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6 text-xs">
            @csrf

            <!-- Upload Foto Gedung / Sejarah -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                    <i class="fa-solid fa-image text-brand-600 mr-1.5"></i> Foto Ilustrasi Sejarah / Gedung Rumah Sakit
                </label>
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="relative w-full sm:w-56 aspect-[16/10] rounded-2xl overflow-hidden border-2 border-emerald-500/20 bg-slate-200 shadow-sm shrink-0">
                        <img id="historyImagePreview" src="{{ asset('images/' . ($settings['about_history_image'] ?? 'hero.jpg')) }}" alt="Preview Sejarah" class="w-full h-full object-cover">
                        <span class="absolute bottom-2 left-2 bg-slate-900/80 text-white text-[9px] font-bold px-2 py-0.5 rounded-full">
                            Preview
                        </span>
                    </div>
                    <div class="flex-1 space-y-2 text-center sm:text-left w-full">
                        <label for="about_history_image_file" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span>Pilih &amp; Upload Foto Sejarah</span>
                        </label>
                        <input type="file" id="about_history_image_file" name="about_history_image_file" accept="image/*" class="hidden" onchange="previewHistoryImage(this)">
                        <p class="text-[11px] text-slate-500">
                            Format JPG, PNG, WEBP (Maksimal 3 MB). Rasio landscape ideal untuk tampilan cerita sejarah.
                        </p>
                        <div class="pt-1">
                            <span class="text-[10px] text-slate-400 block font-medium">Atau gunakan nama file yang ada:</span>
                            <input type="text" name="about_history_image" value="{{ $settings['about_history_image'] ?? 'hero.jpg' }}" class="mt-1 w-full max-w-sm p-2 rounded-lg border border-slate-200 bg-white text-xs text-slate-700 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Narasi Sejarah Komprehensif -->
            <div>
                <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider mb-1.5">
                    <i class="fa-solid fa-book-open text-brand-600 mr-1.5"></i> Narasi Sejarah &amp; Perjalanan Berdirinya RSIA
                </label>
                <input type="hidden" name="about_history" id="about_history" value="{{ $settings['about_history'] ?? '' }}">
                <div id="quill-history" class="rounded-2xl border border-slate-200"></div>
                <span class="text-[11px] text-slate-400 mt-1 block">Tuliskan cerita berdirinya rumah sakit dari klinik bersalin hingga berkembang saat ini. Anda dapat membuat teks tebal, miring, dan paragraf berjenjang.</span>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="py-3 px-8 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs shadow-md shadow-emerald-600/20 transition active:scale-95 flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Cerita Sejarah</span>
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 3: JAJARAN DIREKSI & MANAJEMEN -->
    <div id="tab-direksi" class="about-tab-content space-y-6 hidden">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-extrabold text-slate-900 text-sm sm:text-base font-heading">Struktur Jajaran Direksi &amp; Manajemen</h3>
                <p class="text-xs text-slate-500">Daftar pimpinan dan direktur pengelola RSIA Restu Bunda.</p>
            </div>
            <button type="button" onclick="openAddDirectorModal()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Anggota Direksi</span>
            </button>
        </div>

        <!-- Directors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($directors as $dir)
                <div class="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <!-- Header with Photo and Order badge -->
                        <div class="flex items-start gap-4 mb-4">
                            <div class="relative w-16 h-16 rounded-2xl overflow-hidden border-2 border-emerald-500/30 bg-slate-100 shrink-0 shadow-sm">
                                <img src="{{ $dir->photo_url }}" alt="{{ $dir->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-full {{ $dir->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $dir->is_active ? 'Aktif' : 'Non-aktif' }}
                                    </span>
                                    <span class="text-[10px] text-slate-400">Urutan: #{{ $dir->order_num }}</span>
                                </div>
                                <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm font-heading leading-tight truncate" title="{{ $dir->name }}">{{ $dir->name }}</h4>
                                <p class="text-[11px] font-semibold text-brand-600 truncate mt-0.5">{{ $dir->position }}</p>
                            </div>
                        </div>

                        <!-- Bio / Quote preview -->
                        <div class="text-[11px] text-slate-600 line-clamp-3 bg-slate-50 p-3 rounded-xl border border-slate-100/80 leading-relaxed">
                            {!! strip_tags($dir->bio) ?: 'Belum ada sambutan / bio profil.' !!}
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                        <button type="button" onclick="openEditDirectorModal({{ json_encode($dir) }})" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition">
                            <i class="fa-solid fa-pen-to-square text-emerald-600"></i>
                            <span>Edit</span>
                        </button>

                        <form action="{{ route('admin.about.directors.destroy', $dir->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-xl text-rose-500 hover:bg-rose-50 transition" title="Hapus Direksi">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-3xl border border-dashed border-slate-200">
                    <i class="fa-solid fa-user-tie text-3xl text-slate-300 mb-2"></i>
                    <p class="text-xs font-semibold text-slate-500">Belum ada jajaran direksi yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

<!-- MODAL TAMBAH DIREKSI -->
<div id="addDirectorModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="font-extrabold text-base text-slate-900 font-heading">Tambah Anggota Direksi</h3>
            <button onclick="closeAddDirectorModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form action="{{ route('admin.about.directors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf

            <!-- Hidden Input for Cropped Image Data -->
            <input type="hidden" name="cropped_image_base64" id="add_cropped_image_base64">

            <!-- Upload Foto Preview & Crop -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-camera text-brand-600 mr-1"></i> Foto Resmi Direksi
                    </label>
                    <span id="addCropStatusBadge" class="hidden px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                        <i class="fa-solid fa-check mr-1"></i> Foto Sudah Di-crop (1:1)
                    </span>
                </div>

                <div class="flex items-center gap-4">
                    <div class="relative w-20 h-20 rounded-2xl overflow-hidden border-2 border-emerald-500/30 bg-slate-100 shrink-0 shadow-sm flex items-center justify-center">
                        <img id="addDirectorPreview" src="{{ asset('images/logo.png') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-2 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <label for="add_photo_file" class="cursor-pointer inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span>Pilih &amp; Crop Foto</span>
                            </label>

                            <button type="button" id="addReCropBtn" onclick="openDirectorCropModal('add')" class="hidden px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs transition items-center gap-1.5 shadow-sm">
                                <i class="fa-solid fa-crop-simple text-brand-600"></i>
                                <span>Sesuaikan Ulang</span>
                            </button>
                        </div>
                        <input type="file" id="add_photo_file" name="photo_file" accept="image/*" class="hidden" onchange="initDirectorPhotoCrop(this, 'add')">
                        <p class="text-[11px] text-slate-400 leading-snug">
                            Format JPG, PNG, WEBP. Pemotong foto interaktif (1:1) otomatis muncul agar posisi kepala direksi simetris &amp; rapi.
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Nama Lengkap &amp; Gelar</label>
                <input type="text" name="name" required placeholder="Contoh: dr. Amanda Putri, Sp.A, M.Kes" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Jabatan Struktural</label>
                <input type="text" name="position" required placeholder="Contoh: Direktur Utama / Direktur Medis" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Urutan Tampil</label>
                    <input type="number" name="order_num" value="1" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div class="flex items-center gap-2 pt-6">
                    <input type="checkbox" name="is_active" id="add_is_active" value="1" checked class="rounded text-brand-600 focus:ring-brand-500">
                    <label for="add_is_active" class="font-bold text-slate-700 cursor-pointer">Status Aktif</label>
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Sambutan / Sekilas Profil (Rich Text)</label>
                <input type="hidden" name="bio" id="add_director_bio">
                <div id="quill-add-bio" class="rounded-2xl border border-slate-200"></div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-2">
                <button type="button" onclick="closeAddDirectorModal()" class="py-2.5 px-4 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="py-2.5 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold shadow transition">Simpan Direksi</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT DIREKSI -->
<div id="editDirectorModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="font-extrabold text-base text-slate-900 font-heading">Edit Profil Direksi</h3>
            <button onclick="closeEditDirectorModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form id="editDirectorForm" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            @method('PUT')

            <!-- Hidden Input for Cropped Image Data -->
            <input type="hidden" name="cropped_image_base64" id="edit_cropped_image_base64">

            <!-- Upload Foto Preview & Crop -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-camera text-brand-600 mr-1"></i> Foto Resmi Direksi
                    </label>
                    <span id="editCropStatusBadge" class="hidden px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                        <i class="fa-solid fa-check mr-1"></i> Foto Baru Siap (1:1)
                    </span>
                </div>

                <div class="flex items-center gap-4">
                    <div class="relative w-20 h-20 rounded-2xl overflow-hidden border-2 border-emerald-500/30 bg-slate-100 shrink-0 shadow-sm flex items-center justify-center">
                        <img id="editDirectorPreview" src="{{ asset('images/logo.png') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-2 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <label for="edit_photo_file" class="cursor-pointer inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span>Ganti &amp; Crop Foto</span>
                            </label>

                            <button type="button" id="editReCropBtn" onclick="openDirectorCropModal('edit')" class="hidden px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs transition items-center gap-1.5 shadow-sm">
                                <i class="fa-solid fa-crop-simple text-brand-600"></i>
                                <span>Sesuaikan Ulang</span>
                            </button>
                        </div>
                        <input type="file" id="edit_photo_file" name="photo_file" accept="image/*" class="hidden" onchange="initDirectorPhotoCrop(this, 'edit')">
                        <p class="text-[11px] text-slate-500 leading-snug">
                            Kosongkan jika tidak ingin mengganti foto, atau klik untuk memilih foto baru dan menyesuaikan posisinya.
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Nama Lengkap &amp; Gelar</label>
                <input type="text" id="edit_name" name="name" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Jabatan Struktural</label>
                <input type="text" id="edit_position" name="position" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Urutan Tampil</label>
                    <input type="number" id="edit_order_num" name="order_num" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div class="flex items-center gap-2 pt-6">
                    <input type="checkbox" name="is_active" id="edit_is_active" value="1" class="rounded text-brand-600 focus:ring-brand-500">
                    <label for="edit_is_active" class="font-bold text-slate-700 cursor-pointer">Status Aktif</label>
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Sambutan / Sekilas Profil (Rich Text)</label>
                <input type="hidden" name="bio" id="edit_director_bio">
                <div id="quill-edit-bio" class="rounded-2xl border border-slate-200"></div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-2">
                <button type="button" onclick="closeEditDirectorModal()" class="py-2.5 px-4 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="py-2.5 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold shadow transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Interactive Crop Foto Direksi -->
<div id="directorCropModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm animate-fade-in">
    <div class="bg-white rounded-3xl max-w-2xl w-full p-5 sm:p-6 shadow-2xl border border-slate-200 overflow-hidden flex flex-col max-h-[92vh]">
        <!-- Header -->
        <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-brand-700 flex items-center justify-center font-bold text-lg shadow-sm">
                    <i class="fa-solid fa-crop-simple"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 font-heading">Sesuaikan &amp; Crop Foto Direksi</h3>
                    <p class="text-[11px] text-slate-500">Atur zoom dan posisi agar wajah direksi simetris &amp; sejajar proporsional</p>
                </div>
            </div>
            <button type="button" onclick="closeDirectorCropModal()" class="p-2 text-slate-400 hover:text-slate-600 rounded-xl hover:bg-slate-100 transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Viewport Area -->
        <div class="py-4 flex-1 overflow-hidden flex flex-col items-center justify-center">
            <div class="w-full max-h-[50vh] flex items-center justify-center overflow-hidden bg-slate-900 rounded-2xl relative">
                <img id="directorCropImage" src="" alt="Gambar untuk di-crop" class="max-w-full max-h-[50vh] block">
                
                <!-- Guideline Oval: Membantu memposisikan kepala direksi pada tinggi yang sama -->
                <div class="absolute inset-0 pointer-events-none flex items-center justify-center opacity-30">
                    <div class="w-48 h-56 rounded-[50%] border-2 border-dashed border-emerald-400"></div>
                </div>
            </div>
            <p class="text-[11px] text-slate-400 mt-2.5 text-center">
                <i class="fa-solid fa-circle-info text-brand-600 mr-1"></i>
                Gunakan scroll mouse atau tombol zoom di bawah, lalu geser posisi wajah agar berada di area tengah lingkaran.
            </p>
        </div>

        <!-- Toolbar & Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-3 border-t border-slate-100">
            <!-- Crop Controls -->
            <div class="flex items-center gap-1.5 w-full sm:w-auto justify-center">
                <button type="button" onclick="zoomDirectorCropper(0.1)" class="p-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition flex items-center gap-1" title="Perbesar (Zoom In)">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                    <span class="text-[10px]">Zoom In</span>
                </button>
                <button type="button" onclick="zoomDirectorCropper(-0.1)" class="p-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition flex items-center gap-1" title="Perkecil (Zoom Out)">
                    <i class="fa-solid fa-magnifying-glass-minus"></i>
                    <span class="text-[10px]">Zoom Out</span>
                </button>
                <button type="button" onclick="rotateDirectorCropper(-90)" class="p-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" title="Putar 90° Kiri">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>
                <button type="button" onclick="rotateDirectorCropper(90)" class="p-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" title="Putar 90° Kanan">
                    <i class="fa-solid fa-rotate-right"></i>
                </button>
                <button type="button" onclick="resetDirectorCropper()" class="p-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" title="Reset Posisi">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </button>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                <button type="button" onclick="useDirectorOriginalPhoto()" class="py-2.5 px-4 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold transition">
                    Pakai Asli
                </button>
                <button type="button" onclick="applyDirectorCroppedImage()" class="py-2.5 px-5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-extrabold shadow-md shadow-brand-600/20 transition flex items-center gap-1.5 active:scale-95">
                    <i class="fa-solid fa-check"></i>
                    <span>Terapkan Hasil Crop</span>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Tab Switcher
    function switchTab(tabId) {
        document.querySelectorAll('.about-tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.about-tab-btn').forEach(btn => {
            btn.classList.remove('bg-brand-600', 'text-white', 'shadow-sm');
            btn.classList.add('text-slate-600', 'hover:text-slate-900', 'hover:bg-slate-100');
        });

        const activeContent = document.getElementById(tabId);
        const activeBtn = document.getElementById('btn-' + tabId);
        if (activeContent) activeContent.classList.remove('hidden');
        if (activeBtn) {
            activeBtn.classList.add('bg-brand-600', 'text-white', 'shadow-sm');
            activeBtn.classList.remove('text-slate-600', 'hover:text-slate-900', 'hover:bg-slate-100');
        }
    }

    // Image Previews
    function previewHistoryImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('historyImagePreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewAddDirector(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('addDirectorPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewEditDirector(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('editDirectorPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Initialize Quill Rich Text Editors on Load
    let quillAddBio = null;
    let quillEditBio = null;

    document.addEventListener('DOMContentLoaded', function() {
        window.initRichEditor('quill-vision', 'about_vision', 'Tuliskan visi rumah sakit di sini...');
        window.initRichEditor('quill-mission', 'about_mission', 'Tuliskan poin-poin misi rumah sakit...');
        window.initRichEditor('quill-core-values', 'about_core_values', 'Tuliskan nilai-nilai budaya utama...');
        window.initRichEditor('quill-history', 'about_history', 'Tuliskan narasi perjalanan berdirinya RSIA Restu Bunda...');
        
        quillAddBio = window.initRichEditor('quill-add-bio', 'add_director_bio', 'Tuliskan sambutan atau sekilas profil direksi...');
        quillEditBio = window.initRichEditor('quill-edit-bio', 'edit_director_bio', 'Tuliskan sambutan atau sekilas profil direksi...');
    });

    // Modals
    function openAddDirectorModal() {
        document.getElementById('add_cropped_image_base64').value = '';
        document.getElementById('add_photo_file').value = '';
        document.getElementById('addDirectorPreview').src = "{{ asset('images/logo.png') }}";
        addOriginalImageSrc = null;

        const badge = document.getElementById('addCropStatusBadge');
        if (badge) badge.classList.add('hidden');
        const reCropBtn = document.getElementById('addReCropBtn');
        if (reCropBtn) {
            reCropBtn.classList.add('hidden');
            reCropBtn.classList.remove('inline-flex');
        }

        const modal = document.getElementById('addDirectorModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeAddDirectorModal() {
        const modal = document.getElementById('addDirectorModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openEditDirectorModal(director) {
        const form = document.getElementById('editDirectorForm');
        form.action = '/admin/about/directors/' + director.id;

        document.getElementById('edit_name').value = director.name || '';
        document.getElementById('edit_position').value = director.position || '';
        document.getElementById('edit_order_num').value = director.order_num || 0;
        document.getElementById('edit_is_active').checked = !!director.is_active;
        document.getElementById('edit_director_bio').value = director.bio || '';
        document.getElementById('edit_cropped_image_base64').value = '';
        document.getElementById('edit_photo_file').value = '';
        editOriginalImageSrc = null;

        const badge = document.getElementById('editCropStatusBadge');
        if (badge) badge.classList.add('hidden');

        const reCropBtn = document.getElementById('editReCropBtn');
        const previewImg = document.getElementById('editDirectorPreview');
        if (director.photo) {
            previewImg.src = '/images/' + director.photo;
            if (reCropBtn) {
                reCropBtn.classList.remove('hidden');
                reCropBtn.classList.add('inline-flex');
            }
        } else {
            previewImg.src = '{{ asset('images/logo.png') }}';
            if (reCropBtn) {
                reCropBtn.classList.add('hidden');
                reCropBtn.classList.remove('inline-flex');
            }
        }

        if (quillEditBio) {
            quillEditBio.root.innerHTML = director.bio || '';
        }

        const modal = document.getElementById('editDirectorModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditDirectorModal() {
        const modal = document.getElementById('editDirectorModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // ==========================================
    // CROPPER.JS HANDLERS FOR DIRECTORS
    // ==========================================
    let directorCropper = null;
    let currentDirectorCropTarget = 'add'; // 'add' or 'edit'
    let addOriginalImageSrc = null;
    let editOriginalImageSrc = null;

    function initDirectorPhotoCrop(input, target) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                if (target === 'add') {
                    addOriginalImageSrc = e.target.result;
                } else {
                    editOriginalImageSrc = e.target.result;
                }
                openDirectorCropModal(target, e.target.result);
            };
            reader.readAsDataURL(file);
        }
    }

    function openDirectorCropModal(target, imgSrc) {
        currentDirectorCropTarget = target;
        let src = imgSrc;
        if (!src) {
            if (target === 'add') {
                src = addOriginalImageSrc || document.getElementById('addDirectorPreview').src;
            } else {
                src = editOriginalImageSrc || document.getElementById('editDirectorPreview').src;
            }
        }

        const cropImg = document.getElementById('directorCropImage');
        cropImg.src = src;

        const modal = document.getElementById('directorCropModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (directorCropper) {
            directorCropper.destroy();
        }

        setTimeout(() => {
            directorCropper = new Cropper(cropImg, {
                aspectRatio: 1, // 1:1 Square
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 0.95,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
                background: false
            });
        }, 120);
    }

    function closeDirectorCropModal() {
        const modal = document.getElementById('directorCropModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        if (directorCropper) {
            directorCropper.destroy();
            directorCropper = null;
        }
    }

    function zoomDirectorCropper(ratio) {
        if (directorCropper) directorCropper.zoom(ratio);
    }

    function rotateDirectorCropper(degree) {
        if (directorCropper) directorCropper.rotate(degree);
    }

    function resetDirectorCropper() {
        if (directorCropper) directorCropper.reset();
    }

    function applyDirectorCroppedImage() {
        if (!directorCropper) return;
        const canvas = directorCropper.getCroppedCanvas({
            width: 600,
            height: 600,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });

        if (canvas) {
            const croppedDataUrl = canvas.toDataURL('image/png');
            if (currentDirectorCropTarget === 'add') {
                document.getElementById('addDirectorPreview').src = croppedDataUrl;
                document.getElementById('add_cropped_image_base64').value = croppedDataUrl;

                const statusBadge = document.getElementById('addCropStatusBadge');
                if (statusBadge) {
                    statusBadge.classList.remove('hidden');
                    statusBadge.innerHTML = '<i class="fa-solid fa-check mr-1"></i> Foto Sudah Di-crop (1:1)';
                }
                const reCropBtn = document.getElementById('addReCropBtn');
                if (reCropBtn) {
                    reCropBtn.classList.remove('hidden');
                    reCropBtn.classList.add('inline-flex');
                }
            } else {
                document.getElementById('editDirectorPreview').src = croppedDataUrl;
                document.getElementById('edit_cropped_image_base64').value = croppedDataUrl;

                const statusBadge = document.getElementById('editCropStatusBadge');
                if (statusBadge) {
                    statusBadge.classList.remove('hidden');
                    statusBadge.innerHTML = '<i class="fa-solid fa-check mr-1"></i> Foto Baru Di-crop (1:1)';
                }
                const reCropBtn = document.getElementById('editReCropBtn');
                if (reCropBtn) {
                    reCropBtn.classList.remove('hidden');
                    reCropBtn.classList.add('inline-flex');
                }
            }

            closeDirectorCropModal();
        }
    }

    function useDirectorOriginalPhoto() {
        if (currentDirectorCropTarget === 'add') {
            if (addOriginalImageSrc) {
                document.getElementById('addDirectorPreview').src = addOriginalImageSrc;
                document.getElementById('add_cropped_image_base64').value = '';
            }
        } else {
            if (editOriginalImageSrc) {
                document.getElementById('editDirectorPreview').src = editOriginalImageSrc;
                document.getElementById('edit_cropped_image_base64').value = '';
            }
        }
        closeDirectorCropModal();
    }
</script>
<!-- Cropper.js JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
@endpush
@endsection
