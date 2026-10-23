@extends('layouts.admin')

@section('title', 'Kelola Tim Dokter Spesialis - RSIA Restu Bunda')
@section('page-title', 'Tim Dokter Spesialis')

@section('content')
<div class="space-y-6">

    <!-- Top Info & Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-xs text-slate-500">Kelola daftar profil dokter spesialis, jadwal praktik poliklinik, dan foto profil.</p>
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-brand-700 text-xs font-bold border border-emerald-200/80 shadow-xs mt-2.5">
                <i class="fa-solid fa-arrows-up-down-left-right text-emerald-600 text-xs"></i>
                <span>Tips: Klik &amp; tahan / drag kartu dokter untuk mengubah urutan tampil di Beranda secara realtime!</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <!-- Reorder Notification Badge -->
            <span id="reorderStatusBadge" class="hidden items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold transition"></span>

            <a href="{{ route('admin.doctors.create') }}" class="py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition flex items-center gap-2 active:scale-95 shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Dokter Baru</span>
            </a>
        </div>
    </div>

    <!-- Doctors Sortable Drag Grid -->
    <div id="doctorsSortableGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($doctors as $doc)
            <div class="doctor-sortable-card bg-white rounded-3xl p-5 shadow-sm border border-slate-200/80 flex flex-col justify-between hover:shadow-md transition cursor-grab active:cursor-grabbing relative group hover:border-emerald-300" data-id="{{ $doc->id }}">
                <div class="space-y-4">
                    <!-- Drag Handle Bar & Order Number Badge -->
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <!-- Drag Handle -->
                            <div class="drag-handle w-7 h-7 rounded-lg bg-slate-100 group-hover:bg-emerald-100/70 text-slate-400 group-hover:text-brand-700 flex items-center justify-center cursor-grab active:cursor-grabbing transition" title="Tahan dan geser untuk ubah urutan">
                                <i class="fa-solid fa-grip-vertical text-xs"></i>
                            </div>
                            <!-- Order Badge -->
                            <span class="doctor-order-badge px-2.5 py-0.5 rounded-md bg-slate-100 text-slate-700 group-hover:bg-brand-600 group-hover:text-white text-[11px] font-black font-heading transition">
                                #{{ $doc->order_num ?: ($loop->index + 1) }}
                            </span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-semibold group-hover:text-brand-600 transition flex items-center gap-1 select-none">
                            <i class="fa-solid fa-hand text-[9px]"></i> Geser urutan
                        </span>
                    </div>

                    <!-- Doctor Info -->
                    <div class="flex items-center gap-4">
                        <img src="{{ $doc->photo_url }}" alt="{{ $doc->name }}" class="w-16 h-16 rounded-2xl object-cover bg-emerald-50 border border-emerald-100 shadow-sm shrink-0 pointer-events-none">
                        <div class="overflow-hidden">
                            <span class="inline-block px-2.5 py-0.5 rounded-full bg-emerald-50 text-brand-700 text-[10px] font-extrabold uppercase tracking-wider mb-1">
                                {{ $doc->category }}
                            </span>
                            <h3 class="text-sm font-bold font-heading text-slate-900 truncate" title="{{ $doc->name }}">{{ $doc->name }}</h3>
                            <p class="text-xs text-brand-600 font-medium truncate" title="{{ $doc->specialty }}">{{ $doc->specialty }}</p>
                        </div>
                    </div>

                    <div class="text-xs text-slate-600 bg-slate-50 rounded-2xl p-3 border border-slate-100 space-y-1">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 font-semibold">Jadwal:</span>
                            <span class="font-bold text-slate-800">{{ $doc->schedule_days ?? '-' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 font-semibold">Jam:</span>
                            <span class="font-bold text-slate-800">{{ $doc->schedule_hours ?? '-' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 font-semibold">SIP:</span>
                            <span class="text-slate-600 font-medium">{{ $doc->sip_number ?? '-' }}</span>
                        </div>
                    </div>

                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                        {{ $doc->bio }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="pt-4 border-t border-slate-100 mt-4 flex items-center justify-between">
                    <div>
                        @if($doc->is_active)
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-emerald-600">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Aktif Praktik
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-slate-400">
                                <span class="w-2 h-2 rounded-full bg-slate-300"></span> Nonaktif
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.doctors.edit', $doc->id) }}" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </a>
                        <form action="{{ route('admin.doctors.destroy', $doc->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 transition" title="Hapus">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/sortable.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('doctorsSortableGrid');
    const statusBadge = document.getElementById('reorderStatusBadge');
    if (!grid || typeof Sortable === 'undefined') return;

    new Sortable(grid, {
        animation: 250,
        handle: '.drag-handle, .doctor-sortable-card',
        ghostClass: 'opacity-40',
        chosenClass: 'scale-[1.02]',
        dragClass: 'shadow-2xl',
        onEnd: function() {
            // Update nomor urutan pada badge di kartu secara langsung
            const cards = grid.querySelectorAll('.doctor-sortable-card');
            const newOrder = [];
            cards.forEach((card, idx) => {
                const id = card.getAttribute('data-id');
                newOrder.push(id);
                const badge = card.querySelector('.doctor-order-badge');
                if (badge) {
                    badge.textContent = '#' + (idx + 1);
                }
            });

            // Tampilkan indikator loading penyimpanan
            if (statusBadge) {
                statusBadge.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 text-amber-700 text-xs font-bold border border-amber-200';
                statusBadge.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i><span>Menyimpan urutan...</span>';
            }

            // Kirim urutan baru ke backend
            fetch("{{ route('admin.doctors.reorder') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ order: newOrder })
            })
            .then(res => res.json())
            .then(data => {
                if (statusBadge) {
                    statusBadge.className = 'hidden';
                }
                if (typeof window.showToast === 'function') {
                    window.showToast('success', 'Urutan Dokter Tersimpan!', 'Perubahan urutan dokter telah diterapkan secara realtime.', 2400);
                }
            })
            .catch(err => {
                console.error('Error reordering doctors:', err);
                if (statusBadge) {
                    statusBadge.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-rose-50 text-rose-700 text-xs font-bold border border-rose-200';
                    statusBadge.innerHTML = '<i class="fa-solid fa-circle-xmark"></i><span>Gagal menyimpan</span>';
                }
            });
        }
    });
});
</script>
@endpush