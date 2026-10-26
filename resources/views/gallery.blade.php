@extends('layouts.app')

@section('title', 'Galeri Dokumentasi & Kegiatan - RSIA Restu Bunda')

@section('content')
<!-- Hero Header Section -->
<section class="relative pt-32 pb-16 bg-gradient-to-b from-brand-50/80 via-white to-white overflow-hidden">
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-brand-200/40 blur-3xl pointer-events-none"></div>
    <div class="absolute top-20 -left-32 w-80 h-80 rounded-full bg-emerald-100/50 blur-2xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white shadow-sm border border-brand-200/60 text-brand-700 text-xs font-bold uppercase tracking-wider mb-5" data-aos="fade-down">
            <i class="fa-solid fa-images text-brand-600"></i>
            <span>Momen &amp; Dokumentasi RSIA</span>
        </div>

        <h1 class="text-3xl sm:text-5xl font-black text-slate-900 font-heading tracking-tight leading-tight max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            Galeri Kegiatan &amp; <br class="hidden sm:inline">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 via-emerald-600 to-teal-700">
                Fasilitas Pelayanan Medis
            </span>
        </h1>

        <p class="text-xs sm:text-sm text-slate-500 max-w-xl mx-auto mt-4 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
            Kumpulan potret momen berharga, kelas edukasi ibu hamil, fasilitas rawat inap modern, dan dedikasi tim medis RSIA Restu Bunda dalam melayani keluarga tercinta.
        </p>

        <!-- Category Filter Tabs -->
        <div class="mt-10 flex flex-wrap items-center justify-center gap-2 text-xs font-bold" data-aos="fade-up" data-aos-delay="300">
            <a href="{{ route('gallery', ['category' => 'all']) }}" class="px-5 py-2.5 rounded-2xl transition shadow-sm {{ $currentCategory == 'all' ? 'bg-gradient-to-r from-emerald-600 to-brand-600 text-white shadow-brand-600/20' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                Semua Dokumentasi
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('gallery', ['category' => $cat]) }}" class="px-5 py-2.5 rounded-2xl transition shadow-sm {{ $currentCategory == $cat ? 'bg-gradient-to-r from-emerald-600 to-brand-600 text-white shadow-brand-600/20' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Gallery Grid Section -->
<section class="py-12 bg-white min-h-[500px]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($galleries as $item)
                <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl transition transform hover:-translate-y-1 overflow-hidden flex flex-col justify-between group cursor-pointer" onclick="openLightbox({{ json_encode($item) }})" data-aos="fade-up">
                    <div>
                        <!-- Image Container -->
                        <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            
                            <!-- Overlay on hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-5">
                                <span class="inline-flex items-center gap-1.5 text-xs text-white font-bold bg-white/20 backdrop-blur-md px-3 py-1.5 rounded-xl">
                                    <i class="fa-solid fa-magnifying-glass-plus"></i> Perbesar Foto
                                </span>
                            </div>

                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-sm">
                                    {{ $item->category }}
                                </span>
                            </div>

                            @if($item->event_date)
                                <div class="absolute bottom-3 left-3 bg-white/95 backdrop-blur-md text-slate-700 text-[10px] font-bold px-2.5 py-1 rounded-xl shadow-sm">
                                    <i class="fa-regular fa-calendar mr-1 text-brand-600"></i> {{ $item->event_date->format('d M Y') }}
                                </div>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="p-5 space-y-2">
                            <h3 class="font-extrabold text-slate-900 text-sm sm:text-base font-heading group-hover:text-brand-600 transition leading-snug line-clamp-2">
                                {{ $item->title }}
                            </h3>

                            @if($item->description)
                                <div class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                    {!! strip_tags($item->description) !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 pt-0 flex items-center justify-between text-xs text-brand-700 font-bold">
                        <span>Lihat Detail Momen</span>
                        <i class="fa-solid fa-arrow-right text-[11px] transform group-hover:translate-x-1 transition"></i>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                    <i class="fa-solid fa-images text-4xl text-slate-300 mb-3"></i>
                    <h4 class="font-extrabold text-slate-700 text-sm font-heading">Tidak Ada Foto di Kategori Ini</h4>
                    <p class="text-xs text-slate-500 mt-1">Silakan pilih kategori lain atau kembali ke seluruh dokumentasi.</p>
                    <a href="{{ route('gallery', ['category' => 'all']) }}" class="inline-flex items-center gap-2 px-4 py-2 mt-4 rounded-xl bg-brand-600 text-white font-bold text-xs shadow-sm hover:bg-brand-700 transition">
                        Lihat Semua Foto
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($galleries->hasPages())
            <div class="mt-12 p-4 bg-slate-50 rounded-2xl border border-slate-200/80">
                {{ $galleries->links() }}
            </div>
        @endif

    </div>
</section>

<!-- LIGHTBOX MODAL (ZOOM & DETAIL FOTO) -->
<div id="galleryLightboxModal" class="fixed inset-0 z-50 bg-slate-950/85 backdrop-blur-md hidden items-center justify-center p-4" onclick="closeLightboxOnBackdrop(event)">
    <div class="bg-white rounded-3xl max-w-3xl w-full overflow-hidden shadow-2xl border border-white/20 relative" onclick="event.stopPropagation()">
        
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute top-3 right-3 z-20 w-9 h-9 rounded-full bg-slate-900/70 hover:bg-slate-900 text-white flex items-center justify-center transition shadow-lg">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>

        <!-- Big Image -->
        <div class="relative aspect-[16/10] bg-slate-900">
            <img id="lightboxImage" src="" alt="Detail Galeri" class="w-full h-full object-contain">
        </div>

        <!-- Modal Info Bar -->
        <div class="p-6 sm:p-8 space-y-3 bg-white max-h-60 overflow-y-auto">
            <div class="flex items-center gap-2">
                <span id="lightboxCategory" class="text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-brand-100 text-brand-800">
                    Kategori
                </span>
                <span id="lightboxDate" class="text-xs text-slate-400 font-medium">
                    Tanggal
                </span>
            </div>

            <h3 id="lightboxTitle" class="text-lg sm:text-xl font-black text-slate-900 font-heading leading-snug">
                Judul Foto
            </h3>

            <div id="lightboxDescription" class="prose prose-xs sm:prose-sm text-slate-600 leading-relaxed">
                Deskripsi
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openLightbox(item) {
        document.getElementById('lightboxImage').src = item.image ? ('/images/' + item.image) : '/images/hero.jpg';
        document.getElementById('lightboxTitle').innerText = item.title || 'Dokumentasi RSIA Restu Bunda';
        document.getElementById('lightboxCategory').innerText = item.category || 'Galeri';
        
        let dateStr = '';
        if (item.event_date) {
            const d = new Date(item.event_date);
            dateStr = d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
        }
        document.getElementById('lightboxDate').innerText = dateStr;

        const descContainer = document.getElementById('lightboxDescription');
        if (item.description && item.description.trim() !== '') {
            descContainer.innerHTML = item.description;
            descContainer.classList.remove('hidden');
        } else {
            descContainer.innerHTML = '';
            descContainer.classList.add('hidden');
        }

        const modal = document.getElementById('galleryLightboxModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const modal = document.getElementById('galleryLightboxModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    function closeLightboxOnBackdrop(e) {
        if (e.target.id === 'galleryLightboxModal') {
            closeLightbox();
        }
    }

    // Keyboard ESC to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
</script>
@endpush
@endsection
