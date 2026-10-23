@extends('layouts.admin')

@section('title', 'Kelola Testimoni Pasien - RSIA Restu Bunda')
@section('page-title', 'Testimoni Pasien & Keluarga')

@section('content')
<div class="space-y-6">

    <!-- Header & Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-xs text-slate-500">
                Kelola ulasan, kesan, dan pengalaman pasien serta keluarga yang ditampilkan pada landing page.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-xs shadow-md shadow-brand-600/20 transition active:scale-95">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Testimoni Baru</span>
            </a>
        </div>
    </div>

    <!-- Testimonials Table Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                        <th class="pb-3.5 pl-2">Pasien / Wali</th>
                        <th class="pb-3.5">Rating</th>
                        <th class="pb-3.5">Isi Ulasan &amp; Pengalaman</th>
                        <th class="pb-3.5 text-center">Status Tayang</th>
                        <th class="pb-3.5 text-right pr-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80 text-slate-700">
                    @forelse($testimonials as $testi)
                        <tr class="hover:bg-slate-50/70 transition">
                            <!-- Avatar & Name -->
                            <td class="py-4 pl-2">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $testi->avatar_url }}" alt="{{ $testi->name }}" class="w-11 h-11 rounded-full object-cover border-2 border-emerald-100 shadow-sm shrink-0">
                                    <div>
                                        <h4 class="font-extrabold text-slate-900 text-sm font-heading">{{ $testi->name }}</h4>
                                        <span class="text-[11px] text-slate-500">{{ $testi->patient_info ?? 'Pasien RSIA Restu Bunda' }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Rating -->
                            <td class="py-4 whitespace-nowrap">
                                <div class="flex items-center text-amber-400 text-xs gap-1">
                                    @for($i = 0; $i < $testi->rating; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                    @for($i = $testi->rating; $i < 5; $i++)
                                        <i class="fa-regular fa-star text-slate-300"></i>
                                    @endfor
                                </div>
                                <span class="text-[10px] text-slate-400 font-bold">{{ $testi->rating }}.0 / 5.0</span>
                            </td>

                            <!-- Content -->
                            <td class="py-4 max-w-md">
                                <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed italic">
                                    "{{ $testi->content }}"
                                </p>
                            </td>

                            <!-- Status Toggle -->
                            <td class="py-4 text-center whitespace-nowrap">
                                <form action="{{ route('admin.testimonials.toggle', $testi->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($testi->is_approved)
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold hover:bg-emerald-200 transition" title="Klik untuk sembunyikan">
                                            <i class="fa-solid fa-circle-check text-xs"></i>
                                            <span>Tayang di Web</span>
                                        </button>
                                    @else
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-[10px] font-bold hover:bg-slate-200 transition" title="Klik untuk tayangkan">
                                            <i class="fa-solid fa-eye-slash text-xs"></i>
                                            <span>Disembunyikan</span>
                                        </button>
                                    @endif
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 text-right pr-2 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.testimonials.edit', $testi->id) }}" class="p-2 rounded-xl text-slate-500 hover:text-brand-600 hover:bg-emerald-50 transition" title="Edit Testimoni">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testi->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus Testimoni">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <i class="fa-solid fa-comments text-4xl mb-3 text-slate-300 block"></i>
                                <span>Belum ada data testimoni pasien.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
