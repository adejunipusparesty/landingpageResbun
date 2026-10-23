@extends('layouts.admin')

@section('title', 'Tambah Testimoni Pasien - RSIA Restu Bunda')
@section('page-title', 'Tambah Testimoni Pasien')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Testimoni</span>
        </a>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 text-xs">
            @csrf

            <!-- Upload Avatar Pasien & Preview -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                    <i class="fa-solid fa-camera text-brand-600 mr-1.5"></i> Foto Profil / Avatar Pasien
                </label>
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <!-- Preview Image Box -->
                    <div class="relative w-24 h-24 rounded-full overflow-hidden border-4 border-white bg-slate-200 shadow-md shrink-0">
                        <img id="testimonialAvatarPreview" src="{{ asset('images/avatar_alice.jpg') }}" alt="Preview Avatar" class="w-full h-full object-cover">
                    </div>

                    <!-- Upload Controls -->
                    <div class="flex-1 space-y-2 text-center sm:text-left w-full">
                        <label for="avatar_file" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span>Pilih &amp; Upload Foto Avatar</span>
                        </label>
                        <input type="file" id="avatar_file" name="avatar_file" accept="image/*" class="hidden" onchange="previewTestimonialAvatar(this)">
                        <p class="text-[11px] text-slate-500">
                            Format JPG, PNG, WEBP (Maksimal 4 MB). Rasio 1:1 atau foto wajah.
                        </p>
                        <div class="pt-1">
                            <span class="text-[10px] text-slate-400 block font-medium">Atau gunakan nama file avatar bawaan:</span>
                            <input type="text" name="avatar" placeholder="avatar_alice.jpg" class="mt-1 w-full max-w-sm p-2 rounded-lg border border-slate-200 bg-white text-xs text-slate-700 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nama Pasien / Orang Tua</label>
                    <input type="text" name="name" required placeholder="Contoh: Mama Alice / Bpk. Fajar" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Info Tambahan / Keterangan Pasien</label>
                    <input type="text" name="patient_info" placeholder="Contoh: Ibu dari Baby Arfa (2 thn)" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Rating Kepuasan</label>
                    <select name="rating" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                        <option value="5" selected>★ ★ ★ ★ ★ (5 Bintang - Sangat Puas)</option>
                        <option value="4">★ ★ ★ ★ ☆ (4 Bintang - Puas)</option>
                        <option value="3">★ ★ ★ ☆ ☆ (3 Bintang - Cukup)</option>
                        <option value="2">★ ★ ☆ ☆ ☆ (2 Bintang - Kurang)</option>
                        <option value="1">★ ☆ ☆ ☆ ☆ (1 Bintang - Sangat Kurang)</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Urutan Tampil (Prioritas)</label>
                    <input type="number" name="order_num" value="1" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Isi Kesan, Pesan &amp; Pengalaman Pasien</label>
                <textarea name="content" rows="4" required placeholder="Tuliskan ulasan pasien mengenai keramahan dokter, fasilitas kamar bersalin, atau kenyamanan poliklinik..." class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none leading-relaxed"></textarea>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="is_approved" id="is_approved" value="1" checked class="rounded text-brand-600 focus:ring-brand-500">
                <label for="is_approved" class="font-bold text-slate-700 cursor-pointer">Tampilkan Langsung di Halaman Beranda (Landing Page)</label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.testimonials.index') }}" class="py-2.5 px-5 rounded-xl border border-slate-200 font-bold text-slate-600 hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="py-2.5 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold shadow transition">
                    Simpan Testimoni
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    function previewTestimonialAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('testimonialAvatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
