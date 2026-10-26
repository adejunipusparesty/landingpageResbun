<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RSIA Restu Bunda - Rumah Sakit Ibu & Anak Pilihan di Bandar Lampung')</title>
    <meta name="description" content="RSIA Restu Bunda - Pelayanan medis terbaik dan penuh kasih untuk ibu, bayi, dan anak tercinta sejak kehamilan hingga tumbuh kembang. Bandar Lampung.">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            dark: '#064e3b',
                            darker: '#022c22',
                        },
                        mint: {
                            50: '#f2fbf6',
                            100: '#e6f7ef',
                            200: '#ccf0de',
                            300: '#a6e3c6',
                        }
                    },
                    fontFamily: {
                        heading: ['Outfit', 'sans-serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- AOS (Animate On Scroll) Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            overflow-x: clip;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
        .hero-arch {
            border-radius: 40px 140px 40px 40px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.7);
        }
        .dropdown-glass {
            background-color: rgba(255, 255, 255, 0.96) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(226, 232, 240, 0.9) !important;
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.9) inset !important;
        }
        .mint-card {
            background-color: #eaf7f0;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .mint-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 30px -8px rgba(16, 185, 129, 0.2);
            background-color: #e2f4ea;
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(1.5deg); }
        }
        @keyframes floatReverse {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(10px) rotate(-1.5deg); }
        }
        @keyframes subtlePulse {
            0%, 100% { transform: scale(1); opacity: 0.95; }
            50% { transform: scale(1.05); opacity: 1; }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.45); }
            50% { box-shadow: 0 0 0 14px rgba(16, 185, 129, 0); }
        }
        .animate-float-slow {
            animation: floatSlow 6s ease-in-out infinite;
        }
        .animate-float-reverse {
            animation: floatReverse 7s ease-in-out infinite;
        }
        .animate-float {
            animation: floatSlow 4s ease-in-out infinite;
        }
        .pulse-glow {
            animation: pulseGlow 2.5s infinite;
        }
        .hover-lift {
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease, border-color 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px -10px rgba(16, 185, 129, 0.18);
        }
        .hover-lift-sm {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .hover-lift-sm:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(16, 185, 129, 0.12);
        }
        /* Partner Step Slider & Modal Utilities */
    </style>
</head>
<body class="bg-[#fafdfb] antialiased text-slate-800">

    <!-- Top Emergency & Info Bar (Manageable in Admin) -->
    @if(($globalSettings['topbar_enabled'] ?? '1') == '1')
    <div class="bg-brand-dark text-white text-xs py-2 px-4 border-b border-emerald-900/50">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-4">
                <span>
                    <i class="fa-solid fa-location-dot text-emerald-400 mr-1.5"></i>
                    <a href="{{ $globalSettings['topbar_address_url'] ?? 'https://maps.app.goo.gl/Z6K36BDqhQd7cBgd9' }}" target="_blank" class="hover:text-white transition">
                        {{ $globalSettings['topbar_address'] ?? 'Jl. Kh. Hasyim Ashari No.73, Gedong Pakuon, Kec. Telukbetung Selatan, Kota Bandar Lampung, Lampung 35221' }}
                    </a>
                </span>
                <span class="hidden md:inline text-emerald-600">&bull;</span>
                <span class="hidden md:inline">
                    <i class="fa-solid fa-clock text-emerald-400 mr-1.5"></i> 
                    {{ $globalSettings['topbar_service_hours'] ?? 'Pelayanan IGD & Bersalin 24 Jam Nonstop' }}
                </span>
            </div>
            <div class="flex items-center gap-4">
                @if(($globalSettings['topbar_show_booking_link'] ?? '1') == '1')
                    <a href="{{ route('booking.check') }}" class="text-emerald-200 hover:text-white transition flex items-center gap-1 font-medium">
                        <i class="fa-solid fa-magnifying-glass"></i> Cek Status Janji Temu
                    </a>
                @endif
                @if(($globalSettings['topbar_show_admin_link'] ?? '0') == '1')
                    <span class="text-emerald-600">&bull;</span>
                    <a href="{{ route('login') }}" class="text-emerald-300 hover:text-white transition font-semibold flex items-center gap-1">
                        <i class="fa-solid fa-lock"></i> Portal Admin
                    </a>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Main Navigation Bar (Static at top, doesn't bounce/jump on scroll) -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-sm transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo & Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group py-1">
                    <img src="{{ asset('images/logo.png') }}" alt="RSIA Restu Bunda" class="h-12 sm:h-14 w-auto object-contain group-hover:scale-105 transition duration-200">
                </a>

                <!-- Desktop Navigation Links (Grouped with Modern Dropdowns) -->
                <nav class="hidden lg:flex items-center space-x-6 xl:space-x-8 text-sm font-semibold text-slate-600">
                    <a href="{{ route('home') }}#beranda" class="hover:text-brand-600 transition py-2 {{ request()->routeIs('home') && !request()->routeIs('about') && !request()->routeIs('gallery') ? 'text-brand-600' : '' }}">
                        Beranda
                    </a>

                    <!-- Dropdown: Profil RSIA -->
                    <div class="relative group py-2">
                        <button type="button" class="flex items-center gap-1.5 hover:text-brand-600 transition focus:outline-none {{ (request()->routeIs('about') || request()->routeIs('gallery')) ? 'text-brand-600 font-bold' : '' }}">
                            <span>Profil RSIA</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 group-hover:text-brand-600 group-hover:rotate-180 transition-transform duration-200"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="absolute top-full left-0 pt-2 w-72 pointer-events-none opacity-0 translate-y-1 group-hover:pointer-events-auto group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 ease-out z-50">
                            <div class="dropdown-glass rounded-2xl p-2 space-y-1">
                                <a href="{{ route('about') }}" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/70 transition group/item {{ request()->routeIs('about') ? 'bg-emerald-50/60' : '' }}">
                                    <div class="w-9 h-9 rounded-xl bg-emerald-100/70 text-brand-600 flex items-center justify-center text-sm shrink-0 group-hover/item:bg-brand-600 group-hover/item:text-white transition duration-200">
                                        <i class="fa-solid fa-hospital"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-brand-600 transition">Tentang Kami</div>
                                        <p class="text-[11px] text-slate-500 leading-tight mt-0.5">Visi, misi, moto &amp; sejarah RSIA</p>
                                    </div>
                                </a>
                                <a href="{{ route('about') }}#direksi" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/70 transition group/item">
                                    <div class="w-9 h-9 rounded-xl bg-emerald-100/70 text-brand-600 flex items-center justify-center text-sm shrink-0 group-hover/item:bg-brand-600 group-hover/item:text-white transition duration-200">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-brand-600 transition">Jajaran Direksi</div>
                                        <p class="text-[11px] text-slate-500 leading-tight mt-0.5">Dewan pimpinan &amp; manajemen</p>
                                    </div>
                                </a>
                                <a href="{{ route('gallery') }}" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/70 transition group/item {{ request()->routeIs('gallery') ? 'bg-emerald-50/60' : '' }}">
                                    <div class="w-9 h-9 rounded-xl bg-emerald-100/70 text-brand-600 flex items-center justify-center text-sm shrink-0 group-hover/item:bg-brand-600 group-hover/item:text-white transition duration-200">
                                        <i class="fa-solid fa-images"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-brand-600 transition">Galeri &amp; Suasana</div>
                                        <p class="text-[11px] text-slate-500 leading-tight mt-0.5">Foto fasilitas &amp; dokumentasi kegiatan</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown: Layanan & Medis -->
                    <div class="relative group py-2">
                        <button type="button" class="flex items-center gap-1.5 hover:text-brand-600 transition focus:outline-none">
                            <span>Layanan &amp; Medis</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 group-hover:text-brand-600 group-hover:rotate-180 transition-transform duration-200"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="absolute top-full left-0 pt-2 w-72 pointer-events-none opacity-0 translate-y-1 group-hover:pointer-events-auto group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 ease-out z-50">
                            <div class="dropdown-glass rounded-2xl p-2 space-y-1">
                                <a href="{{ route('home') }}#layanan" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/70 transition group/item">
                                    <div class="w-9 h-9 rounded-xl bg-emerald-100/70 text-brand-600 flex items-center justify-center text-sm shrink-0 group-hover/item:bg-brand-600 group-hover/item:text-white transition duration-200">
                                        <i class="fa-solid fa-stethoscope"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-brand-600 transition">Layanan Unggulan</div>
                                        <p class="text-[11px] text-slate-500 leading-tight mt-0.5">Poli spesialis ibu, anak &amp; IGD 24 jam</p>
                                    </div>
                                </a>
                                <a href="{{ route('home') }}#dokter" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/70 transition group/item">
                                    <div class="w-9 h-9 rounded-xl bg-emerald-100/70 text-brand-600 flex items-center justify-center text-sm shrink-0 group-hover/item:bg-brand-600 group-hover/item:text-white transition duration-200">
                                        <i class="fa-solid fa-user-doctor"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-brand-600 transition">Jadwal &amp; Tim Dokter</div>
                                        <p class="text-[11px] text-slate-500 leading-tight mt-0.5">Dokter spesialis kandungan &amp; anak</p>
                                    </div>
                                </a>
                                <a href="{{ route('home') }}#fasilitas" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/70 transition group/item">
                                    <div class="w-9 h-9 rounded-xl bg-emerald-100/70 text-brand-600 flex items-center justify-center text-sm shrink-0 group-hover/item:bg-brand-600 group-hover/item:text-white transition duration-200">
                                        <i class="fa-solid fa-bed-pulse"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-brand-600 transition">Fasilitas Rawat Inap</div>
                                        <p class="text-[11px] text-slate-500 leading-tight mt-0.5">Kamar rawat nyaman, lab &amp; farmasi</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('home') }}#artikel" class="hover:text-brand-600 transition py-2">Artikel</a>
                    <a href="{{ route('home') }}#kontak" class="hover:text-brand-600 transition py-2">Kontak</a>
                </nav>

                <!-- Actions: Call & Booking CTA -->
                <div class="hidden sm:flex items-center gap-4">
                    <div class="flex items-center gap-3 pr-2">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 text-brand-600 flex items-center justify-center text-base shadow-sm">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <div class="text-left leading-tight">
                            <span class="block text-[11px] font-semibold text-slate-400 uppercase tracking-wider">IGD &amp; Ambulans 24 Jam</span>
                            <a href="tel:{{ $globalSettings['phone_emergency'] ?? '081172345678' }}" class="text-sm font-extrabold text-slate-800 hover:text-brand-600 transition font-heading">
                                {{ $globalSettings['phone_emergency'] ?? '0811-7234-5678' }}
                            </a>
                        </div>
                    </div>

                    <a href="#quick-booking" class="px-5 py-2.5 rounded-full bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs uppercase tracking-wider shadow-md shadow-brand-600/25 transition active:scale-95">
                        Buat Janji Temu
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center lg:hidden">
                    <button id="mobile-menu-btn" class="p-2 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-none">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-100 bg-white px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('home') }}#beranda" class="flex items-center gap-3 py-2 text-sm font-bold text-slate-700 hover:text-brand-600">
                <span class="w-7 h-7 rounded-lg bg-emerald-50 text-brand-600 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-house"></i>
                </span>
                Beranda
            </a>

            <!-- Group 1: Profil RSIA -->
            <div class="border-t border-slate-100 pt-3">
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 px-1">Profil RSIA</span>
                <div class="mt-1 space-y-1">
                    <a href="{{ route('about') }}" class="flex items-center gap-3 py-1.5 px-2 rounded-lg text-xs font-bold text-slate-700 hover:bg-emerald-50 hover:text-brand-600 transition {{ request()->routeIs('about') ? 'text-brand-600 bg-emerald-50/50' : '' }}">
                        <i class="fa-solid fa-hospital text-brand-600 text-xs w-4 text-center"></i>
                        <span>Tentang Kami (Visi, Misi &amp; Sejarah)</span>
                    </a>
                    <a href="{{ route('about') }}#direksi" class="flex items-center gap-3 py-1.5 px-2 rounded-lg text-xs font-bold text-slate-700 hover:bg-emerald-50 hover:text-brand-600 transition">
                        <i class="fa-solid fa-user-tie text-brand-600 text-xs w-4 text-center"></i>
                        <span>Jajaran Direksi &amp; Manajemen</span>
                    </a>
                    <a href="{{ route('gallery') }}" class="flex items-center gap-3 py-1.5 px-2 rounded-lg text-xs font-bold text-slate-700 hover:bg-emerald-50 hover:text-brand-600 transition {{ request()->routeIs('gallery') ? 'text-brand-600 bg-emerald-50/50' : '' }}">
                        <i class="fa-solid fa-images text-brand-600 text-xs w-4 text-center"></i>
                        <span>Galeri &amp; Dokumentasi Foto</span>
                    </a>
                </div>
            </div>

            <!-- Group 2: Layanan & Medis -->
            <div class="border-t border-slate-100 pt-3">
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 px-1">Layanan &amp; Medis</span>
                <div class="mt-1 space-y-1">
                    <a href="{{ route('home') }}#layanan" class="flex items-center gap-3 py-1.5 px-2 rounded-lg text-xs font-bold text-slate-700 hover:bg-emerald-50 hover:text-brand-600 transition">
                        <i class="fa-solid fa-stethoscope text-brand-600 text-xs w-4 text-center"></i>
                        <span>Layanan Unggulan &amp; Poliklinik</span>
                    </a>
                    <a href="{{ route('home') }}#dokter" class="flex items-center gap-3 py-1.5 px-2 rounded-lg text-xs font-bold text-slate-700 hover:bg-emerald-50 hover:text-brand-600 transition">
                        <i class="fa-solid fa-user-doctor text-brand-600 text-xs w-4 text-center"></i>
                        <span>Jadwal &amp; Tim Dokter</span>
                    </a>
                    <a href="{{ route('home') }}#fasilitas" class="flex items-center gap-3 py-1.5 px-2 rounded-lg text-xs font-bold text-slate-700 hover:bg-emerald-50 hover:text-brand-600 transition">
                        <i class="fa-solid fa-bed-pulse text-brand-600 text-xs w-4 text-center"></i>
                        <span>Fasilitas Rawat Inap &amp; Kamar</span>
                    </a>
                </div>
            </div>

            <!-- Group 3: Artikel & Kontak -->
            <div class="border-t border-slate-100 pt-2 space-y-1">
                <a href="{{ route('home') }}#artikel" class="flex items-center gap-3 py-1.5 px-2 rounded-lg text-xs font-bold text-slate-700 hover:bg-emerald-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-newspaper text-emerald-500 text-xs w-4 text-center"></i>
                    <span>Artikel Kesehatan</span>
                </a>
                <a href="{{ route('home') }}#kontak" class="flex items-center gap-3 py-1.5 px-2 rounded-lg text-xs font-bold text-slate-700 hover:bg-emerald-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-location-dot text-emerald-500 text-xs w-4 text-center"></i>
                    <span>Lokasi &amp; Kontak</span>
                </a>
            </div>

            <!-- Actions -->
            <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                <a href="#quick-booking" class="w-full text-center py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs uppercase tracking-wider shadow-md shadow-brand-600/20 transition">
                    Buat Janji Temu Pasien
                </a>
                <a href="{{ route('booking.check') }}" class="w-full text-center py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition">
                    Cek Status Janji Temu
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-brand-dark text-slate-300 pt-16 pb-12 border-t border-emerald-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-emerald-900/60">
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="RSIA Restu Bunda" class="h-10 sm:h-12 w-auto bg-white p-1 rounded-xl">
                    </div>
                    <p class="text-xs sm:text-sm text-emerald-100/70 leading-relaxed max-w-sm">
                        {{ $globalSettings['hospital_name'] ?? 'RSIA Restu Bunda' }} berdedikasi melayani seluruh keluarga dengan fasilitas modern dan dokter spesialis anak serta kebidanan yang berpengalaman dan ramah.
                    </p>
                    <div class="flex items-center gap-3 text-emerald-300 pt-2">
                        <a href="#" class="w-9 h-9 rounded-full bg-emerald-900/70 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-emerald-900/70 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-emerald-900/70 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition"><i class="fa-brands fa-youtube"></i></a>
                        <a href="https://wa.me/{{ $globalSettings['whatsapp'] ?? '6281172345678' }}" class="w-9 h-9 rounded-full bg-emerald-900/70 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Col 2: Poliklinik -->
                <div class="space-y-3">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider font-heading">Poliklinik</h4>
                    <ul class="space-y-2 text-xs text-emerald-100/70">
                        <li><a href="#dokter" class="hover:text-white transition">Poli Anak &amp; Tumbuh Kembang</a></li>
                        <li><a href="#dokter" class="hover:text-white transition">Poli Kebidanan &amp; Kandungan</a></li>
                        <li><a href="#dokter" class="hover:text-white transition">Poli Laktasi &amp; Nutrisi Bayi</a></li>
                        <li><a href="#dokter" class="hover:text-white transition">Neonatologi &amp; NICU</a></li>
                        <li><a href="#dokter" class="hover:text-white transition">Poli Imunisasi &amp; Vaksinasi</a></li>
                    </ul>
                </div>

                <!-- Col 3: Akses Cepat -->
                <div class="space-y-3">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider font-heading">Informasi</h4>
                    <ul class="space-y-2 text-xs text-emerald-100/70">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Tentang RSIA &amp; Direksi</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-white transition">Galeri &amp; Dokumentasi</a></li>
                        <li><a href="{{ route('home') }}#fasilitas" class="hover:text-white transition">Fasilitas Rawat Inap</a></li>
                        <li><a href="{{ route('home') }}#artikel" class="hover:text-white transition">Artikel &amp; Edukasi Ibu</a></li>
                        <li><a href="{{ route('booking.check') }}" class="hover:text-white transition">Cek Status Janji Temu</a></li>
                    </ul>
                </div>

                <!-- Col 4: Kontak Cepat -->
                <div class="space-y-3">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider font-heading">Kontak &amp; IGD</h4>
                    <div class="space-y-2 text-xs text-emerald-100/70 leading-relaxed">
                        <p><i class="fa-solid fa-phone text-emerald-400 mr-2"></i> {{ $globalSettings['phone_callcenter'] ?? '(0721) 484185' }}</p>
                        <p><i class="fa-solid fa-ambulance text-rose-400 mr-2"></i> {{ $globalSettings['phone_emergency'] ?? '0811-7234-5678' }} (24 Jam)</p>
                        <p><i class="fa-solid fa-envelope text-emerald-400 mr-2"></i> {{ $globalSettings['email'] ?? 'restubunda.rsia@gmail.com' }}</p>
                        <p><i class="fa-solid fa-map-pin text-emerald-400 mr-2"></i> {{ $globalSettings['address'] ?? 'Bandar Lampung' }}</p>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-emerald-200/50 gap-4">
                <p>&copy; {{ date('Y') }} {{ $globalSettings['hospital_name'] ?? 'RSIA Restu Bunda' }}. Seluruh hak cipta dilindungi.</p>
                <p class="flex items-center gap-1">
                    <span>Dikembangkan dengan penuh dedikasi untuk keluarga sehat</span>
                </p>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Widget & Back to Top Group -->
    <div class="fixed bottom-6 right-6 z-40 flex flex-col items-end gap-3 pointer-events-auto">
        <!-- Back to Top Button -->
        <button id="backToTopBtn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="w-11 h-11 rounded-full bg-white text-slate-700 shadow-xl border border-slate-200/80 flex items-center justify-center hover:bg-emerald-50 hover:text-emerald-700 transition opacity-0 pointer-events-none transform translate-y-3 duration-300" title="Kembali ke Atas">
            <i class="fa-solid fa-arrow-up text-sm"></i>
        </button>

        <!-- Floating WhatsApp Action -->
        <a href="https://wa.me/{{ $globalSettings['whatsapp'] ?? '6281172345678' }}?text=Halo%20RSIA%20Restu%20Bunda,%20saya%20ingin%20konsultasi%20pelayanan%20medis" target="_blank" class="group relative flex items-center gap-2.5 bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white pl-4 pr-5 py-3.5 rounded-full shadow-2xl shadow-emerald-900/30 transition transform hover:scale-105 active:scale-95 duration-200">
            <span class="absolute -top-1 -right-1 flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-amber-500 text-[9px] font-black text-slate-950 items-center justify-center">1</span>
            </span>
            <i class="fa-brands fa-whatsapp text-2xl"></i>
            <div class="text-left leading-tight hidden sm:block">
                <span class="block text-[10px] text-emerald-100 font-medium">Bantuan Cepat 24 Jam</span>
                <span class="block text-xs font-black">Chat WhatsApp IGD</span>
            </div>
        </a>
    </div>

    <!-- Announcement Popup Modal -->
    @if(($globalSettings['popup_enabled'] ?? '1') == '1')
    <div id="announcementPopup" onclick="if(event.target === this) closeAnnouncementPopup()" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/70 backdrop-blur-md transition-opacity duration-300 cursor-pointer">
        <div id="announcementPopupCard" onclick="event.stopPropagation()" class="relative bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border border-emerald-100 transform transition-all duration-300 scale-90 opacity-0 cursor-default">
            <!-- Close Button -->
            <button onclick="closeAnnouncementPopup()" class="absolute top-3.5 right-3.5 z-20 w-9 h-9 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center shadow-lg transition active:scale-95" title="Tutup Pengumuman">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>

            <!-- Banner Image -->
            @php
                $popupImage = $globalSettings['popup_image'] ?? 'popup_banner.jpg';
                $popupImagePath = public_path('images/' . $popupImage);
            @endphp
            @if(file_exists($popupImagePath))
                <div class="relative aspect-[16/9] w-full overflow-hidden bg-emerald-50">
                    <img src="{{ asset('images/' . $popupImage) }}" alt="{{ $globalSettings['popup_title'] ?? 'Pengumuman RSIA Restu Bunda' }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-black/20"></div>
                    <div class="absolute bottom-3 left-4 right-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-400 text-slate-950 font-black text-[10px] uppercase tracking-wider shadow-md animate-pulse">
                            <i class="fa-solid fa-bullhorn text-xs"></i>
                            <span>{{ $globalSettings['popup_badge'] ?? 'PENGUMUMAN RESMI' }}</span>
                        </span>
                    </div>
                </div>
            @else
                <div class="bg-gradient-to-tr from-brand-800 to-emerald-600 p-6 text-white text-center relative overflow-hidden">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-2xl mx-auto mb-3 shadow-inner">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <span class="inline-block px-3 py-0.5 rounded-full bg-amber-400 text-slate-950 font-black text-[10px] uppercase tracking-wider mb-2">
                        {{ $globalSettings['popup_badge'] ?? 'PENGUMUMAN RESMI' }}
                    </span>
                    <h3 class="text-xl font-extrabold font-heading">{{ $globalSettings['popup_title'] ?? 'Pengumuman RSIA Restu Bunda' }}</h3>
                </div>
            @endif

            <!-- Body Content -->
            <div class="p-6 sm:p-7 space-y-4">
                @if(file_exists($popupImagePath))
                    <h3 class="text-lg sm:text-xl font-extrabold font-heading text-slate-900 tracking-tight leading-snug">
                        {{ $globalSettings['popup_title'] ?? 'Waspada Penipuan & Pelayanan Pendaftaran Online' }}
                    </h3>
                @endif

                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    {{ $globalSettings['popup_content'] ?? 'Pendaftaran janji temu dokter spesialis kini dapat dilakukan langsung secara online melalui website resmi RSIA Restu Bunda.' }}
                </p>

                <!-- Actions -->
                <div class="pt-2 flex flex-col sm:flex-row gap-3">
                    <a href="{{ $globalSettings['popup_btn_url'] ?? '#quick-booking' }}" onclick="closeAnnouncementPopup()" class="flex-1 py-3 px-5 rounded-2xl bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-700 hover:to-emerald-600 text-white font-extrabold text-xs uppercase tracking-wider text-center shadow-lg shadow-brand-500/25 transition active:scale-95 flex items-center justify-center gap-2">
                        <span>{{ $globalSettings['popup_btn_text'] ?? 'Buat Janji Sekarang' }}</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                    <button onclick="closeAnnouncementPopup()" class="py-3 px-5 rounded-2xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold text-xs transition">
                        Tutup
                    </button>
                </div>

                <!-- Checkbox "Jangan tampilkan lagi hari ini" -->
                <div class="pt-2 flex items-center justify-center gap-2 text-[11px] text-slate-400">
                    <input type="checkbox" id="dontShowAgainToday" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500 cursor-pointer">
                    <label for="dontShowAgainToday" class="cursor-pointer select-none hover:text-slate-600">Jangan tampilkan lagi hari ini</label>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- AOS JS CDN -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Interactive Scripts -->
    <script>
        // Init Animate On Scroll (Repeats on scroll up/down like in lahansikam)
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 750,
                    once: false,
                    mirror: true,
                    easing: 'ease-out-cubic',
                    offset: 60,
                });
            }
        });

        // Back to Top button visibility on scroll
        window.addEventListener('scroll', function() {
            const btn = document.getElementById('backToTopBtn');
            if (!btn) return;
            if (window.scrollY > 400) {
                btn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-3');
                btn.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
            } else {
                btn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-3');
                btn.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            }
        });

        // Mobile Menu
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
        document.querySelectorAll('#mobile-menu a').forEach(function(link) {
            link.addEventListener('click', function() {
                document.getElementById('mobile-menu')?.classList.add('hidden');
            });
        });

        // Doctor modal selector helper
        function selectDoctorForBooking(doctorId, doctorName, specialty) {
            const doctorSelect = document.getElementById('modal_doctor_id');
            if (doctorSelect) {
                doctorSelect.value = doctorId;
            }
            const modal = document.getElementById('bookingModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeBookingModal() {
            const modal = document.getElementById('bookingModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        // Announcement Popup Controller
        window.addEventListener('load', function() {
            const popup = document.getElementById('announcementPopup');
            const card = document.getElementById('announcementPopupCard');
            if (!popup || !card) return;

            // Check if user has chosen "Don't show again today"
            const today = new Date().toISOString().split('T')[0];
            const storedDate = localStorage.getItem('rsia_announcement_hidden_date');
            if (storedDate === today) {
                return; // Skipped for today
            }

            // Show after gentle 600ms delay with bounce animation
            setTimeout(function() {
                popup.classList.remove('hidden');
                popup.classList.add('flex');
                setTimeout(function() {
                    card.classList.remove('scale-90', 'opacity-0');
                    card.classList.add('scale-100', 'opacity-100');
                }, 50);
            }, 600);
        });

        function closeAnnouncementPopup() {
            const popup = document.getElementById('announcementPopup');
            const card = document.getElementById('announcementPopupCard');
            const checkbox = document.getElementById('dontShowAgainToday');

            if (checkbox && checkbox.checked) {
                const today = new Date().toISOString().split('T')[0];
                localStorage.setItem('rsia_announcement_hidden_date', today);
            }

            if (card) {
                card.classList.remove('scale-100', 'opacity-100');
                card.classList.add('scale-90', 'opacity-0');
            }

            setTimeout(function() {
                if (popup) {
                    popup.classList.add('hidden');
                    popup.classList.remove('flex');
                }
            }, 250);
        }

        // Close any modal when clicking backdrop or pressing Escape
        document.addEventListener('DOMContentLoaded', function() {
            const popup = document.getElementById('announcementPopup');
            const popupCard = document.getElementById('announcementPopupCard');
            if (popup) {
                popup.addEventListener('click', function(e) {
                    // Close if clicking the dark overlay outside the popup card
                    if (e.target === popup || (popupCard && !popupCard.contains(e.target))) {
                        closeAnnouncementPopup();
                    }
                });
            }

            const bookingModal = document.getElementById('bookingModal');
            if (bookingModal) {
                bookingModal.addEventListener('click', function(e) {
                    // Close if clicking outside the modal dialog box
                    const modalBox = bookingModal.querySelector('.bg-white');
                    if (e.target === bookingModal || (modalBox && !modalBox.contains(e.target))) {
                        closeBookingModal();
                    }
                });
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAnnouncementPopup();
                    closeBookingModal();
                }
            });
        });
    </script>

        <!-- SweetAlert2 (Local, Offline-ready) -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ addslashes(session('success')) }}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#ffffff',
                    color: '#1e293b',
                    iconColor: '#10b981',
                    customClass: {
                        popup: 'rounded-2xl shadow-xl border border-emerald-100 p-4 mt-4 mr-4',
                        title: 'font-heading font-extrabold text-sm text-slate-800',
                        htmlContainer: 'text-xs text-slate-600',
                    }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ addslashes(session('error')) }}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    background: '#ffffff',
                    color: '#1e293b',
                    iconColor: '#f43f5e',
                    customClass: {
                        popup: 'rounded-2xl shadow-xl border border-rose-100 p-4 mt-4 mr-4',
                        title: 'font-heading font-extrabold text-sm text-slate-800',
                        htmlContainer: 'text-xs text-slate-600',
                    }
                });
            @endif
        });
    </script>
    @stack('scripts')
</body>
</html>
