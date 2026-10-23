@extends('layouts.app')

@section('title', 'RSIA Restu Bunda - Rumah Sakit Ibu & Anak Pilihan di Bandar Lampung')

@section('content')

    <!-- Flash Booking Success Modal / Notification -->
    @if(session('booking_success'))
        <div id="bookingSuccessNotification" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-emerald-100 text-center relative" data-aos="zoom-in">
                <button onclick="document.getElementById('bookingSuccessNotification').remove()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
                <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner animate-bounce">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full uppercase tracking-wider mb-2">Reservasi Berhasil Diajukan</span>
                <h3 class="text-2xl font-bold font-heading text-slate-800 mb-2">Terima Kasih, {{ session('booking_success')['patient_name'] }}!</h3>
                <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                    Permintaan janji temu medis Anda telah kami terima. Tim Customer Care kami akan segera menghubungi nomor WhatsApp Anda untuk konfirmasi nomor antrean.
                </p>

                <div class="bg-slate-50 rounded-2xl p-4 text-left mb-6 border border-slate-100 space-y-2 text-xs">
                    <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                        <span class="text-slate-500 font-medium">Kode Booking:</span>
                        <span class="font-extrabold text-brand-700 text-sm tracking-wide">{{ session('booking_success')['code'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                        <span class="text-slate-500 font-medium">Tanggal Janji:</span>
                        <span class="font-semibold text-slate-800">{{ session('booking_success')['date'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-slate-500 font-medium">Dokter Pilihan:</span>
                        <span class="font-semibold text-slate-800">{{ session('booking_success')['doctor'] }}</span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6281172345678' }}?text=Halo%20RSIA%20Restu%20Bunda,%20saya%20sudah%20mendaftar%20online%20dengan%20Kode%20Booking:%20{{ session('booking_success')['code'] }}" target="_blank" class="flex-1 py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                        <span>Konfirmasi via WhatsApp</span>
                    </a>
                    <button onclick="document.getElementById('bookingSuccessNotification').remove()" class="py-3 px-6 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-100 font-semibold text-sm transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- 1. HERO SECTION -->
    <section id="beranda" class="relative bg-[#eaf7f0] pt-12 pb-20 lg:pt-16 lg:pb-28 overflow-hidden">
        <!-- Background decorative animated floating shapes -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-emerald-200/40 blur-3xl pointer-events-none animate-float-slow"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-teal-100/50 blur-2xl pointer-events-none animate-float-reverse"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                <!-- Left Column: Copy & Interactive Quick Booking -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Pill Tag -->
                    <div data-aos="fade-down" data-aos-duration="600" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-100/90 border border-emerald-300/60 text-emerald-800 text-xs font-bold tracking-wide shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                        <i class="fa-solid fa-seedling text-brand-600"></i>
                        <span>{{ $settings['badge_city'] ?? 'Rumah Sakit Ibu & Anak Pilihan di Bandar Lampung' }}</span>
                    </div>

                    <!-- Main Headline -->
                    <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                        Melayani Sepenuh Hati untuk <span class="text-brand-600 block sm:inline">Kesehatan Seluruh Keluarga</span>
                    </h1>

                    <!-- Paragraph description -->
                    <p data-aos="fade-up" data-aos-delay="200" class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl font-normal">
                        Rumah Sakit Ibu &amp; Anak Restu Bunda hadir dengan komitmen medis modern &amp; terpercaya, menghadirkan pelayanan kesehatan komprehensif bagi seluruh anggota keluarga tercinta.
                    </p>

                    <!-- Quick Booking Bar / Card -->
                    <div id="quick-booking" data-aos="fade-up" data-aos-delay="300" class="bg-white rounded-3xl p-4 sm:p-5 shadow-xl shadow-emerald-900/5 border border-emerald-100/80 max-w-2xl mt-4 hover:border-emerald-300 transition duration-300">
                        <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <!-- Field 1: Pilih Tanggal -->
                                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3 focus-within:ring-2 focus-within:ring-brand-500 focus-within:border-brand-500 focus-within:bg-white transition duration-200">
                                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">
                                        <i class="fa-regular fa-calendar text-brand-600 mr-1"></i> Pilih Tanggal
                                    </label>
                                    <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full bg-transparent text-sm font-semibold text-slate-800 focus:outline-none">
                                </div>

                                <!-- Field 2: Spesialisasi Dokter -->
                                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3 focus-within:ring-2 focus-within:ring-brand-500 focus-within:border-brand-500 focus-within:bg-white transition duration-200">
                                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">
                                        <i class="fa-solid fa-stethoscope text-brand-600 mr-1"></i> Spesialisasi Dokter
                                    </label>
                                    <select name="doctor_id" class="w-full bg-transparent text-sm font-semibold text-slate-800 focus:outline-none cursor-pointer">
                                        <option value="">Pilih Dokter / Spesialis</option>
                                        @foreach($doctors as $doc)
                                            <option value="{{ $doc->id }}">{{ $doc->name }} ({{ $doc->specialty }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Additional inputs -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3 focus-within:ring-2 focus-within:ring-brand-500 focus-within:border-brand-500 focus-within:bg-white transition duration-200">
                                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">
                                        <i class="fa-regular fa-user text-brand-600 mr-1"></i> Nama Pasien / Ibu / Anak
                                    </label>
                                    <input type="text" name="patient_name" placeholder="Nama lengkap pasien" required class="w-full bg-transparent text-sm font-semibold text-slate-800 focus:outline-none">
                                </div>
                                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3 focus-within:ring-2 focus-within:ring-brand-500 focus-within:border-brand-500 focus-within:bg-white transition duration-200">
                                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">
                                        <i class="fa-brands fa-whatsapp text-brand-600 mr-1"></i> No. WhatsApp Aktif
                                    </label>
                                    <input type="tel" name="phone" placeholder="Contoh: 08123456789" required class="w-full bg-transparent text-sm font-semibold text-slate-800 focus:outline-none">
                                </div>
                            </div>

                            <!-- Action Button with animated hover glow -->
                            <button type="submit" class="w-full py-4 rounded-2xl bg-gradient-to-r from-emerald-600 to-brand-600 hover:from-emerald-700 hover:to-brand-700 text-white font-extrabold text-sm sm:text-base shadow-lg shadow-brand-600/30 transition transform hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.99] flex items-center justify-center gap-2 group">
                                <span>Buat Janji Konsultasi</span>
                                <i class="fa-solid fa-arrow-right transition transform group-hover:translate-x-1.5"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Hero Image with Asymmetrical Arched Border & Floating Badge -->
                <div class="lg:col-span-5 flex justify-center" data-aos="zoom-in" data-aos-delay="200">
                    <div class="relative w-full max-w-md lg:max-w-none">
                        <!-- Decorative Frame Behind with subtle rotation -->
                        <div class="absolute -inset-3 bg-gradient-to-tr from-brand-300 to-emerald-100 hero-arch transform -rotate-1 opacity-70 blur-sm animate-pulse"></div>
                        
                        <!-- Main Photo Container -->
                        <div class="relative overflow-hidden hero-arch shadow-2xl border-4 border-white aspect-[4/3] lg:aspect-[5/4] bg-emerald-50 group">
                            <img src="{{ asset('images/hero.jpg') }}" alt="Pemeriksaan Pediatrik Penuh Kasih di RSIA Restu Bunda" class="w-full h-full object-cover object-center transform group-hover:scale-105 transition duration-700 ease-out">
                        </div>

                        <!-- Floating Micro Badge with Micro Animation -->
                        <div data-aos="zoom-in" data-aos-delay="400" class="absolute -bottom-4 -left-4 bg-white/95 backdrop-blur-md rounded-2xl p-3.5 shadow-xl border border-emerald-100 flex items-center gap-3 animate-float-slow">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-lg shadow-sm">
                                <i class="fa-solid fa-heart-pulse"></i>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-800">Pelayanan Empatik</span>
                                <span class="block text-[11px] text-slate-500">Ramah Ibu &amp; Buah Hati</span>
                            </div>
                        </div>

                        <!-- Secondary Floating Badge (Top-Right) -->
                        <div class="absolute -top-3 -right-3 bg-emerald-900/90 backdrop-blur-md text-white rounded-2xl px-3.5 py-2 shadow-lg flex items-center gap-2 animate-float-reverse">
                            <i class="fa-solid fa-shield-heart text-emerald-400 text-sm"></i>
                            <span class="text-[11px] font-extrabold tracking-wide">IGD 24 Jam Siaga</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. STATS BAR (Interactive Smooth Counters) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 sm:-mt-12 relative z-20" data-aos="fade-up" data-aos-delay="150">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <!-- Stat 1 -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-xl shadow-slate-900/5 border border-slate-100 hover:border-emerald-300 hover-lift-sm transition duration-300">
                <div class="text-3xl sm:text-4xl font-black font-heading text-brand-dark mb-1 flex items-baseline">
                    <span class="stat-counter" data-target="35">0</span>
                    <span class="text-brand-600">+</span>
                </div>
                <div class="text-sm font-bold text-slate-800">Dokter Spesialis</div>
                <div class="text-xs text-slate-500 mt-1">Pilihan Dokter Ahli &amp; Berpengalaman</div>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-xl shadow-slate-900/5 border border-slate-100 hover:border-emerald-300 hover-lift-sm transition duration-300">
                <div class="text-3xl sm:text-4xl font-black font-heading text-brand-dark mb-1 flex items-baseline">
                    <span class="stat-counter" data-target="15">0</span>
                    <span class="text-brand-600">k+</span>
                </div>
                <div class="text-sm font-bold text-slate-800">Pasien Terlayani</div>
                <div class="text-xs text-slate-500 mt-1">Kepercayaan Keluarga Sejak Berdiri</div>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-xl shadow-slate-900/5 border border-slate-100 hover:border-emerald-300 hover-lift-sm transition duration-300">
                <div class="text-3xl sm:text-4xl font-black font-heading text-brand-dark mb-1 flex items-baseline">
                    <span class="stat-counter" data-target="24">0</span>
                    <span class="text-brand-600 text-2xl sm:text-3xl font-bold ml-1">Jam</span>
                </div>
                <div class="text-sm font-bold text-slate-800">Layanan Darurat</div>
                <div class="text-xs text-slate-500 mt-1">Pelayanan IGD &amp; Bersalin Nonstop</div>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-xl shadow-slate-900/5 border border-slate-100 hover:border-emerald-300 hover-lift-sm transition duration-300">
                <div class="text-3xl sm:text-4xl font-black font-heading text-brand-dark mb-1">
                    {{ $settings['stat_accreditation'] ?? 'Paripurna' }}
                </div>
                <div class="text-sm font-bold text-slate-800">Akreditasi KARS</div>
                <div class="text-xs text-slate-500 mt-1">Terakreditasi Bintang 5 Resmi</div>
            </div>
        </div>
    </section>

    <!-- 3. SERVICES SECTION: Solusi Medis Lengkap Ibu & Anak -->
    <section id="layanan" class="py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-extrabold uppercase tracking-widest font-heading">
                    Solusi Medis Lengkap
                </span>
                <h2 class="text-3xl sm:text-4xl font-black font-heading text-slate-900 tracking-tight">
                    Solusi Medis Lengkap Ibu &amp; Anak
                </h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Layanan medis terpadu dan berkualitas tinggi untuk kenyamanan dan kesehatan ibu serta buah hati Anda di setiap fase kehidupannya.
                </p>
            </div>

            <!-- Services Grid: 3x2 Cards in Mint Background with Staggered AOS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($services as $srv)
                    <div class="mint-card rounded-3xl p-6 sm:p-8 flex flex-col justify-between border border-emerald-100/60 hover-lift" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 + 100 }}">
                        <div class="space-y-4">
                            <!-- Icon Badge -->
                            <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-brand-600 text-xl font-bold transition transform group-hover:scale-110">
                                @if(str_contains(strtolower($srv->title), 'kandungan'))
                                    <i class="fa-solid fa-venus"></i>
                                @elseif(str_contains(strtolower($srv->title), 'anak') || str_contains(strtolower($srv->title), 'pediatrik'))
                                    <i class="fa-solid fa-baby"></i>
                                @elseif(str_contains(strtolower($srv->title), 'persalinan'))
                                    <i class="fa-solid fa-hospital-user"></i>
                                @elseif(str_contains(strtolower($srv->title), 'usg') || str_contains(strtolower($srv->title), 'lab'))
                                    <i class="fa-solid fa-chart-pie"></i>
                                @elseif(str_contains(strtolower($srv->title), 'vaksin'))
                                    <i class="fa-solid fa-syringe"></i>
                                @else
                                    <i class="fa-solid fa-shapes"></i>
                                @endif
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold font-heading text-slate-800 tracking-tight">
                                {{ $srv->title }}
                            </h3>

                            <!-- Description -->
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                                {{ $srv->description }}
                            </p>
                        </div>

                        <!-- Link CTA -->
                        <div class="pt-6">
                            <a href="#quick-booking" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-700 hover:text-brand-900 group">
                                <span>Selengkapnya</span>
                                <i class="fa-solid fa-arrow-right text-[11px] transform group-hover:translate-x-1 transition"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

            <!-- 4. DOCTORS SECTION: Ditangani oleh Dokter Ahli & Reassuring (Continuous Loop Slider) -->
    <section id="dokter" class="py-20 lg:py-28 bg-[#f4faf6] border-y border-emerald-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header Row -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-6" data-aos="fade-up">
                <div class="space-y-3 max-w-2xl">
                    <span class="inline-block px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-extrabold uppercase tracking-widest font-heading">
                        Tim Dokter Spesialis
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black font-heading text-slate-900 tracking-tight">
                        Ditangani oleh Dokter Ahli &amp; Reassuring
                    </h2>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                        Para tenaga medis profesional kami siap mendampingi perjalanan kesehatan Anda dan keluarga dengan kehangatan dan dedikasi penuh.
                    </p>
                </div>

                <div class="hidden sm:block">
                    <a href="#quick-booking" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs uppercase tracking-wider shadow-md shadow-brand-600/20 transition active:scale-95">
                        <span>Buat Janji Konsultasi</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Interactive Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2 mb-8 pb-2 overflow-x-auto" data-aos="fade-up" data-aos-delay="100">
                <button type="button" onclick="filterDoctorCategory('all', this)" class="doctor-filter-btn active px-4 py-2 rounded-full text-xs font-extrabold transition bg-brand-600 text-white shadow-sm">
                    Semua Dokter
                </button>
                <button type="button" onclick="filterDoctorCategory('anak', this)" class="doctor-filter-btn px-4 py-2 rounded-full text-xs font-bold transition bg-white text-slate-600 hover:bg-emerald-50 border border-slate-200">
                    <i class="fa-solid fa-baby mr-1 text-emerald-600"></i> Poli Anak (Pediatrik)
                </button>
                <button type="button" onclick="filterDoctorCategory('kebidanan', this)" class="doctor-filter-btn px-4 py-2 rounded-full text-xs font-bold transition bg-white text-slate-600 hover:bg-emerald-50 border border-slate-200">
                    <i class="fa-solid fa-venus mr-1 text-emerald-600"></i> Kebidanan &amp; Kandungan
                </button>
                <button type="button" onclick="filterDoctorCategory('neonatus', this)" class="doctor-filter-btn px-4 py-2 rounded-full text-xs font-bold transition bg-white text-slate-600 hover:bg-emerald-50 border border-slate-200">
                    <i class="fa-solid fa-heart-pulse mr-1 text-emerald-600"></i> Neonatus / NICU
                </button>
                <button type="button" onclick="filterDoctorCategory('laktasi', this)" class="doctor-filter-btn px-4 py-2 rounded-full text-xs font-bold transition bg-white text-slate-600 hover:bg-emerald-50 border border-slate-200">
                    <i class="fa-solid fa-person-breastfeeding mr-1 text-emerald-600"></i> Laktasi
                </button>
            </div>

            <!-- Doctor Slider Relative Wrapper (Panah Kiri & Kanan + Viewport Tanpa Scrollbar/Ruler) -->
            <div class="relative group/docslider">
                <!-- Panah Kiri (Prev) -->
                <button type="button" id="doctorPrevSideBtn" aria-label="Dokter Sebelumnya" class="absolute -left-3 sm:-left-5 lg:-left-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white shadow-lg shadow-emerald-950/10 border border-slate-200/90 text-slate-700 hover:text-brand-600 hover:border-brand-400 hover:scale-110 flex items-center justify-center transition-all duration-200 active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-chevron-left text-sm sm:text-base"></i>
                </button>

                <!-- Panah Kanan (Next) -->
                <button type="button" id="doctorNextSideBtn" aria-label="Dokter Selanjutnya" class="absolute -right-3 sm:-right-5 lg:-right-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white shadow-lg shadow-emerald-950/10 border border-slate-200/90 text-slate-700 hover:text-brand-600 hover:border-brand-400 hover:scale-110 flex items-center justify-center transition-all duration-200 active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-chevron-right text-sm sm:text-base"></i>
                </button>

                <!-- Viewport: overflow-hidden TANPA SCROLLBAR / RULER -->
                <div id="doctorSliderViewport" class="overflow-hidden py-4 px-1" style="scrollbar-width: none; -ms-overflow-style: none;">
                    @php
                        $totalDocs = count($doctors);
                        // Duplikasi item jika dokter < 6 agar track slider berkelanjutan mulus tanpa jeda kosong
                        $sliderDocs = $doctors;
                        if ($totalDocs > 0 && $totalDocs < 6) {
                            $sliderDocs = $doctors->concat($doctors);
                        }
                    @endphp

                    <!-- Continuous Track (transform based, geser continuous tanpa reset mundur) -->
                    <div id="doctorSliderTrack" class="flex gap-6 will-change-transform items-stretch">
                        @foreach($sliderDocs as $doc)
                            @php
                                $nameLength = mb_strlen($doc->name);
                                if ($nameLength > 36) {
                                    $nameFontClass = "text-[14px] sm:text-[15px] leading-tight";
                                } elseif ($nameLength > 24) {
                                    $nameFontClass = "text-[16px] sm:text-[17px] leading-snug";
                                } else {
                                    $nameFontClass = "text-lg sm:text-xl leading-snug";
                                }
                            @endphp
                            <div class="doctor-card w-full sm:w-[calc(50%-12px)] lg:w-[calc((100%-48px)/3)] shrink-0 bg-white rounded-3xl overflow-hidden shadow-lg shadow-emerald-900/5 border border-slate-100 flex flex-col justify-between hover-lift transition duration-300 group select-none" data-category="{{ $doc->category ?? 'umum' }}" data-doctor-index="{{ $loop->index % max(1, $totalDocs) }}">
                                <div class="flex flex-col flex-1">
                                    <!-- Doctor Photo -->
                                    <div class="aspect-square w-full overflow-hidden bg-gradient-to-b from-[#dff5e8] to-[#edf8f2] relative flex items-end justify-center">
                                        <img src="{{ $doc->photo_url }}" alt="{{ $doc->name }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-500 pointer-events-none">
                                        @if($doc->experience)
                                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[11px] font-bold text-brand-700 shadow-sm border border-emerald-100">
                                                {{ $doc->experience }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Doctor Meta Info -->
                                    <div class="p-6 flex-1 flex flex-col space-y-2.5">
                                        <div class="min-h-[3.5rem] sm:h-14 flex items-center">
                                            <h3 class="{{ $nameFontClass }} font-bold font-heading text-slate-900 tracking-tight group-hover:text-brand-700 transition line-clamp-2">
                                                {{ $doc->name }}
                                            </h3>
                                        </div>

                                        <div class="h-5 flex items-center">
                                            <p class="text-xs font-semibold text-brand-600 truncate" title="{{ $doc->specialty }}">
                                                {{ $doc->specialty }}
                                            </p>
                                        </div>

                                        <div class="h-10 overflow-hidden">
                                            <p class="text-xs text-slate-500 leading-relaxed line-clamp-2">
                                                {{ $doc->bio }}
                                            </p>
                                        </div>

                                        <div class="mt-auto pt-2">
                                            <div class="text-xs text-slate-600 bg-slate-50/90 rounded-2xl p-3 border border-slate-100 space-y-1 min-h-[4.5rem] flex flex-col justify-center">
                                                <div class="flex items-center gap-2">
                                                    <i class="fa-regular fa-clock text-brand-600 shrink-0"></i>
                                                    <span class="font-medium truncate">{{ $doc->schedule_days ?: 'Jadwal Praktik' }}</span>
                                                </div>
                                                <div class="text-[11px] text-slate-500 pl-5 font-semibold truncate">
                                                    {{ $doc->schedule_hours ?: 'Konfirmasi Customer Care' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Action Button -->
                                <div class="p-6 pt-0 mt-auto">
                                    <button type="button" onclick="selectDoctorForBooking('{{ $doc->id }}', '{{ addslashes($doc->name) }}', '{{ addslashes($doc->specialty) }}')" class="w-full py-3 rounded-2xl bg-emerald-100/80 hover:bg-brand-600 text-brand-800 hover:text-white font-extrabold text-xs uppercase tracking-wider transition active:scale-[0.98] flex items-center justify-center gap-2 shadow-sm">
                                        <i class="fa-regular fa-calendar-check"></i>
                                        <span>PILIH JADWAL</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Empty State Message -->
                <div id="doctorEmptyState" class="hidden text-center py-16 px-6 bg-white rounded-3xl border border-dashed border-slate-200">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-brand-600 flex items-center justify-center text-2xl mx-auto mb-3">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-800 mb-1">Belum Ada Jadwal Dokter</h4>
                    <p class="text-xs text-slate-500 max-w-md mx-auto">Saat ini belum ada jadwal praktik dokter yang terdaftar pada poli ini. Silakan hubungi Customer Care kami untuk informasi lebih lanjut.</p>
                </div>
            </div>

            <!-- Pagination Dots (Hanya Dots dan Panah Saja) -->
            <div id="doctorSliderDots" class="flex items-center justify-center gap-2 mt-8"></div>
        </div>
    </section>

        <!-- 5. FACILITIES SECTION: Mengutamakan Keamanan & Kenyamanan Anda -->
    <section id="fasilitas" class="py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-extrabold uppercase tracking-widest font-heading">
                    Fasilitas Rumah Sakit
                </span>
                <h2 class="text-3xl sm:text-4xl font-black font-heading text-slate-900 tracking-tight">
                    Mengutamakan Keamanan &amp; Kenyamanan Anda
                </h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Lingkungan rumah sakit yang dirancang hangat dan ramah anak demi ketenangan Anda dan buah hati tercinta.
                </p>
            </div>

            <!-- Facilities 3 Cards with AOS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($facilities as $fac)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg shadow-slate-900/5 border border-slate-100 hover-lift transition group duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 + 100 }}">
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                            <img src="{{ $fac->photo_url }}" alt="{{ $fac->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-out">
                            @if($fac->badge)
                                <div class="absolute top-4 left-4 bg-brand-dark/85 backdrop-blur-sm text-white px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase shadow-sm">
                                    {{ $fac->badge }}
                                </div>
                            @endif
                        </div>
                        <div class="p-6 space-y-2">
                            <h3 class="text-lg font-bold font-heading text-slate-800 group-hover:text-brand-600 transition">{{ $fac->title }}</h3>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal">{{ $fac->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

            <!-- 5.5 PARTNER & ASURANSI REKANAN SECTION (Step-by-Step Auto Slider) -->
    <section id="partner" class="py-16 lg:py-24 bg-[#f8fbf9] border-y border-emerald-100/60 relative overflow-hidden">
        <!-- Background Ambient Glow -->
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[700px] h-[300px] bg-emerald-100/40 blur-3xl pointer-events-none rounded-full"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-14 space-y-3" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-extrabold uppercase tracking-widest font-heading">
                    <i class="fa-solid fa-handshake-angle text-brand-600"></i>
                    <span>Partner &amp; Asuransi Rekanan</span>
                </span>
                <h2 class="text-3xl sm:text-4xl font-black font-heading text-slate-900 tracking-tight">
                    Bekerjasama dengan Asuransi &amp; Mitra Terpercaya
                </h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    RSIA Restu Bunda telah bermitra resmi dengan BPJS Kesehatan, asuransi swasta nasional, institusi BUMN, dan perusahaan terkemuka untuk kenyamanan fasilitas klaim serta layanan kesehatan prima bagi Anda dan keluarga.
                </p>
            </div>
        </div>

        <!-- Step-by-Step Slider Carousel (Geser -> Berhenti -> Geser -> Berhenti) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="relative group/partner-carousel">
                <!-- Left & Right Gradient Mask for Smooth Fade Effect -->
                <div class="pointer-events-none absolute inset-y-0 left-0 w-8 sm:w-16 bg-gradient-to-r from-[#f8fbf9] to-transparent z-10"></div>
                <div class="pointer-events-none absolute inset-y-0 right-0 w-8 sm:w-16 bg-gradient-to-l from-[#f8fbf9] to-transparent z-10"></div>

                <!-- Navigation Arrow Buttons (Prev / Next) -->
                <button id="partnerPrevBtn" type="button" aria-label="Partner Sebelumnya" class="absolute -left-2 sm:-left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white shadow-md border border-slate-200 text-slate-700 hover:text-emerald-700 hover:border-emerald-300 hover:shadow-lg flex items-center justify-center transition-all duration-200 active:scale-95 group-hover/partner-carousel:opacity-100 sm:opacity-90">
                    <i class="fa-solid fa-chevron-left text-sm"></i>
                </button>
                <button id="partnerNextBtn" type="button" aria-label="Partner Selanjutnya" class="absolute -right-2 sm:-right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white shadow-md border border-slate-200 text-slate-700 hover:text-emerald-700 hover:border-emerald-300 hover:shadow-lg flex items-center justify-center transition-all duration-200 active:scale-95 group-hover/partner-carousel:opacity-100 sm:opacity-90">
                    <i class="fa-solid fa-chevron-right text-sm"></i>
                </button>

                <!-- Carousel Viewport -->
                <div id="partnerCarouselViewport" class="overflow-hidden py-3">
                    <div id="partnerSliderTrack" class="flex items-center gap-4 sm:gap-6 will-change-transform">
                        @php
                            $partners = [
                                ['name' => 'BPJS Kesehatan', 'file' => 'bpjs-kesehatan.png'],
                                ['name' => 'BNI Life', 'file' => 'bni-life.png'],
                                ['name' => 'BRI Life', 'file' => 'bri-life.png'],
                                ['name' => 'Meditap', 'file' => 'meditap.png'],
                                ['name' => 'AdMedika', 'file' => 'admedika.png'],
                                ['name' => 'Fullerton Health Indonesia', 'file' => 'fullerton-health.png'],
                                ['name' => 'Asuransi Cakrawala Proteksi', 'file' => 'cakrawala-proteksi.png'],
                                ['name' => 'Asuransi MAG', 'file' => 'asuransi-mag.png'],
                                ['name' => 'KSK Insurance', 'file' => 'ksk-insurance.png'],
                                ['name' => 'Dipo Star Finance', 'file' => 'dipo-star-finance.png'],
                                ['name' => 'Hanwha Life', 'file' => 'hanwha-life.png'],
                                ['name' => 'Global Excel', 'file' => 'global-excel.png'],
                                ['name' => 'Lippo Insurance', 'file' => 'lippo-insurance.png'],
                                ['name' => 'PT Migas Mandiri Pratama', 'file' => 'migas-mandiri-pratama.png'],
                                ['name' => 'PT Medilink Digital Medika', 'file' => 'medilink.png'],
                                ['name' => 'CAR Life Insurance', 'file' => 'car-life.png'],
                                ['name' => 'Kereta Api Indonesia (KAI)', 'file' => 'kai.png'],
                                ['name' => 'BSI Insurance', 'file' => 'bsi-insurance.png'],
                                ['name' => 'PT Riung Mitra Lestari', 'file' => 'riung-mitra-lestari.png'],
                            ];
                        @endphp

                        @foreach($partners as $p)
                            <div class="partner-card flex items-center justify-center bg-white px-5 sm:px-6 py-3.5 sm:py-4 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-emerald-300 hover:scale-105 transition-all duration-300 shrink-0 h-20 sm:h-24 w-44 sm:w-52 group cursor-pointer select-none" title="{{ $p['name'] }}">
                                <img src="{{ asset('images/partners/' . $p['file']) }}" alt="{{ $p['name'] }}" loading="lazy" class="max-h-10 sm:max-h-12 max-w-[130px] sm:max-w-[160px] object-contain transition-transform duration-300 group-hover:scale-105 pointer-events-none">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Info Banner Under Slider -->
        <!-- <div class="max-w-4xl mx-auto px-4 mt-8 sm:mt-10 text-center" data-aos="fade-up" data-aos-delay="150">
            <div class="inline-flex flex-col sm:flex-row items-center gap-2 sm:gap-4 px-6 py-3.5 rounded-2xl bg-white shadow-sm border border-slate-200/80 text-xs text-slate-600">
                <div class="flex items-center gap-2 font-bold text-emerald-800">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                    <span>Klaim Non-Tunai (Cashless) Didukung</span>
                </div>
                <span class="hidden sm:inline text-slate-300">•</span>
                <span>Tersedia bantuan administrasi asuransi 24 jam di loket rawat inap &amp; IGD.</span>
                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6281172345678' }}?text=Halo%20RSIA%20Restu%20Bunda,%20saya%20ingin%20menanyakan%20informasi%20klaim%20asuransi%20/BPJS" target="_blank" class="font-extrabold text-emerald-700 hover:text-emerald-800 hover:underline inline-flex items-center gap-1">
                    <span>Tanya CS Asuransi</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div> -->
    </section>

    <!-- Partner Slider Script (Geser - Berhenti - Geser - Berhenti) -->
    <script>
        (function() {
            function initPartnerSlider() {
                const track = document.getElementById('partnerSliderTrack');
                const viewport = document.getElementById('partnerCarouselViewport');
                const prevBtn = document.getElementById('partnerPrevBtn');
                const nextBtn = document.getElementById('partnerNextBtn');
                if (!track || !viewport) return;

                let isTransitioning = false;
                let autoSlideTimer = null;
                let safetyTimeout = null;
                const PAUSE_DURATION = 2600; // Berhenti / jeda diam 2.6 detik sebelum geser berikutnya
                const ANIMATION_DURATION = 550; // Waktu geser halus 0.55 detik

                function getStep() {
                    const firstCard = track.children[0];
                    if (!firstCard) return 200;
                    const style = window.getComputedStyle(track);
                    const gap = parseFloat(style.gap) || 16;
                    return firstCard.offsetWidth + gap;
                }

                function slideNext() {
                    if (isTransitioning || track.children.length < 2) return;
                    isTransitioning = true;
                    const step = getStep();

                    track.style.transition = `transform ${ANIMATION_DURATION}ms cubic-bezier(0.25, 1, 0.5, 1)`;
                    track.style.transform = `translateX(-${step}px)`;

                    function onNextEnd() {
                        track.removeEventListener('transitionend', onNextEnd);
                        if (safetyTimeout) clearTimeout(safetyTimeout);
                        track.appendChild(track.firstElementChild);
                        track.style.transition = 'none';
                        track.style.transform = 'translateX(0)';
                        void track.offsetWidth; // Force DOM reflow
                        isTransitioning = false;
                    }

                    track.addEventListener('transitionend', onNextEnd);
                    safetyTimeout = setTimeout(onNextEnd, ANIMATION_DURATION + 100);
                }

                function slidePrev() {
                    if (isTransitioning || track.children.length < 2) return;
                    isTransitioning = true;
                    const step = getStep();

                    // Pindahkan item terakhir ke paling depan dulu sebelum animasi
                    track.prepend(track.lastElementChild);
                    track.style.transition = 'none';
                    track.style.transform = `translateX(-${step}px)`;
                    void track.offsetWidth; // Force DOM reflow

                    // Geser halus ke posisi normal (0)
                    track.style.transition = `transform ${ANIMATION_DURATION}ms cubic-bezier(0.25, 1, 0.5, 1)`;
                    track.style.transform = 'translateX(0)';

                    function onPrevEnd() {
                        track.removeEventListener('transitionend', onPrevEnd);
                        if (safetyTimeout) clearTimeout(safetyTimeout);
                        isTransitioning = false;
                    }

                    track.addEventListener('transitionend', onPrevEnd);
                    safetyTimeout = setTimeout(onPrevEnd, ANIMATION_DURATION + 100);
                }

                function startAutoSlide() {
                    stopAutoSlide();
                    autoSlideTimer = setInterval(slideNext, PAUSE_DURATION);
                }

                function stopAutoSlide() {
                    if (autoSlideTimer) {
                        clearInterval(autoSlideTimer);
                        autoSlideTimer = null;
                    }
                }

                // Tombol Next & Prev
                if (nextBtn) {
                    nextBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        stopAutoSlide();
                        slideNext();
                        startAutoSlide();
                    });
                }
                if (prevBtn) {
                    prevBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        stopAutoSlide();
                        slidePrev();
                        startAutoSlide();
                    });
                }

                // Pause saat mouse diarahkan ke carousel
                viewport.addEventListener('mouseenter', stopAutoSlide);
                viewport.addEventListener('mouseleave', startAutoSlide);

                // Touch / Swipe support di layar sentuh (mobile / tablet)
                let touchStartX = 0;
                viewport.addEventListener('touchstart', function(e) {
                    stopAutoSlide();
                    touchStartX = e.touches[0].clientX;
                }, { passive: true });

                viewport.addEventListener('touchend', function(e) {
                    const touchEndX = e.changedTouches[0].clientX;
                    const diff = touchStartX - touchEndX;
                    if (diff > 40) {
                        slideNext();
                    } else if (diff < -40) {
                        slidePrev();
                    }
                    startAutoSlide();
                }, { passive: true });

                // Jeda otomatis jika tab browser sedang tidak aktif/backgrounded
                document.addEventListener('visibilitychange', function() {
                    if (document.hidden) {
                        stopAutoSlide();
                    } else {
                        startAutoSlide();
                    }
                });

                // Jalankan auto slide otomatis (Geser -> Berhenti -> Geser -> Berhenti)
                startAutoSlide();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initPartnerSlider);
            } else {
                initPartnerSlider();
            }
        })();
    </script>

    <!-- 6. TESTIMONIALS SECTION: Kasih yang Dirasakan Keluarga -->
    <section class="py-20 lg:py-28 bg-[#eaf7f0] relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1 rounded-full bg-emerald-200/80 text-emerald-900 text-xs font-extrabold uppercase tracking-widest font-heading">
                    Testimoni Pasien
                </span>
                <h2 class="text-3xl sm:text-4xl font-black font-heading text-slate-900 tracking-tight">
                    Kasih yang Dirasakan Keluarga
                </h2>
            </div>

            <!-- 2 Big Testimonial Cards with AOS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach($testimonials as $testi)
                    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl shadow-emerald-900/5 border border-emerald-100 flex flex-col justify-between hover-lift transition duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 + 100 }}">
                        <div class="space-y-4">
                            <!-- Star ratings -->
                            <div class="flex items-center text-amber-400 text-sm gap-1">
                                @for($i = 0; $i < $testi->rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>
                            <!-- Comment -->
                            <p class="text-sm text-slate-700 italic leading-relaxed">
                                "{{ $testi->content }}"
                            </p>
                        </div>

                        <!-- Author Avatar & Name -->
                        <div class="flex items-center gap-4 pt-6 border-t border-slate-100 mt-6">
                            <img src="{{ $testi->avatar_url }}" alt="{{ $testi->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-emerald-200 shadow-sm">
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 font-heading">{{ $testi->name }}</h4>
                                <span class="text-xs text-slate-500">{{ $testi->patient_info }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 7. ARTICLES SECTION: Panduan Sehat Ibu & Anak Terbaru -->
    <section id="artikel" class="py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6" data-aos="fade-up">
                <div class="space-y-3 max-w-2xl">
                    <span class="inline-block px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-extrabold uppercase tracking-widest font-heading">
                        Panduan Sehat Ibu & Anak Terbaru
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black font-heading text-slate-900 tracking-tight">
                        Artikel & Edukasi Kesehatan
                    </h2>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                        Tips dan wawasan medis terpercaya dari para dokter spesialis kami untuk mendukung pola asuh dan kesehatan keluarga Anda.
                    </p>
                </div>
            </div>

            <!-- Articles 3 Cards with AOS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($articles as $art)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg shadow-slate-900/5 border border-slate-100 flex flex-col justify-between hover-lift transition group duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 120 + 100 }}">
                        <div>
                            <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                                <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-out">
                                <div class="absolute top-4 left-4 bg-brand-600 text-white px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">
                                    {{ $art->category }}
                                </div>
                            </div>

                            <div class="p-6 space-y-3">
                                <div class="text-[11px] text-slate-400 font-semibold flex items-center gap-2">
                                    <i class="fa-regular fa-calendar"></i>
                                    <span>{{ $art->published_at ? $art->published_at->format('d M Y') : 'Terbaru' }}</span>
                                    <span>&bull;</span>
                                    <span>{{ $art->author }}</span>
                                </div>
                                <h3 class="text-base font-bold font-heading text-slate-900 group-hover:text-brand-600 transition leading-snug">
                                    <a href="{{ route('article.detail', $art->slug) }}">{{ $art->title }}</a>
                                </h3>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    {{ $art->excerpt }}
                                </p>
                            </div>
                        </div>

                        <div class="p-6 pt-0">
                            <a href="{{ route('article.detail', $art->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-600 hover:text-brand-800 group">
                                <span>Baca Selengkapnya</span>
                                <i class="fa-solid fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 8. LOCATION & CONTACT SECTION: Kunjungi Kami di Bandar Lampung -->
    <section id="kontak" class="py-20 lg:py-28 bg-[#f8fbf9] border-t border-emerald-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left: Info & Contacts -->
                <div class="lg:col-span-5 space-y-6" data-aos="fade-right">
                    <span class="inline-block px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-extrabold uppercase tracking-widest font-heading">
                        Lokasi &amp; Kontak
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black font-heading text-slate-900 tracking-tight leading-tight">
                        Kunjungi Kami di Bandar Lampung
                    </h2>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Rumah sakit kami berlokasi strategis di pusat kota Bandar Lampung, mudah dijangkau dari berbagai penjuru dengan fasilitas parkir luas dan aman.
                    </p>

                    <div class="space-y-4 pt-2">
                        <!-- Item 1: Address -->
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover-lift-sm transition">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-brand-700 flex items-center justify-center font-bold text-lg shrink-0">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Alamat Lengkap</h4>
                                <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">
                                    <a href="https://maps.app.goo.gl/Z6K36BDqhQd7cBgd9" target="_blank" class="hover:text-emerald-700 transition">
                                        {{ $settings['address'] ?? 'Jl. Kh. Hasyim Ashari No.73, Gedong Pakuon, Kec. Telukbetung Selatan, Kota Bandar Lampung, Lampung 35221' }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <!-- Item 2: Emergency Call Center -->
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover-lift-sm transition">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-brand-700 flex items-center justify-center font-bold text-lg shrink-0">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Panggilan Darurat &amp; Layanan Pelanggan</h4>
                                <p class="text-xs text-slate-600 mt-0.5 leading-relaxed font-semibold">
                                    Darurat: {{ $settings['phone_emergency'] ?? '0811-7234-5678' }} | Telp: {{ $settings['phone_callcenter'] ?? '(0721) 484185' }}
                                </p>
                            </div>
                        </div>

                        <!-- Item 3: Operational Hours -->
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover-lift-sm transition">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-brand-700 flex items-center justify-center font-bold text-lg shrink-0">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Jam Pelayanan Medis</h4>
                                <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">
                                    {{ $settings['operating_hours'] ?? 'Poliklinik: Senin - Sabtu: 08.00 - 21.00 WIB | IGD: 24 Jam' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Embed Google Maps -->
                <div class="lg:col-span-7" data-aos="fade-left" data-aos-delay="200">
                    <div class="bg-white rounded-3xl p-3 shadow-2xl shadow-emerald-900/10 border-4 border-white overflow-hidden relative group hover-lift transition">
                        <div class="rounded-2xl overflow-hidden aspect-[16/11] relative bg-slate-100">
                            <iframe 
                                src="https://maps.google.com/maps?q=-5.4476421,105.2561884+(RSIA%20Restu%20Bunda)&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" 
                                class="w-full h-full border-0 min-h-[340px]" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Peta Lokasi RSIA Restu Bunda">
                            </iframe>
                            <div class="absolute bottom-3 right-3 z-10">
                                <a href="https://maps.app.goo.gl/Z6K36BDqhQd7cBgd9" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 hover:bg-white text-slate-800 text-xs font-bold shadow-lg border border-slate-200 backdrop-blur-sm transition transform hover:scale-105">
                                    <i class="fa-solid fa-diamond-turn-right text-emerald-600"></i>
                                    <span>Petunjuk Arah (Buka Maps)</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. Quick Booking Modal for Doctor Card Clicks -->
    <div id="bookingModal" onclick="if(event.target === this) closeBookingModal()" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm cursor-pointer">
        <div onclick="event.stopPropagation()" class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-emerald-100 relative animate-fade-in cursor-default">
            <button onclick="closeBookingModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
            
            <div class="mb-5">
                <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-[11px] font-bold rounded-full uppercase tracking-wider mb-1">Pendaftaran Konsultasi</span>
                <h3 class="text-2xl font-bold font-heading text-slate-800">Pilih Jadwal Janji Temu</h3>
                <p class="text-xs text-slate-500">Lengkapi data pasien untuk memesan jadwal dokter pilihan Anda.</p>
            </div>

            <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Dokter Spesialis</label>
                        <select id="modal_doctor_id" name="doctor_id" class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 text-xs font-semibold text-slate-800 border focus:border-brand-500 focus:bg-white focus:outline-none">
                            <option value="">Pilih Dokter</option>
                            @foreach($doctors as $doc)
                                <option value="{{ $doc->id }}">{{ $doc->name }} ({{ $doc->specialty }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Kunjungan</label>
                            <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 text-xs font-semibold text-slate-800 border focus:border-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Sesi Waktu</label>
                            <select name="appointment_time" class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 text-xs font-semibold text-slate-800 border focus:border-brand-500 focus:bg-white focus:outline-none">
                                <option value="Pagi (08:00 - 12:00)">Pagi (08:00 - 12:00)</option>
                                <option value="Siang (13:00 - 16:00)">Siang (13:00 - 16:00)</option>
                                <option value="Sore/Malam (16:00 - 20:00)">Sore/Malam (16:00 - 20:00)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Pasien / Anak</label>
                        <input type="text" name="patient_name" placeholder="Nama lengkap pasien" required class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 text-xs font-semibold text-slate-800 border focus:border-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Orang Tua / Wali</label>
                            <input type="text" name="parent_name" placeholder="Nama ibu / ayah" class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 text-xs font-semibold text-slate-800 border focus:border-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">No. WhatsApp Aktif</label>
                            <input type="tel" name="phone" placeholder="08xxxxxxxxxx" required class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 text-xs font-semibold text-slate-800 border focus:border-brand-500 focus:bg-white focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Keluhan / Catatan Medis Singkat</label>
                        <textarea name="complaint" rows="2" placeholder="Tuliskan keluhan atau tujuan kontrol (misal: vaksinasi booster, USG 4D, flu & batuk)..." class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 text-xs font-semibold text-slate-800 border focus:border-brand-500 focus:bg-white focus:outline-none"></textarea>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-sm shadow-lg shadow-brand-600/30 transition active:scale-[0.99] flex items-center justify-center gap-2">
                        <span>Konfirmasi Booking Janji</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // 1. Number Counter Animation on Scroll
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.stat-counter');
        let animated = false;

        const animateCounters = () => {
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 1500;
                const step = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, 16);
            });
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !animated) {
                    animated = true;
                    animateCounters();
                }
            });
        }, { threshold: 0.3 });

        const statsSection = document.querySelector('.stat-counter')?.closest('section');
        if (statsSection) {
            observer.observe(statsSection);
        }
    });

        // 2. Continuous Doctor Slider & Filter Controller (Kaya Partner: Infinite Continuous Flow)
    let doctorAutoTimer = null;
    let isDoctorTransitioning = false;
    let doctorSafetyTimeout = null;
    let totalUniqueDoctors = {{ count($doctors) }};
    const DOCTOR_PAUSE = 4500; // 4.5 detik berhenti sebelum geser berikutnya
    const DOCTOR_SPEED = 550;  // 0.55 detik geser halus

    function getDoctorStep() {
        const track = document.getElementById('doctorSliderTrack');
        if (!track) return 320;
        const visibleCard = track.querySelector('.doctor-card:not([style*="display: none"])');
        if (!visibleCard) return 320;
        const gap = parseFloat(window.getComputedStyle(track).gap) || 24;
        return visibleCard.offsetWidth + gap;
    }

    function slideDoctorNext() {
        const track = document.getElementById('doctorSliderTrack');
        if (!track || isDoctorTransitioning) return;

        const visibleCards = track.querySelectorAll('.doctor-card:not([style*="display: none"])');
        if (visibleCards.length <= 1) return;

        isDoctorTransitioning = true;
        const step = getDoctorStep();

        track.style.transition = `transform ${DOCTOR_SPEED}ms cubic-bezier(0.25, 1, 0.5, 1)`;
        track.style.transform = `translateX(-${step}px)`;

        function onNextEnd() {
            track.removeEventListener('transitionend', onNextEnd);
            if (doctorSafetyTimeout) clearTimeout(doctorSafetyTimeout);

            // Pindahkan kartu pertama yang keluar ke bagian paling belakang (continuous infinite loop)
            track.appendChild(track.firstElementChild);
            track.style.transition = 'none';
            track.style.transform = 'translateX(0)';
            void track.offsetWidth; // Force DOM reflow

            isDoctorTransitioning = false;
            updateDoctorDots();
        }

        track.addEventListener('transitionend', onNextEnd);
        doctorSafetyTimeout = setTimeout(onNextEnd, DOCTOR_SPEED + 100);
    }

    function slideDoctorPrev() {
        const track = document.getElementById('doctorSliderTrack');
        if (!track || isDoctorTransitioning) return;

        const visibleCards = track.querySelectorAll('.doctor-card:not([style*="display: none"])');
        if (visibleCards.length <= 1) return;

        isDoctorTransitioning = true;
        const step = getDoctorStep();

        // Pindahkan kartu terakhir ke bagian paling depan sebelum transisi
        track.prepend(track.lastElementChild);
        track.style.transition = 'none';
        track.style.transform = `translateX(-${step}px)`;
        void track.offsetWidth; // Force DOM reflow

        track.style.transition = `transform ${DOCTOR_SPEED}ms cubic-bezier(0.25, 1, 0.5, 1)`;
        track.style.transform = 'translateX(0)';

        function onPrevEnd() {
            track.removeEventListener('transitionend', onPrevEnd);
            if (doctorSafetyTimeout) clearTimeout(doctorSafetyTimeout);
            isDoctorTransitioning = false;
            updateDoctorDots();
        }

        track.addEventListener('transitionend', onPrevEnd);
        doctorSafetyTimeout = setTimeout(onPrevEnd, DOCTOR_SPEED + 100);
    }

    function updateDoctorDots() {
        const track = document.getElementById('doctorSliderTrack');
        const dotsContainer = document.getElementById('doctorSliderDots');
        if (!track || !dotsContainer) return;

        const firstCard = track.querySelector('.doctor-card:not([style*="display: none"])');
        if (!firstCard) return;

        const activeIndex = parseInt(firstCard.getAttribute('data-doctor-index')) || 0;
        const dots = dotsContainer.querySelectorAll('.doctor-dot-btn');
        dots.forEach(dot => {
            const dotIdx = parseInt(dot.getAttribute('data-dot-index'));
            if (dotIdx === activeIndex) {
                dot.className = 'doctor-dot-btn transition-all duration-300 rounded-full h-2.5 w-8 bg-brand-600 shadow-sm cursor-pointer';
            } else {
                dot.className = 'doctor-dot-btn transition-all duration-300 rounded-full h-2.5 w-2.5 bg-slate-300 hover:bg-slate-400 cursor-pointer';
            }
        });
    }

    function initDoctorDots(count) {
        const dotsContainer = document.getElementById('doctorSliderDots');
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        if (count <= 1) return;

        for (let i = 0; i < count; i++) {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.setAttribute('data-dot-index', i);
            dot.setAttribute('aria-label', `Lihat Dokter ${i + 1}`);
            dot.className = i === 0 
                ? 'doctor-dot-btn transition-all duration-300 rounded-full h-2.5 w-8 bg-brand-600 shadow-sm cursor-pointer'
                : 'doctor-dot-btn transition-all duration-300 rounded-full h-2.5 w-2.5 bg-slate-300 hover:bg-slate-400 cursor-pointer';
            
            dot.onclick = () => {
                goToDoctorIndex(i);
            };
            dotsContainer.appendChild(dot);
        }
    }

    function goToDoctorIndex(targetIndex) {
        const track = document.getElementById('doctorSliderTrack');
        if (!track || isDoctorTransitioning) return;
        const firstCard = track.querySelector('.doctor-card:not([style*="display: none"])');
        if (!firstCard) return;
        const currentIndex = parseInt(firstCard.getAttribute('data-doctor-index')) || 0;
        if (targetIndex === currentIndex) return;

        stopDoctorAuto();
        slideDoctorNext();
        startDoctorAuto();
    }

    function startDoctorAuto() {
        stopDoctorAuto();
        doctorAutoTimer = setInterval(slideDoctorNext, DOCTOR_PAUSE);
    }

    function stopDoctorAuto() {
        if (doctorAutoTimer) {
            clearInterval(doctorAutoTimer);
            doctorAutoTimer = null;
        }
    }

    function filterDoctorCategory(category, buttonEl) {
        document.querySelectorAll('.doctor-filter-btn').forEach(btn => {
            btn.classList.remove('bg-brand-600', 'text-white', 'shadow-sm');
            btn.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
        });
        buttonEl.classList.add('bg-brand-600', 'text-white', 'shadow-sm');
        buttonEl.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');

        const track = document.getElementById('doctorSliderTrack');
        const emptyState = document.getElementById('doctorEmptyState');
        const dotsContainer = document.getElementById('doctorSliderDots');
        const prevBtn = document.getElementById('doctorPrevSideBtn');
        const nextBtn = document.getElementById('doctorNextSideBtn');
        if (!track) return;

        const cards = track.querySelectorAll('.doctor-card');
        let visibleCount = 0;
        let uniqueIndices = new Set();

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (category === 'all' || cardCat === category) {
                card.style.display = 'flex';
                visibleCount++;
                uniqueIndices.add(card.getAttribute('data-doctor-index'));
            } else {
                card.style.display = 'none';
            }
        });

        // Reset transform
        track.style.transition = 'none';
        track.style.transform = 'translateX(0)';

        if (visibleCount === 0) {
            if (emptyState) emptyState.classList.remove('hidden');
            if (dotsContainer) dotsContainer.innerHTML = '';
            if (prevBtn) prevBtn.style.display = 'none';
            if (nextBtn) nextBtn.style.display = 'none';
            stopDoctorAuto();
        } else {
            if (emptyState) emptyState.classList.add('hidden');
            if (prevBtn) prevBtn.style.display = 'flex';
            if (nextBtn) nextBtn.style.display = 'flex';
            initDoctorDots(uniqueIndices.size);
            updateDoctorDots();
            startDoctorAuto();
        }
    }

    function initDoctorSlider() {
        const viewport = document.getElementById('doctorSliderViewport');
        const prevBtn = document.getElementById('doctorPrevSideBtn');
        const nextBtn = document.getElementById('doctorNextSideBtn');
        if (!viewport) return;

        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                stopDoctorAuto();
                slideDoctorPrev();
                startDoctorAuto();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                stopDoctorAuto();
                slideDoctorNext();
                startDoctorAuto();
            });
        }

        // Pause on hover
        viewport.addEventListener('mouseenter', stopDoctorAuto);
        viewport.addEventListener('mouseleave', startDoctorAuto);

        // Touch Swipe on mobile
        let touchStartX = 0;
        viewport.addEventListener('touchstart', (e) => {
            stopDoctorAuto();
            touchStartX = e.touches[0].clientX;
        }, { passive: true });

        viewport.addEventListener('touchend', (e) => {
            const touchEndX = e.changedTouches[0].clientX;
            const diff = touchStartX - touchEndX;
            if (diff > 40) {
                slideDoctorNext();
            } else if (diff < -40) {
                slideDoctorPrev();
            }
            startDoctorAuto();
        }, { passive: true });

        // Visibility Change
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) stopDoctorAuto();
            else startDoctorAuto();
        });

        initDoctorDots(totalUniqueDoctors);
        updateDoctorDots();
        startDoctorAuto();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDoctorSlider);
    } else {
        initDoctorSlider();
    }
</script>
@endpush
