@extends('layouts.admin')

@section('title', 'Ringkasan Dashboard - RSIA Restu Bunda')
@section('page-title', 'Ringkasan Pelayanan & Operasional')

@section('content')
<div class="space-y-8">

    <!-- KPI Metric Cards (5 Columns on Desktop) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-5">
        <!-- Card 1: Total Appointments -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Total Janji Temu</span>
                <div class="text-3xl font-black font-heading text-slate-900">{{ $totalAppointments }}</div>
                <div class="text-[11px] text-emerald-600 font-semibold mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <span>{{ $confirmedAppointments }} Terkonfirmasi</span>
                </div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>

        <!-- Card 2: Pending Appointments -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Menunggu Konfirmasi</span>
                <div class="text-3xl font-black font-heading text-amber-500">{{ $pendingAppointments }}</div>
                <div class="text-[11px] text-amber-600 font-semibold mt-1">
                    Perlu respon admin segera
                </div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-clock"></i>
            </div>
        </div>

        <!-- Card 3: Dokter Aktif -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Dokter Spesialis</span>
                <div class="text-3xl font-black font-heading text-slate-900">{{ $totalDoctors }}</div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Kebidanan, Anak &amp; Neonatus
                </div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-user-doctor"></i>
            </div>
        </div>

        <!-- Card 4: Artikel Kesehatan -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Artikel Edukasi</span>
                <div class="text-3xl font-black font-heading text-slate-900">{{ $totalArticles }}</div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Panduan sehat ibu &amp; anak
                </div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>

        <!-- Card 5: Testimoni Pasien -->
        <a href="{{ route('admin.testimonials.index') }}" class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 flex items-center justify-between hover:border-emerald-300 hover:shadow-md transition group">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Testimoni Pasien</span>
                <div class="text-3xl font-black font-heading text-slate-900 group-hover:text-emerald-700 transition">{{ $totalTestimonials }}</div>
                <div class="text-[11px] text-emerald-600 font-semibold mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-comments"></i>
                    <span>Kelola Ulasan</span>
                </div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl group-hover:scale-110 transition">
                <i class="fa-solid fa-comments"></i>
            </div>
        </a>
    </div>

    <!-- Quick Action Banners -->
    <div class="bg-gradient-to-r from-emerald-800 to-teal-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-2 text-center md:text-left">
            <span class="px-3 py-1 rounded-full bg-white/20 text-emerald-200 text-xs font-bold uppercase tracking-wider">Aksi Cepat Manajemen</span>
            <h3 class="text-2xl font-bold font-heading">Kelola Pendaftaran Pasien &amp; Jadwal Praktik</h3>
            <p class="text-xs text-emerald-100 max-w-xl">
                Terdapat <strong class="text-white">{{ $pendingAppointments }} pendaftaran baru</strong> yang membutuhkan verifikasi jadwal dengan dokter spesialis terkait.
            </p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}" class="py-3 px-5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-extrabold text-xs shadow-md transition flex items-center gap-2">
                <i class="fa-solid fa-bell"></i>
                <span>Tinjau Janji Pending ({{ $pendingAppointments }})</span>
            </a>
            <a href="{{ route('admin.doctors.create') }}" class="py-3 px-5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs transition border border-white/20 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Dokter</span>
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="py-3 px-5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs transition border border-white/20 flex items-center gap-2">
                <i class="fa-solid fa-comments"></i>
                <span>Kelola Testimoni</span>
            </a>
        </div>
    </div>

    <!-- Recent Appointments Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold font-heading text-slate-900">Pendaftaran Janji Temu Terbaru</h3>
                <p class="text-xs text-slate-500">Daftar pasien yang mendaftar secara online melalui portal website</p>
            </div>
            <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800 flex items-center gap-1">
                <span>Lihat Semua Janji Temu</span>
                <i class="fa-solid fa-arrow-right text-[11px]"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-3.5 px-6">Kode &amp; Tanggal</th>
                        <th class="py-3.5 px-6">Pasien / Wali</th>
                        <th class="py-3.5 px-6">Dokter / Layanan</th>
                        <th class="py-3.5 px-6">Kontak WA</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentAppointments as $apt)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-brand-700 block">{{ $apt->booking_code }}</span>
                                <span class="text-slate-400 text-[11px]">{{ $apt->appointment_date->format('d M Y') }} • {{ $apt->appointment_time }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-800 block">{{ $apt->patient_name }}</span>
                                @if($apt->parent_name)
                                    <span class="text-slate-400 text-[11px]">Wali: {{ $apt->parent_name }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-slate-700 block">{{ $apt->doctor ? $apt->doctor->name : ($apt->service_category ?? 'Umum') }}</span>
                                @if($apt->doctor)
                                    <span class="text-brand-600 text-[11px]">{{ $apt->doctor->specialty }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $apt->phone) }}?text=Halo%20Bpk/Ibu%20{{ urlencode($apt->patient_name) }},%20kami%20dari%20RSIA%20Restu%20Bunda%20terkait%20janji%20temu%20kode%20{{ $apt->booking_code }}" target="_blank" class="inline-flex items-center gap-1.5 font-bold text-emerald-600 hover:text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-lg">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    <span>{{ $apt->phone }}</span>
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                @if($apt->status == 'confirmed')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[11px]">
                                        Dikonfirmasi
                                    </span>
                                @elseif($apt->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 font-bold text-[11px]">
                                        Pending
                                    </span>
                                @elseif($apt->status == 'completed')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-100 text-blue-800 font-bold text-[11px]">
                                        Selesai
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-rose-100 text-rose-800 font-bold text-[11px]">
                                        Batal
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($apt->status == 'pending')
                                        <form action="{{ route('admin.appointments.status', $apt->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="px-2.5 py-1 rounded-lg bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition" title="Konfirmasi Janji">
                                                <i class="fa-solid fa-check text-xs"></i> Konfirmasi
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.appointments.show', $apt->id) }}" class="p-1.5 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition" title="Lihat Detail">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-400">Belum ada data pendaftaran janji temu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
