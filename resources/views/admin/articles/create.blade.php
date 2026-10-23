@extends('layouts.admin')

@section('title', 'Tulis Artikel Edukasi Baru - RSIA Restu Bunda')
@section('page-title', 'Tulis Artikel Edukasi Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Artikel</span>
        </a>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 text-xs">
            @csrf

            <!-- Upload Banner Foto Artikel & Preview -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                    <i class="fa-solid fa-image text-brand-600 mr-1.5"></i> Banner Gambar Utama Artikel
                </label>
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <!-- Preview Image Box -->
                    <div class="relative w-full sm:w-56 aspect-[16/10] rounded-2xl overflow-hidden border-2 border-emerald-500/20 bg-slate-200 shadow-sm shrink-0">
                        <img id="articleImagePreview" src="{{ asset('images/article_1.jpg') }}" alt="Preview Gambar Artikel" class="w-full h-full object-cover">
                        <span class="absolute bottom-2 left-2 bg-slate-900/80 text-white text-[9px] font-bold px-2 py-0.5 rounded-full">
                            Preview
                        </span>
                    </div>

                    <!-- Upload Controls -->
                    <div class="flex-1 space-y-2 text-center sm:text-left w-full">
                        <label for="image_file" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span>Pilih &amp; Upload Banner Artikel</span>
                        </label>
                        <input type="file" id="image_file" name="image_file" accept="image/*" class="hidden" onchange="previewArticleImage(this)">
                        <p class="text-[11px] text-slate-500">
                            Format JPG, PNG, WEBP (Maksimal 4 MB). Rasio ideal 16:10 atau landscape.
                        </p>
                        <div class="pt-1">
                            <span class="text-[10px] text-slate-400 block font-medium">Atau gunakan nama file foto bawaan:</span>
                            <input type="text" name="image" placeholder="article_1.jpg" class="mt-1 w-full max-w-sm p-2 rounded-lg border border-slate-200 bg-white text-xs text-slate-700 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Judul Artikel Edukasi</label>
                <input type="text" name="title" required placeholder="Judul artikel kesehatan..." class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Kategori</label>
                    <select name="category" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                        <option value="Kehamilan">Kehamilan</option>
                        <option value="Tumbuh Kembang">Tumbuh Kembang</option>
                        <option value="Kesehatan Anak">Kesehatan Anak</option>
                        <option value="Nutrisi & Laktasi">Nutrisi &amp; Laktasi</option>
                        <option value="Tips Medis">Tips Medis</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Penulis / Sumber Medis</label>
                    <input type="text" name="author" value="dr. Amanda, Sp.A" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tanggal Publikasi</label>
                    <input type="date" name="published_at" value="{{ date('Y-m-d') }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Ringkasan Singkat (Excerpt)</label>
                <textarea name="excerpt" rows="2" required placeholder="Ringkasan 1-2 kalimat untuk preview di halaman depan..." class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none"></textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Konten Lengkap Artikel (Mendukung HTML &lt;p&gt;, &lt;h3&gt;, dll)</label>
                <textarea name="content" rows="8" required placeholder="Tuliskan isi artikel edukasi kesehatan secara komprehensif..." class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none font-mono"></textarea>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="is_published" id="is_published" value="1" checked class="rounded text-brand-600 focus:ring-brand-500">
                <label for="is_published" class="font-bold text-slate-700 cursor-pointer">Terbitkan Sekarang (Tampil di Landing Page)</label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.articles.index') }}" class="py-2.5 px-5 rounded-xl border border-slate-200 font-bold text-slate-600 hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="py-2.5 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold shadow transition">
                    Terbitkan Artikel
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    function previewArticleImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('articleImagePreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
