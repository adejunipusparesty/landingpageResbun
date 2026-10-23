@extends('layouts.admin')

@section('title', 'Kelola Fasilitas Rumah Sakit - RSIA Restu Bunda')
@section('page-title', 'Fasilitas Rumah Sakit')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <p class="text-xs text-slate-500">Kelola informasi fasilitas rawat inap VIP, area bermain anak, dan ruang laktasi RSIA Restu Bunda.</p>
        <a href="{{ route('admin.facilities.create') }}" class="py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Fasilitas Baru</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($facilities as $fac)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-200/80 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="aspect-video bg-slate-100 relative overflow-hidden">
                        <img src="{{ $fac->photo_url }}" alt="{{ $fac->title }}" class="w-full h-full object-cover">
                        @if($fac->badge)
                            <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-slate-900/80 text-white text-[10px] font-bold">
                                {{ $fac->badge }}
                            </span>
                        @endif
                    </div>

                    <div class="p-5 space-y-2">
                        <h3 class="text-base font-bold font-heading text-slate-900">{{ $fac->title }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $fac->description }}</p>
                    </div>
                </div>

                <div class="p-5 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between">
                    <span class="text-[11px] font-bold {{ $fac->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                        {{ $fac->is_active ? '● Aktif' : '○ Nonaktif' }}
                    </span>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.facilities.edit', $fac->id) }}" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </a>
                        <form action="{{ route('admin.facilities.destroy', $fac->id) }}" method="POST" class="inline">
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
