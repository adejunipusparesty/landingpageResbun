@extends('layouts.admin')

@section('title', 'Kelola Layanan Medis - RSIA Restu Bunda')
@section('page-title', 'Layanan Medis Ibu &amp; Anak')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <p class="text-xs text-slate-500">Kelola daftar layanan medis komprehensif RSIA Restu Bunda yang ditampilkan di landing page.</p>
        <a href="{{ route('admin.services.create') }}" class="py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Layanan Baru</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $srv)
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 flex flex-col justify-between hover:shadow-md transition">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-brand-600 flex items-center justify-center text-xl font-bold">
                            <i class="fa-solid fa-hand-holding-medical"></i>
                        </div>
                        @if($srv->badge)
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-brand-800 text-[10px] font-extrabold uppercase">
                                {{ $srv->badge }}
                            </span>
                        @endif
                    </div>

                    <h3 class="text-base font-bold font-heading text-slate-900">{{ $srv->title }}</h3>
                    <p class="text-xs text-slate-500 leading-relaxed font-normal">{{ $srv->description }}</p>
                </div>

                <div class="pt-4 border-t border-slate-100 mt-4 flex items-center justify-between">
                    <span class="text-[11px] font-bold {{ $srv->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                        {{ $srv->is_active ? '● Tampil di Web' : '○ Disembunyikan' }}
                    </span>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.services.edit', $srv->id) }}" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </a>
                        <form action="{{ route('admin.services.destroy', $srv->id) }}" method="POST" class="inline">
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
