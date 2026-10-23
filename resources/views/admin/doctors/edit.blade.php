@extends('layouts.admin')

@section('title', 'Edit Dokter - RSIA Restu Bunda')
@section('page-title', 'Edit Dokter: ' . $doctor->name)

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
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.doctors.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Dokter</span>
        </a>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <form id="doctorForm" action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5 text-xs">
            @csrf
            @method('PUT')

            <!-- Hidden Input for Cropped Image Data -->
            <input type="hidden" name="cropped_image_base64" id="cropped_image_base64">

            <!-- Foto Dokter & Fitur Upload Crop -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                <div class="flex items-center justify-between">
                    <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-camera text-brand-600 mr-1.5"></i> Foto Profil Dokter
                    </label>
                    <span id="cropStatusBadge" class="hidden px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                        <i class="fa-solid fa-check mr-1"></i> Foto Siap Disimpan
                    </span>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <!-- Preview Image -->
                    <div class="relative shrink-0">
                        <div class="w-32 h-32 rounded-2xl overflow-hidden border-4 border-white shadow-md bg-gradient-to-b from-[#e1f7eb] to-[#eef9f2] flex items-end justify-center relative">
                            <img id="doctorPhotoPreview" src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover object-top">
                        </div>
                        <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-slate-900/80 text-white text-[9px] font-bold px-2.5 py-0.5 rounded-full whitespace-nowrap shadow-sm">
                            Foto Saat Ini
                        </span>
                    </div>

                    <!-- Upload Controls & Crop Button -->
                    <div class="flex-1 space-y-2.5 text-center sm:text-left w-full">
                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                            <label for="photo_file" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span>Pilih &amp; Upload Foto Baru</span>
                            </label>

                            <button type="button" id="reCropBtn" onclick="openCropModal()" class="inline-flex px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs transition items-center gap-1.5 shadow-sm">
                                <i class="fa-solid fa-crop-simple text-brand-600"></i>
                                <span>Sesuaikan / Crop Foto Ini</span>
                            </button>
                        </div>

                        <input type="file" id="photo_file" name="photo_file" accept="image/*" class="hidden" onchange="initPhotoCrop(this)">

                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            <i class="fa-solid fa-wand-magic-sparkles text-emerald-600 mr-1"></i>
                            <strong>Fitur Sesuaikan / Crop:</strong> Klik tombol <em>"Sesuaikan / Crop Foto Ini"</em> untuk mengatur zoom dan posisi foto dokter saat ini, atau upload foto baru.
                        </p>

                        <div class="pt-1">
                            <span class="text-[10px] text-slate-400 block font-medium">Atau gunakan nama file foto manual:</span>
                            <input type="text" name="photo" value="{{ old('photo', $doctor->photo) }}" placeholder="doctor_amanda.jpg" class="mt-1 w-full max-w-sm p-2 rounded-lg border border-slate-200 bg-white text-xs text-slate-700 focus:outline-none focus:border-brand-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nama Lengkap &amp; Gelar</label>
                    <input type="text" name="name" value="{{ old('name', $doctor->name) }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Spesialisasi</label>
                    <input type="text" name="specialty" value="{{ old('specialty', $doctor->specialty) }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Kategori Poli</label>
                    <select name="category" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                        <option value="kebidanan" {{ $doctor->category == 'kebidanan' ? 'selected' : '' }}>Kebidanan &amp; Kandungan (Obgyn)</option>
                        <option value="anak" {{ $doctor->category == 'anak' ? 'selected' : '' }}>Poli Anak (Pediatrik)</option>
                        <option value="neonatus" {{ $doctor->category == 'neonatus' ? 'selected' : '' }}>Neonatus / NICU</option>
                        <option value="laktasi" {{ $doctor->category == 'laktasi' ? 'selected' : '' }}>Poliklinik Laktasi</option>
                        <option value="umum" {{ $doctor->category == 'umum' ? 'selected' : '' }}>Umum</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Pengalaman</label>
                    <input type="text" name="experience" value="{{ old('experience', $doctor->experience) }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nomor SIP</label>
                    <input type="text" name="sip_number" value="{{ old('sip_number', $doctor->sip_number) }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Hari Praktik</label>
                    <input type="text" name="schedule_days" value="{{ old('schedule_days', $doctor->schedule_days) }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Jam Praktik</label>
                    <input type="text" name="schedule_hours" value="{{ old('schedule_hours', $doctor->schedule_hours) }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Profil &amp; Keahlian Medis</label>
                <textarea name="bio" rows="3" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">{{ old('bio', $doctor->bio) }}</textarea>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $doctor->is_active ? 'checked' : '' }} class="rounded text-brand-600 focus:ring-brand-500">
                <label for="is_active" class="font-bold text-slate-700 cursor-pointer">Dokter Aktif Praktik (Tampil di Website)</label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.doctors.index') }}" class="py-2.5 px-5 rounded-xl border border-slate-200 font-bold text-slate-600 hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="py-2.5 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold shadow transition">
                    Simpan Perubahan Dokter
                </button>
            </div>
        </form>
    </div>

</div>

<!-- Modal Interactive Crop / Sesuaikan Foto Dokter -->
<div id="cropModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm animate-fade-in">
    <div class="bg-white rounded-3xl max-w-2xl w-full p-5 sm:p-6 shadow-2xl border border-slate-200 overflow-hidden flex flex-col max-h-[92vh]">
        <!-- Header -->
        <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-brand-700 flex items-center justify-center font-bold text-lg shadow-sm">
                    <i class="fa-solid fa-crop-simple"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 font-heading">Sesuaikan &amp; Crop Foto Dokter</h3>
                    <p class="text-[11px] text-slate-500">Atur zoom dan posisi agar foto dokter sejajar proporsional di website</p>
                </div>
            </div>
            <button type="button" onclick="cancelCrop()" class="p-2 text-slate-400 hover:text-slate-600 rounded-xl hover:bg-slate-100 transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Viewport Area -->
        <div class="py-4 flex-1 overflow-hidden flex flex-col items-center justify-center">
            <div class="w-full max-h-[50vh] flex items-center justify-center overflow-hidden bg-slate-900 rounded-2xl relative">
                <img id="cropImage" src="" alt="Gambar untuk di-crop" class="max-w-full max-h-[50vh] block">
                
                <!-- Guideline Oval: Membantu pengguna memposisikan kepala dokter pada tinggi yang sama -->
                <div class="absolute inset-0 pointer-events-none flex items-center justify-center opacity-30">
                    <div class="w-48 h-56 rounded-[50%] border-2 border-dashed border-emerald-400"></div>
                </div>
            </div>
            <p class="text-[11px] text-slate-400 mt-2.5 text-center">
                <i class="fa-solid fa-circle-info text-brand-600 mr-1"></i>
                Gunakan scroll mouse atau tombol di bawah untuk memperbesar/memperkecil, lalu geser posisi wajah agar berada di area tengah.
            </p>
        </div>

        <!-- Toolbar & Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-3 border-t border-slate-100">
            <!-- Crop Controls -->
            <div class="flex items-center gap-1.5 w-full sm:w-auto justify-center">
                <button type="button" onclick="zoomCropper(0.1)" class="p-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition flex items-center gap-1" title="Perbesar (Zoom In)">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                    <span class="text-[10px]">Zoom In</span>
                </button>
                <button type="button" onclick="zoomCropper(-0.1)" class="p-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition flex items-center gap-1" title="Perkecil (Zoom Out)">
                    <i class="fa-solid fa-magnifying-glass-minus"></i>
                    <span class="text-[10px]">Zoom Out</span>
                </button>
                <button type="button" onclick="rotateCropper(-90)" class="p-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" title="Putar 90° Kiri">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>
                <button type="button" onclick="rotateCropper(90)" class="p-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" title="Putar 90° Kanan">
                    <i class="fa-solid fa-rotate-right"></i>
                </button>
                <button type="button" onclick="resetCropper()" class="p-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" title="Reset Posisi">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </button>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                <button type="button" onclick="useOriginalPhoto()" class="py-2.5 px-4 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold transition">
                    Pakai Asli
                </button>
                <button type="button" onclick="applyCroppedImage()" class="py-2.5 px-5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-extrabold shadow-md shadow-brand-600/20 transition flex items-center gap-1.5 active:scale-95">
                    <i class="fa-solid fa-check"></i>
                    <span>Terapkan Hasil Crop</span>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Cropper.js JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script>
    let cropper = null;
    let originalImageSrc = null;

    function initPhotoCrop(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                originalImageSrc = e.target.result;
                openCropModal(originalImageSrc);
            }
            reader.readAsDataURL(file);
        }
    }

    function openCropModal(imgSrc) {
        const src = imgSrc || originalImageSrc || document.getElementById('doctorPhotoPreview').src;
        const cropImg = document.getElementById('cropImage');
        cropImg.src = src;

        const modal = document.getElementById('cropModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (cropper) {
            cropper.destroy();
        }

        setTimeout(() => {
            cropper = new Cropper(cropImg, {
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
        }, 100);
    }

    function cancelCrop() {
        const modal = document.getElementById('cropModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }

    function zoomCropper(ratio) {
        if (cropper) cropper.zoom(ratio);
    }

    function rotateCropper(degree) {
        if (cropper) cropper.rotate(degree);
    }

    function resetCropper() {
        if (cropper) cropper.reset();
    }

    function applyCroppedImage() {
        if (!cropper) return;
        const canvas = cropper.getCroppedCanvas({
            width: 600,
            height: 600,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });

        if (canvas) {
            const croppedDataUrl = canvas.toDataURL('image/png');
            document.getElementById('doctorPhotoPreview').src = croppedDataUrl;
            document.getElementById('cropped_image_base64').value = croppedDataUrl;

            // Update badge
            const statusBadge = document.getElementById('cropStatusBadge');
            if (statusBadge) {
                statusBadge.classList.remove('hidden');
                statusBadge.innerHTML = '<i class="fa-solid fa-check mr-1"></i> Foto Baru Disesuaikan (1:1)';
            }

            cancelCrop();
        }
    }

    function useOriginalPhoto() {
        if (originalImageSrc) {
            document.getElementById('doctorPhotoPreview').src = originalImageSrc;
            document.getElementById('cropped_image_base64').value = '';
        }
        cancelCrop();
    }
</script>
@endpush
@endsection
