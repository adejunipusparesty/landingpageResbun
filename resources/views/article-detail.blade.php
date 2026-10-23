@extends('layouts.app')

@section('title', $article->title . ' - RSIA Restu Bunda')

@section('content')
<div class="py-14 sm:py-20 bg-[#fafdfb]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <a href="{{ route('home') }}#artikel" class="inline-flex items-center gap-2 text-xs font-bold text-brand-700 hover:text-brand-900 mb-8 group">
            <i class="fa-solid fa-arrow-left text-xs transform group-hover:-translate-x-1 transition"></i>
            <span>Kembali ke Beranda &amp; Artikel</span>
        </a>

        <!-- Article Header -->
        <div class="space-y-4 mb-8">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-brand-800 text-xs font-bold">
                <i class="fa-solid fa-tag text-[10px]"></i>
                <span>{{ $article->category }}</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold font-heading text-slate-900 tracking-tight leading-tight">
                {{ $article->title }}
            </h1>
            <div class="flex items-center gap-4 text-xs text-slate-500 pt-2 border-b border-slate-100 pb-6">
                <span class="font-semibold text-slate-700"><i class="fa-solid fa-user-doctor text-brand-600 mr-1.5"></i> {{ $article->author }}</span>
                <span>•</span>
                <span><i class="fa-regular fa-calendar mr-1"></i> {{ $article->published_at ? $article->published_at->format('d F Y') : 'Terbaru' }}</span>
                <span>•</span>
                <span><i class="fa-regular fa-eye mr-1"></i> {{ $article->views }} dibaca</span>
            </div>
        </div>

        <!-- Featured Image -->
        <div class="rounded-3xl overflow-hidden shadow-xl aspect-[16/9] mb-10 bg-slate-100">
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
        </div>

        <!-- Article Excerpt & Body -->
        <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-lg border border-slate-100 mb-12">
            <div class="border-l-4 border-brand-500 pl-4 py-1 mb-8 bg-emerald-50/50 rounded-r-xl">
                <p class="text-base text-slate-700 font-medium italic leading-relaxed">
                    {{ $article->excerpt }}
                </p>
            </div>

            <div class="prose max-w-none text-slate-700 text-sm sm:text-base leading-relaxed space-y-4">
                {!! $article->content !!}
            </div>
        </div>

        <!-- Related Articles -->
        @if($recentArticles->count() > 0)
            <div class="pt-8 border-t border-slate-200">
                <h3 class="text-xl font-bold font-heading text-slate-900 mb-6">Artikel Edukasi Lainnya</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($recentArticles as $rec)
                        <a href="{{ route('article.detail', $rec->slug) }}" class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 hover:shadow-md transition group">
                            <div class="aspect-video rounded-xl overflow-hidden mb-3 bg-slate-100">
                                <img src="{{ $rec->image_url }}" alt="{{ $rec->title }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                            </div>
                            <span class="text-[10px] font-bold text-brand-600 block mb-1 uppercase tracking-wider">{{ $rec->category }}</span>
                            <h4 class="text-xs font-bold text-slate-800 group-hover:text-brand-600 transition line-clamp-2">{{ $rec->title }}</h4>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
