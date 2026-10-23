@extends('layouts.admin')

@section('title', 'Pengaturan Rumah Sakit - RSIA Restu Bunda')
@section('page-title', 'Pengaturan Profil & Komponen Website')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 pb-12">

    <!-- Header Description & Feedback Alert -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-xs text-slate-500">
                Kelola informasi rumah sakit, kontak darurat, upload gambar utama (Logo &amp; Hero), Top Emergency Info Bar, serta Pop-up Pengumuman interaktif.
            </p>
        </div>
        <div>
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Lihat Website Utama</span>
            </a>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs">
        @csrf

        <!-- CARD 1: UPLOAD LOGO RUMAH SAKIT & FOTO HERO UTAMA -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-5">
            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                <div class="w-8 h-8 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-images"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold font-heading text-slate-900">Upload Logo Resmi &amp; Foto Hero Utama</h3>
                    <p class="text-[11px] text-slate-400">Ganti logo rumah sakit di navbar dan foto hero utama di landing page kapan saja.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Upload 1: Logo Rumah Sakit -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                    <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-star text-brand-600 mr-1.5"></i> Logo Rumah Sakit (Navbar &amp; Footer)
                    </label>
                    <div class="flex items-center gap-5">
                        <div class="w-24 h-24 rounded-2xl bg-white border border-slate-200 p-2 flex items-center justify-center shadow-sm shrink-0">
                            <img id="logoPreview" src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Logo RSIA Restu Bunda" class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="space-y-2 flex-1">
                            <label for="logo_file" class="cursor-pointer inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span>Pilih Logo Baru</span>
                            </label>
                            <input type="file" id="logo_file" name="logo_file" accept="image/png,image/jpeg,image/webp" class="hidden" onchange="previewLogo(this)">
                            <p class="text-[11px] text-slate-500">
                                Format PNG transparan (Rekomendasi). Maksimal 4 MB.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Upload 2: Foto Hero Landing Page -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                    <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-image text-brand-600 mr-1.5"></i> Foto Hero Utama Landing Page
                    </label>
                    <div class="flex items-center gap-5">
                        <div class="w-28 aspect-[4/3] rounded-2xl bg-slate-200 overflow-hidden border border-slate-200 shadow-sm shrink-0">
                            <img id="heroPreview" src="{{ asset('images/hero.jpg') }}?v={{ time() }}" alt="Hero Banner RSIA Restu Bunda" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-2 flex-1">
                            <label for="hero_file" class="cursor-pointer inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span>Pilih Foto Hero Baru</span>
                            </label>
                            <input type="file" id="hero_file" name="hero_file" accept="image/*" class="hidden" onchange="previewHero(this)">
                            <p class="text-[11px] text-slate-500">
                                Format JPG, PNG, WEBP. Rasio 4:3 atau 5:4 landscape.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: TOP EMERGENCY INFO BAR -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-slate-100 gap-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold font-heading text-slate-900">Top Emergency Info Bar</h3>
                        <p class="text-[11px] text-slate-400">Bar informasi darurat dan lokasi yang berada di bagian paling atas halaman website.</p>
                    </div>
                </div>

                <!-- Toggle Top Bar Active -->
                <label class="inline-flex items-center cursor-pointer select-none bg-emerald-50 hover:bg-emerald-100/70 border border-emerald-200/80 px-3.5 py-1.5 rounded-full transition">
                    <input type="checkbox" name="topbar_enabled" value="1" {{ ($settings['topbar_enabled'] ?? '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                    <div class="relative w-9 h-5 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-brand-600"></div>
                    <span class="ms-2.5 text-[11px] font-extrabold text-brand-900">Aktifkan Top Bar</span>
                </label>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">
                        <i class="fa-solid fa-location-dot text-brand-600 mr-1"></i> Teks Alamat di Top Bar
                    </label>
                    <input type="text" name="topbar_address" value="{{ $settings['topbar_address'] ?? 'Jl. Kh. Hasyim Ashari No.73, Gedong Pakuon, Kec. Telukbetung Selatan, Kota Bandar Lampung, Lampung 35221' }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:border-brand-500">
                    <p class="text-[10px] text-slate-400 mt-1">Ditampilkan di sebelah kiri ikon lokasi pada bar atas.</p>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">
                        <i class="fa-solid fa-map-location-dot text-brand-600 mr-1"></i> Tautan / Link Google Maps
                    </label>
                    <input type="url" name="topbar_address_url" value="{{ $settings['topbar_address_url'] ?? 'https://maps.app.goo.gl/Z6K36BDqhQd7cBgd9' }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:border-brand-500">
                    <p class="text-[10px] text-slate-400 mt-1">Saat diklik oleh pengunjung akan membuka Google Maps resmi.</p>
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">
                    <i class="fa-solid fa-clock text-brand-600 mr-1"></i> Keterangan Layanan IGD &amp; Operasional Cepat
                </label>
                <input type="text" name="topbar_service_hours" value="{{ $settings['topbar_service_hours'] ?? 'Pelayanan IGD & Bersalin 24 Jam Nonstop' }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:border-brand-500">
            </div>

            <!-- Tautan Navigasi Tambahan di Top Bar -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="topbar_show_booking_link" value="1" {{ ($settings['topbar_show_booking_link'] ?? '1') == '1' ? 'checked' : '' }} class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                    <div>
                        <span class="font-bold text-slate-800 block">Tampilkan Menu 'Cek Status Janji Temu'</span>
                        <span class="text-[11px] text-slate-500 block">Pengunjung dapat melacak kode booking dengan mudah di bar atas.</span>
                    </div>
                </label>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="topbar_show_admin_link" value="1" {{ ($settings['topbar_show_admin_link'] ?? '0') == '1' ? 'checked' : '' }} class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                    <div>
                        <span class="font-bold text-slate-800 block">Tampilkan Tombol 'Portal Admin'</span>
                        <span class="text-[11px] text-slate-500 block">Menyediakan tautan langsung menuju halaman login petugas.</span>
                    </div>
                </label>
            </div>
        </div>

        <!-- CARD 3: POP-UP PENGUMUMAN MODAL -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-slate-100 gap-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold font-heading text-slate-900">Pop-up Pengumuman (Announcement Modal)</h3>
                        <p class="text-[11px] text-slate-400">Modal pop-up interaktif otomatis muncul saat pengunjung mengakses web.</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" onclick="previewPopupModal()" class="px-3.5 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-extrabold flex items-center gap-1.5 transition cursor-pointer">
                        <i class="fa-solid fa-eye text-brand-600"></i>
                        <span>Lihat Simulasi Pop-up</span>
                    </button>

                    <!-- Toggle Pop-up Active -->
                    <label class="inline-flex items-center cursor-pointer select-none bg-amber-50 hover:bg-amber-100/70 border border-amber-200/80 px-3.5 py-1.5 rounded-full transition">
                        <input type="checkbox" name="popup_enabled" value="1" {{ ($settings['popup_enabled'] ?? '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="relative w-9 h-5 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-amber-500"></div>
                        <span class="ms-2.5 text-[11px] font-extrabold text-amber-950">Aktifkan Pop-up</span>
                    </label>
                </div>
            </div>

            <!-- Banner Gambar Pop-up & Upload -->
            <div class="p-5 rounded-2xl bg-gradient-to-br from-slate-50 to-emerald-50/30 border border-slate-200/80 space-y-4">
                <div class="flex items-center justify-between">
                    <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-image text-brand-600 mr-1"></i> Banner Foto / Gambar Pop-up
                    </label>
                    <span class="text-[10px] text-slate-400 font-semibold">Rasio ideal 16:9 (Landscape)</span>
                </div>

                @php
                    $popupImg = $settings['popup_image'] ?? 'popup_banner.jpg';
                    $hasPopupImg = file_exists(public_path('images/' . $popupImg));
                @endphp

                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <!-- Banner Preview Box -->
                    <div class="relative w-full sm:w-64 aspect-[16/9] rounded-2xl overflow-hidden border-2 border-emerald-500/20 bg-slate-200 shadow-sm shrink-0">
                        <img id="popupBannerPreview" src="{{ $hasPopupImg ? asset('images/' . $popupImg) : asset('images/popup_banner.jpg') }}" alt="Preview Pop-up Banner" class="w-full h-full object-cover">
                        <span class="absolute bottom-2 left-2 bg-slate-900/80 text-white text-[9px] font-bold px-2 py-0.5 rounded-full">
                            Banner Saat Ini
                        </span>
                    </div>

                    <!-- Upload Controls -->
                    <div class="flex-1 space-y-2 text-center sm:text-left w-full">
                        <label for="popup_image_file" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span>Pilih &amp; Upload Banner Baru</span>
                        </label>
                        <input type="file" id="popup_image_file" name="popup_image_file" accept="image/*" class="hidden" onchange="previewPopupImage(this)">
                        <p class="text-[11px] text-slate-500">
                            Format JPG, PNG, WEBP (Maksimal 4 MB). Gambar akan tampil di bagian atas jendela pop-up.
                        </p>
                        <div class="pt-1">
                            <span class="text-[10px] text-slate-400 block font-medium">Nama file saat ini:</span>
                            <input type="text" name="popup_image" value="{{ $settings['popup_image'] ?? 'popup_banner.jpg' }}" class="mt-1 w-full max-w-sm p-2 rounded-lg border border-slate-200 bg-white text-xs text-slate-700 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Isi Pengumuman -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">
                        <i class="fa-solid fa-tag text-amber-500 mr-1"></i> Badge / Label Atas
                    </label>
                    <input type="text" id="cfg_popup_badge" name="popup_badge" value="{{ $settings['popup_badge'] ?? 'PENGUMUMAN RESMI' }}" placeholder="PENGUMUMAN RESMI" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:border-brand-500">
                    <p class="text-[10px] text-slate-400 mt-1">Badge kecil berwarna kuning/emas di atas judul.</p>
                </div>
                <div class="sm:col-span-2">
                    <label class="block font-bold text-slate-700 mb-1">
                        <i class="fa-solid fa-heading text-brand-600 mr-1"></i> Judul Pengumuman
                    </label>
                    <input type="text" id="cfg_popup_title" name="popup_title" value="{{ $settings['popup_title'] ?? 'Waspada Penipuan & Pelayanan Pendaftaran Online' }}" placeholder="Judul penting..." class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:border-brand-500">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">
                    <i class="fa-solid fa-align-left text-brand-600 mr-1"></i> Isi Informasi Pengumuman (Pesan Lengkap)
                </label>
                <textarea id="cfg_popup_content" name="popup_content" rows="4" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:border-brand-500 leading-relaxed">{{ $settings['popup_content'] ?? 'Pendaftaran konsultasi dokter spesialis kini dapat dilakukan secara online melalui website resmi RSIA Restu Bunda. Harap selalu waspada terhadap segala bentuk penipuan yang mengatasnamakan RSIA Restu Bunda. Konfirmasi resmi antrean dan konsultasi hanya dilayani melalui nomor WhatsApp Customer Care resmi kami: 0811-7234-5678.' }}</textarea>
                <p class="text-[10px] text-slate-400 mt-1">Teks pesan yang menjelaskan rincian informasi kepada pasien / pengunjung.</p>
            </div>

            <!-- Tombol CTA Pop-up -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">
                        <i class="fa-solid fa-arrow-pointer text-brand-600 mr-1"></i> Teks Tombol Aksi (CTA)
                    </label>
                    <input type="text" id="cfg_popup_btn_text" name="popup_btn_text" value="{{ $settings['popup_btn_text'] ?? 'Daftar Konsultasi Online Sekarang' }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:border-brand-500">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">
                        <i class="fa-solid fa-link text-brand-600 mr-1"></i> Tautan / Link Tombol Aksi
                    </label>
                    <input type="text" id="cfg_popup_btn_url" name="popup_btn_url" value="{{ $settings['popup_btn_url'] ?? '#quick-booking' }}" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:border-brand-500">
                    <p class="text-[10px] text-slate-400 mt-1">Gunakan '#quick-booking' untuk formulir janji temu atau URL eksternal (https://...).</p>
                </div>
            </div>
        </div>

        <!-- CARD 4: INFORMASI LEMBAGA & TAGLINE -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-4">
            <h3 class="text-sm font-bold font-heading text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-hospital text-brand-600"></i>
                <span>Informasi Lembaga &amp; Tagline</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nama Rumah Sakit</label>
                    <input type="text" name="hospital_name" value="{{ $settings['hospital_name'] ?? 'RSIA Restu Bunda' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tagline Utama</label>
                    <input type="text" name="tagline" value="{{ $settings['tagline'] ?? 'Rumah Sakit Ibu & Anak Terpercaya' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Pill Tag Hero Wilayah</label>
                <input type="text" name="badge_city" value="{{ $settings['badge_city'] ?? 'Rumah Sakit Ibu & Anak Pilihan di Bandar Lampung' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
            </div>
        </div>

        <!-- CARD 5: KONTAK & LAYANAN DARURAT RESMI -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-4">
            <h3 class="text-sm font-bold font-heading text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-phone-volume text-brand-600"></i>
                <span>Kontak Resmi &amp; Call Center 24 Jam</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nomor Darurat 24 Jam (Ambulans)</label>
                    <input type="text" name="phone_emergency" value="{{ $settings['phone_emergency'] ?? '0811-7234-5678' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Telepon Call Center</label>
                    <input type="text" name="phone_callcenter" value="{{ $settings['phone_callcenter'] ?? '(0721) 484185' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nomor WhatsApp Reservasi</label>
                    <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '081172345678' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Alamat Email Resmi</label>
                    <input type="email" name="email" value="{{ $settings['email'] ?? 'restubunda.rsia@gmail.com' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Jam Operasional Poliklinik &amp; IGD</label>
                    <input type="text" name="operating_hours" value="{{ $settings['operating_hours'] ?? 'Senin - Sabtu: 08.00 - 21.00 WIB | IGD & Ruang Bersalin: 24 Jam Nonstop' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Alamat Fisik Lengkap Rumah Sakit</label>
                <textarea name="address" rows="2" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">{{ $settings['address'] ?? 'Jl. Kh. Hasyim Ashari No.73, Gedong Pakuon, Kec. Telukbetung Selatan, Kota Bandar Lampung, Lampung 35221' }}</textarea>
            </div>
        </div>

        <!-- CARD 6: ANGKA STATISTIK HERO BAR -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-4">
            <h3 class="text-sm font-bold font-heading text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-chart-simple text-brand-600"></i>
                <span>Angka Statistik Hero Bar</span>
            </h3>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Dokter Spesialis</label>
                    <input type="text" name="stat_doctors" value="{{ $settings['stat_doctors'] ?? '35+' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Pasien Terlayani</label>
                    <input type="text" name="stat_patients" value="{{ $settings['stat_patients'] ?? '15k+' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Layanan IGD</label>
                    <input type="text" name="stat_service_hours" value="{{ $settings['stat_service_hours'] ?? '24 Jam' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Akreditasi</label>
                    <input type="text" name="stat_accreditation" value="{{ $settings['stat_accreditation'] ?? 'Paripurna' }}" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="pt-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-[11px] text-slate-400">
                <i class="fa-solid fa-circle-info text-brand-600 mr-1"></i> Perubahan akan segera tampil di seluruh halaman publik website.
            </div>
            <button type="submit" class="w-full sm:w-auto py-3.5 px-8 rounded-2xl bg-gradient-to-r from-emerald-600 to-brand-600 hover:from-emerald-700 hover:to-brand-700 text-white font-extrabold text-xs uppercase tracking-wider shadow-lg shadow-emerald-600/25 transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Semua Pengaturan</span>
            </button>
        </div>
    </form>
</div>

<!-- SIMULASI POP-UP MODAL (UNTUK PREVIEW ADMIN) -->
<div id="adminPreviewModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/70 backdrop-blur-md transition-opacity">
    <div id="adminPreviewCard" class="relative bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border border-emerald-100 transform transition-all duration-300 scale-90 opacity-0">
        <!-- Close Button -->
        <button onclick="closeAdminPreviewModal()" class="absolute top-3.5 right-3.5 z-20 w-9 h-9 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center shadow-lg transition" title="Tutup Simulasi">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>

        <!-- Banner Image -->
        <div class="relative aspect-[16/9] w-full overflow-hidden bg-emerald-50">
            <img id="simBannerImg" src="{{ asset('images/' . ($settings['popup_image'] ?? 'popup_banner.jpg')) }}" alt="Simulasi Banner" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-black/20"></div>
            <div class="absolute bottom-3 left-4 right-4">
                <span id="simBadge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-400 text-slate-950 font-black text-[10px] uppercase tracking-wider shadow-md">
                    <i class="fa-solid fa-bullhorn text-xs"></i>
                    <span>{{ $settings['popup_badge'] ?? 'PENGUMUMAN RESMI' }}</span>
                </span>
            </div>
        </div>

        <!-- Body Content -->
        <div class="p-6 sm:p-7 space-y-4">
            <h3 id="simTitle" class="text-lg sm:text-xl font-extrabold font-heading text-slate-900 tracking-tight leading-snug">
                {{ $settings['popup_title'] ?? 'Waspada Penipuan & Pelayanan Pendaftaran Online' }}
            </h3>

            <p id="simContent" class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                {{ $settings['popup_content'] ?? 'Pendaftaran konsultasi dokter spesialis kini dapat dilakukan secara online melalui website resmi RSIA Restu Bunda...' }}
            </p>

            <!-- Actions -->
            <div class="pt-2 flex flex-col sm:flex-row gap-3">
                <a id="simBtn" href="#" onclick="closeAdminPreviewModal(); return false;" class="flex-1 py-3 px-5 rounded-2xl bg-gradient-to-r from-brand-600 to-emerald-500 text-white font-extrabold text-xs uppercase tracking-wider text-center shadow-lg shadow-brand-500/25 flex items-center justify-center gap-2">
                    <span id="simBtnText">{{ $settings['popup_btn_text'] ?? 'Daftar Konsultasi Online Sekarang' }}</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
                <button onclick="closeAdminPreviewModal()" class="py-3 px-5 rounded-2xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold text-xs transition">
                    Tutup
                </button>
            </div>

            <div class="pt-2 flex items-center justify-center gap-2 text-[11px] text-slate-400">
                <input type="checkbox" disabled checked class="rounded border-slate-300 text-brand-600">
                <span>Jangan tampilkan lagi hari ini (Simulasi Pengunjung)</span>
            </div>
        </div>
    </div>
</div>

<script>
    // Live preview for Logo upload
    function previewLogo(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logoPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Live preview for Hero Image upload
    function previewHero(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('heroPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Live preview for popup image upload
    function previewPopupImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('popupBannerPreview').src = e.target.result;
                document.getElementById('simBannerImg').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Interactive Admin Preview Modal
    function previewPopupModal() {
        const badgeInput = document.getElementById('cfg_popup_badge').value;
        const titleInput = document.getElementById('cfg_popup_title').value;
        const contentInput = document.getElementById('cfg_popup_content').value;
        const btnTextInput = document.getElementById('cfg_popup_btn_text').value;

        document.getElementById('simBadge').querySelector('span').textContent = badgeInput || 'PENGUMUMAN';
        document.getElementById('simTitle').textContent = titleInput || 'Judul Pengumuman';
        document.getElementById('simContent').textContent = contentInput || 'Isi Pengumuman';
        document.getElementById('simBtnText').textContent = btnTextInput || 'Tindakan';

        const modal = document.getElementById('adminPreviewModal');
        const card = document.getElementById('adminPreviewCard');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            card.classList.remove('scale-90', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 30);
    }

    function closeAdminPreviewModal() {
        const modal = document.getElementById('adminPreviewModal');
        const card = document.getElementById('adminPreviewCard');
        if (card) {
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-90', 'opacity-0');
        }
        setTimeout(() => {
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }, 200);
    }
</script>
@endsection
