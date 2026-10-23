@extends('layouts.admin')

@section('title', 'Edit Layanan ' . $service->title . ' - RSIA Restu Bunda')
@section('page-title', 'Edit Layanan: ' . $service->title)

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Layanan</span>
        </a>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="space-y-4 text-xs">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nama Layanan</label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Badge / Tag (Opsional)</label>
                    <input type="text" name="badge" value="{{ old('badge', $service->badge) }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                <textarea name="description" rows="3" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">{{ old('description', $service->description) }}</textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Detail Rinci (Opsional)</label>
                <textarea name="details" rows="3" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">{{ old('details', $service->details) }}</textarea>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $service->is_active ? 'checked' : '' }} class="rounded text-brand-600 focus:ring-brand-500">
                <label for="is_active" class="font-bold text-slate-700 cursor-pointer">Tampilkan di Halaman Utama</label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.services.index') }}" class="py-2.5 px-5 rounded-xl border border-slate-200 font-bold text-slate-600 hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="py-2.5 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold shadow transition">
                    Perbarui Layanan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
