@extends('layouts.app')

@section('title', 'Tentang Kami - Profil, Visi, Misi & Direksi RSIA Restu Bunda')

@section('content')
<!-- Hero Header Section -->
<section class="relative pt-32 pb-20 bg-gradient-to-b from-brand-50/80 via-white to-white overflow-hidden">
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-brand-200/40 blur-3xl pointer-events-none"></div>
    <div class="absolute top-20 -left-32 w-80 h-80 rounded-full bg-emerald-100/50 blur-2xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <!-- Breadcrumb & Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white shadow-sm border border-brand-200/60 text-brand-700 text-xs font-bold uppercase tracking-wider mb-5" data-aos="fade-down">
            <i class="fa-solid fa-hospital text-brand-600"></i>
            <span>Mengenal RSIA Restu Bunda</span>
        </div>

        <h1 class="text-3xl sm:text-5xl font-black text-slate-900 font-heading tracking-tight leading-tight max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            Mengabdi dengan Kasih, <br class="hidden sm:inline">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 via-emerald-600 to-teal-700">
                Merawat Setiap Generasi
            </span>
        </h1>

        <!-- Moto Banner -->
        <div class="mt-6 inline-block max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            <div class="px-6 py-3 rounded-2xl bg-gradient-to-r from-emerald-600 to-brand-600 text-white font-extrabold text-sm sm:text-base shadow-lg shadow-brand-600/25 flex items-center justify-center gap-3">
                <i class="fa-solid fa-quote-left text-emerald-200"></i>
                <span>{{ $settings['about_motto'] ?? 'Melayani Sepenuh Hati dengan Kasih Bunda' }}</span>
                <i class="fa-solid fa-quote-right text-emerald-200"></i>
            </div>
        </div>
    </div>
</section>

<!-- Section Visi, Misi & Nilai Inti -->
<section class="py-16 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            <!-- Visi Card -->
            <div class="p-8 sm:p-10 rounded-3xl bg-gradient-to-br from-emerald-900 via-slate-900 to-slate-950 text-white shadow-xl flex flex-col justify-between relative overflow-hidden group" data-aos="fade-right">
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-emerald-500/10 rounded-full blur-2xl group-hover:scale-125 transition duration-500"></div>
                <div class="relative z-10 space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-600/30 border border-emerald-400/30 flex items-center justify-center text-emerald-300 text-2xl shadow-inner">
                        <i class="fa-regular fa-eye"></i>
                    </div>
                    <div>
                        <span class="text-emerald-400 text-xs font-bold uppercase tracking-wider block">Visi Kami</span>
                        <h2 class="text-2xl sm:text-3xl font-black font-heading text-white mt-1">Arah &amp; Cita-Cita</h2>
                    </div>
                    <div class="text-sm sm:text-base text-emerald-100/90 leading-relaxed pt-2 font-medium">
                        {!! $settings['about_vision'] ?? 'Menjadi Rumah Sakit Ibu dan Anak terdepan, unggul, dan terpercaya di Provinsi Lampung dengan standar pelayanan medis modern bernuansa kekeluargaan.' !!}
                    </div>
                </div>

                <div class="pt-8 relative z-10 flex items-center gap-3 text-xs text-emerald-300/70 border-t border-white/10 mt-6">
                    <i class="fa-solid fa-circle-check text-emerald-400"></i>
                    <span>Berorientasi Mutu &amp; Keselamatan Pasien Paripurna</span>
                </div>
            </div>

            <!-- Misi Card -->
            <div class="p-8 sm:p-10 rounded-3xl bg-slate-50 border border-slate-200/80 shadow-sm flex flex-col justify-between" data-aos="fade-left">
                <div class="space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-brand-100 text-brand-700 flex items-center justify-center text-2xl shadow-sm">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div>
                        <span class="text-brand-600 text-xs font-bold uppercase tracking-wider block">Misi Kami</span>
                        <h2 class="text-2xl sm:text-3xl font-black font-heading text-slate-900 mt-1">Langkah Nyata Pelayanan</h2>
                    </div>
                    <div class="prose prose-sm prose-emerald text-slate-700 leading-relaxed pt-2">
                        {!! $settings['about_mission'] ?? '<ul><li>Memberikan pelayanan kesehatan ibu, bayi, dan anak yang profesional dan komprehensif.</li><li>Mengembangkan fasilitas medis modern berbasis teknologi terdepan.</li><li>Mewujudkan lingkungan ramah anak yang menenangkan.</li></ul>' !!}
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-200/60 mt-6 flex items-center gap-2 text-xs text-slate-500 font-semibold">
                    <i class="fa-solid fa-award text-amber-500"></i>
                    <span>Didukung 35+ Dokter Spesialis &amp; Tenaga Medis Bersertifikat</span>
                </div>
            </div>
        </div>

        <!-- Nilai-Nilai Budaya Kerja (Core Values) -->
        @if(!empty($settings['about_core_values']))
            <div class="mt-12 p-8 rounded-3xl bg-brand-50/60 border border-brand-100/80 shadow-sm" data-aos="fade-up">
                <div class="max-w-3xl mx-auto text-center space-y-2 mb-6">
                    <span class="text-brand-600 text-xs font-bold uppercase tracking-wider">Nilai-Nilai Luhur</span>
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 font-heading">Budaya Pelayanan RSIA Restu Bunda</h3>
                </div>
                <div class="prose prose-sm prose-emerald max-w-4xl mx-auto text-slate-700 leading-relaxed text-center sm:text-left">
                    {!! $settings['about_core_values'] !!}
                </div>
            </div>
        @endif

    </div>
</section>

<!-- Section Sejarah Rumah Sakit -->
<section class="py-20 bg-slate-50/60 relative border-y border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left: Foto Sejarah & Gedung -->
            <div class="lg:col-span-5" data-aos="fade-right">
                <div class="relative">
                    <!-- Decorative back frame -->
                    <div class="absolute -inset-4 bg-gradient-to-tr from-brand-300 to-emerald-100 rounded-3xl transform -rotate-2 opacity-70 blur-sm"></div>
                    
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white aspect-[4/3] bg-emerald-100 group">
                        <img src="{{ asset('images/' . ($settings['about_history_image'] ?? 'hero.jpg')) }}" alt="Sejarah RSIA Restu Bunda" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent flex items-end p-6">
                            <div class="text-white">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-emerald-600/90 mb-1 inline-block">
                                    Dokumentasi Rumah Sakit
                                </span>
                                <h4 class="text-sm sm:text-base font-extrabold font-heading">RSIA Restu Bunda Bandar Lampung</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Milestone Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-2xl shadow-xl border border-slate-100 flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl font-black">
                            <i class="fa-solid fa-ribbon"></i>
                        </div>
                        <div>
                            <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Akreditasi</span>
                            <span class="text-sm font-black text-slate-900 font-heading">Paripurna (Bintang 5)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Narasi Sejarah -->
            <div class="lg:col-span-7 space-y-6" data-aos="fade-left">
                <div class="space-y-2">
                    <span class="text-brand-600 text-xs font-bold uppercase tracking-wider">Perjalanan Bersejarah</span>
                    <h2 class="text-2xl sm:text-4xl font-black font-heading text-slate-900 tracking-tight leading-tight">
                        Tumbuh Bersama Kepercayaan Keluarga Sejak Hari Pertama
                    </h2>
                </div>

                <div class="prose prose-sm sm:prose-base prose-emerald text-slate-600 leading-relaxed">
                    {!! $settings['about_history'] ?? '<p>RSIA Restu Bunda berawal dari komitmen tulus mendampingi para ibu melahirkan dengan aman, nyaman, dan penuh kehangatan keluarga di Kota Bandar Lampung.</p>' !!}
                </div>

                <!-- Fast Facts Stats -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 border-t border-slate-200/70">
                    <div class="bg-white p-3.5 rounded-2xl border border-slate-200/80 shadow-sm text-center">
                        <span class="block text-xl sm:text-2xl font-black text-brand-600 font-heading">{{ $settings['stat_doctors'] ?? '35+' }}</span>
                        <span class="text-[11px] font-semibold text-slate-500">Dokter Spesialis</span>
                    </div>
                    <div class="bg-white p-3.5 rounded-2xl border border-slate-200/80 shadow-sm text-center">
                        <span class="block text-xl sm:text-2xl font-black text-emerald-600 font-heading">{{ $settings['stat_patients'] ?? '15k+' }}</span>
                        <span class="text-[11px] font-semibold text-slate-500">Keluarga Bahagia</span>
                    </div>
                    <div class="bg-white p-3.5 rounded-2xl border border-slate-200/80 shadow-sm text-center">
                        <span class="block text-xl sm:text-2xl font-black text-teal-600 font-heading">24 Jam</span>
                        <span class="text-[11px] font-semibold text-slate-500">IGD &amp; Bersalin</span>
                    </div>
                    <div class="bg-white p-3.5 rounded-2xl border border-slate-200/80 shadow-sm text-center">
                        <span class="block text-xl sm:text-2xl font-black text-amber-500 font-heading">Paripurna</span>
                        <span class="text-[11px] font-semibold text-slate-500">Standar Mutu</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Section Jajaran Direksi & Manajemen -->
<section class="py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto space-y-2 mb-14" data-aos="fade-up">
            <span class="text-brand-600 text-xs font-bold uppercase tracking-wider">Pimpinan Rumah Sakit</span>
            <h2 class="text-2xl sm:text-4xl font-black font-heading text-slate-900 tracking-tight">
                Jajaran Direksi &amp; Manajemen
            </h2>
            <p class="text-xs sm:text-sm text-slate-500">
                Para profesional medis dan manajerial yang berdedikasi memimpin RSIA Restu Bunda menuju standar pelayanan kesehatan ibu dan anak berkelas dunia.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($directors as $dir)
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col justify-between group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div>
                        <!-- Photo Frame -->
                        <div class="relative aspect-[4/3] rounded-2xl overflow-hidden bg-slate-200 mb-5 shadow-sm border border-slate-200">
                            <img src="{{ $dir->photo_url }}" alt="{{ $dir->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition"></div>
                        </div>

                        <!-- Name & Position -->
                        <div class="space-y-1">
                            <span class="inline-block text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-brand-100 text-brand-800">
                                {{ $dir->position }}
                            </span>
                            <h3 class="text-base sm:text-lg font-extrabold text-slate-900 font-heading leading-snug">
                                {{ $dir->name }}
                            </h3>
                        </div>

                        <!-- Bio / Quote -->
                        @if($dir->bio)
                            <div class="text-xs text-slate-600 leading-relaxed pt-3 border-t border-slate-200/70 mt-3 prose prose-xs">
                                {!! $dir->bio !!}
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-200/60 flex items-center gap-2 text-[11px] font-bold text-brand-700">
                        <i class="fa-solid fa-hospital-user"></i>
                        <span>RSIA Restu Bunda</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                    <i class="fa-solid fa-users text-3xl text-slate-300 mb-2"></i>
                    <p class="text-xs font-semibold text-slate-500">Informasi direksi sedang diperbarui.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- CTA Janji Temu -->
<section class="py-16 bg-gradient-to-r from-brand-600 to-emerald-700 text-white relative overflow-hidden">
    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
        <h2 class="text-2xl sm:text-4xl font-black font-heading tracking-tight">
            Ingin Berkonsultasi dengan Dokter Spesialis Kami?
        </h2>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-xl mx-auto leading-relaxed">
            Daftarkan janji temu secara online dengan mudah, bebas antre lama, dan dapatkan pelayanan terbaik untuk buah hati dan keluarga Anda.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="{{ route('home') }}#booking" class="px-6 py-3.5 rounded-2xl bg-white text-emerald-800 font-black text-xs sm:text-sm shadow-xl hover:bg-emerald-50 transition transform hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2">
                <i class="fa-solid fa-calendar-check text-emerald-600"></i>
                <span>Buat Janji Temu Sekarang</span>
            </a>
            <a href="{{ route('gallery') }}" class="px-6 py-3.5 rounded-2xl bg-emerald-800/60 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm border border-emerald-400/30 transition flex items-center gap-2">
                <i class="fa-solid fa-images"></i>
                <span>Lihat Galeri Fasilitas &amp; Kegiatan</span>
            </a>
        </div>
    </div>
</section>
@endsection
