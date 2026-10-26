@extends('layouts.admin')

@section('title', 'Galeri Foto Dokumentasi - RSIA Restu Bunda')
@section('page-title', 'Galeri Dokumentasi')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-extrabold text-slate-900 text-lg sm:text-xl font-heading">Dokumentasi &amp; Galeri RSIA</h2>
            <p class="text-xs text-slate-500">Koleksi foto kegiatan, fasilitas unggulan, seminar edukasi, dan momen pelayanan medis.</p>
        </div>

        <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/20 transition active:scale-95 shrink-0">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <span>Upload Foto Baru</span>
        </a>
    </div>

    <!-- Category Filter Bar -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs font-bold">
        <a href="{{ route('admin.galleries.index', ['category' => 'all']) }}" class="px-4 py-2 rounded-xl transition shrink-0 {{ request('category', 'all') == 'all' ? 'bg-slate-900 text-white shadow-sm' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
            Semua Foto ({{ \App\Models\Gallery::count() }})
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('admin.galleries.index', ['category' => $cat]) }}" class="px-4 py-2 rounded-xl transition shrink-0 {{ request('category') == $cat ? 'bg-slate-900 text-white shadow-sm' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                {{ $cat }} ({{ \App\Models\Gallery::where('category', $cat)->count() }})
            </a>
        @endforeach
    </div>

    <!-- Galleries Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($galleries as $item)
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md transition overflow-hidden flex flex-col justify-between group">
                <div>
                    <!-- Photo Box -->
                    <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        
                        <!-- Badges -->
                        <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5">
                            <span class="bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-sm">
                                {{ $item->category }}
                            </span>
                        </div>

                        <!-- Active Toggle on Image -->
                        <div class="absolute top-2.5 right-2.5">
                            <form action="{{ route('admin.galleries.toggle', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-extrabold shadow-sm transition backdrop-blur-md {{ $item->is_active ? 'bg-emerald-500 text-white hover:bg-emerald-600' : 'bg-rose-500 text-white hover:bg-rose-600' }}" title="Klik untuk ubah status tampil">
                                    {{ $item->is_active ? 'Aktif' : 'Disembunyikan' }}
                                </button>
                            </form>
                        </div>

                        @if($item->event_date)
                            <div class="absolute bottom-2 left-2.5 bg-white/90 backdrop-blur-md text-slate-700 text-[9px] font-bold px-2 py-0.5 rounded-lg shadow-sm">
                                <i class="fa-regular fa-calendar mr-1"></i> {{ $item->event_date->format('d M Y') }}
                            </div>
                        @endif
                    </div>

                    <!-- Details -->
                    <div class="p-4 space-y-2">
                        <h3 class="font-extrabold text-slate-900 text-xs sm:text-sm font-heading leading-snug line-clamp-2" title="{{ $item->title }}">
                            {{ $item->title }}
                        </h3>
                        
                        @if($item->description)
                            <div class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                                {!! strip_tags($item->description) !!}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="p-4 pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-[10px] text-slate-400 font-medium">Urutan #{{ $item->order_num }}</span>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.galleries.edit', $item->id) }}" class="p-2 rounded-xl text-slate-600 hover:text-emerald-700 hover:bg-emerald-50 transition" title="Edit Foto">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('admin.galleries.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus Foto">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-dashed border-slate-200">
                <i class="fa-solid fa-images text-4xl text-slate-300 mb-3"></i>
                <h4 class="font-extrabold text-slate-700 text-sm font-heading">Belum Ada Foto di Galeri</h4>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Upload foto kegiatan senam hamil, fasilitas kamar rawat, atau momen pelayanan untuk ditampilkan ke pengunjung website.</p>
                <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center gap-2 px-4 py-2 mt-4 rounded-xl bg-brand-600 text-white font-bold text-xs shadow-sm hover:bg-brand-700 transition">
                    <i class="fa-solid fa-plus"></i> Tambah Foto Pertama
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($galleries->hasPages())
        <div class="p-4 bg-white rounded-2xl border border-slate-200/80 shadow-sm">
            {{ $galleries->withQueryString()->links() }}
        </div>
    @endif

</div>
@endsection
