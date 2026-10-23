@extends('layouts.admin')

@section('title', 'Kelola Artikel &amp; Edukasi - RSIA Restu Bunda')
@section('page-title', 'Artikel &amp; Edukasi Kesehatan')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <p class="text-xs text-slate-500">Publikasikan panduan kesehatan ibu, kehamilan, nutrisi anak, dan edukasi medis terkini.</p>
        <a href="{{ route('admin.articles.create') }}" class="py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Tulis Artikel Baru</span>
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-4 px-6">Artikel</th>
                        <th class="py-4 px-6">Kategori</th>
                        <th class="py-4 px-6">Penulis</th>
                        <th class="py-4 px-6">Tanggal Rilis</th>
                        <th class="py-4 px-6">Pembaca</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($articles as $art)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="w-12 h-12 rounded-xl object-cover bg-slate-100 shrink-0">
                                    <div>
                                        <a href="{{ route('article.detail', $art->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-brand-600 transition block line-clamp-1">
                                            {{ $art->title }}
                                        </a>
                                        <span class="text-[11px] text-slate-400 block line-clamp-1">{{ $art->excerpt }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-brand-700 font-bold text-[10px]">
                                    {{ $art->category }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-700">
                                {{ $art->author }}
                            </td>
                            <td class="py-4 px-6 text-slate-500">
                                {{ $art->published_at ? $art->published_at->format('d M Y') : '-' }}
                            </td>
                            <td class="py-4 px-6 font-bold text-slate-700">
                                <i class="fa-regular fa-eye text-slate-400 mr-1"></i> {{ $art->views }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('article.detail', $art->slug) }}" target="_blank" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition" title="Lihat di Web">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $art->id) }}" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition" title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 transition" title="Hapus">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-400">Belum ada artikel yang diterbitkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
