@extends('layouts.app')

@section('title', 'Cek Status Janji Temu - RSIA Restu Bunda')

@section('content')
<div class="py-16 sm:py-20 bg-[#f4faf6] min-h-[70vh]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-10 space-y-2">
            <span class="inline-block px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-extrabold uppercase tracking-widest font-heading">
                Status Reservasi
            </span>
            <h1 class="text-3xl sm:text-4xl font-black font-heading text-slate-900 tracking-tight">
                Cek Status Janji Temu Medis
            </h1>
            <p class="text-sm text-slate-600 max-w-xl mx-auto">
                Masukkan Kode Booking (contoh: <code class="bg-emerald-50 text-brand-700 px-1.5 py-0.5 rounded font-bold">RB-202610-0001</code>) atau Nomor WhatsApp yang Anda daftarkan.
            </p>
        </div>

        <!-- Search Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl shadow-emerald-900/5 border border-slate-100 mb-8">
            <form action="{{ route('booking.check') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" name="search" value="{{ $query ?? '' }}" placeholder="Masukkan Kode Booking / No. WhatsApp..." required class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-800 focus:bg-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500 focus:outline-none transition">
                </div>
                <button type="submit" class="py-3.5 px-8 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-sm shadow-md shadow-brand-600/20 transition active:scale-95 flex items-center justify-center gap-2">
                    <span>Lacak Janji</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>
        </div>

        <!-- Result -->
        @if($query)
            @if($appointment)
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-emerald-100 space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-slate-100 gap-4">
                        <div>
                            <span class="text-xs text-slate-400 uppercase font-bold tracking-wider">Kode Booking</span>
                            <div class="text-2xl font-black font-heading text-brand-dark tracking-wide">{{ $appointment->booking_code }}</div>
                        </div>
                        <div>
                            @if($appointment->status == 'confirmed')
                                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold">
                                    <i class="fa-solid fa-circle-check text-emerald-600"></i> Dikonfirmasi Petugas
                                </span>
                            @elseif($appointment->status == 'pending')
                                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-bold">
                                    <i class="fa-regular fa-clock text-amber-600"></i> Menunggu Konfirmasi
                                </span>
                            @elseif($appointment->status == 'completed')
                                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-blue-100 text-blue-800 text-xs font-bold">
                                    <i class="fa-solid fa-badge-check text-blue-600"></i> Selesai Berkunjung
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-rose-100 text-rose-800 text-xs font-bold">
                                    <i class="fa-solid fa-ban text-rose-600"></i> Dibatalkan
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div class="p-3.5 bg-slate-50 rounded-2xl">
                            <span class="text-slate-400 block font-semibold">Nama Pasien</span>
                            <span class="text-sm font-bold text-slate-800 mt-0.5 block">{{ $appointment->patient_name }}</span>
                        </div>
                        <div class="p-3.5 bg-slate-50 rounded-2xl">
                            <span class="text-slate-400 block font-semibold">Nama Orang Tua / Wali</span>
                            <span class="text-sm font-bold text-slate-800 mt-0.5 block">{{ $appointment->parent_name ?? '-' }}</span>
                        </div>
                        <div class="p-3.5 bg-slate-50 rounded-2xl">
                            <span class="text-slate-400 block font-semibold">Dokter Praktik</span>
                            <span class="text-sm font-bold text-slate-800 mt-0.5 block">{{ $appointment->doctor ? $appointment->doctor->name : 'Dokter Terjadwal' }}</span>
                            @if($appointment->doctor)
                                <span class="text-[11px] text-brand-600 font-medium block">{{ $appointment->doctor->specialty }}</span>
                            @endif
                        </div>
                        <div class="p-3.5 bg-slate-50 rounded-2xl">
                            <span class="text-slate-400 block font-semibold">Jadwal Kunjungan</span>
                            <span class="text-sm font-bold text-slate-800 mt-0.5 block">{{ $appointment->appointment_date->format('d F Y') }}</span>
                            <span class="text-[11px] text-slate-500 block">{{ $appointment->appointment_time }}</span>
                        </div>
                    </div>

                    @if($appointment->complaint)
                        <div class="p-4 bg-slate-50 rounded-2xl text-xs">
                            <span class="text-slate-400 font-semibold block mb-1">Keluhan / Catatan Medis</span>
                            <p class="text-slate-700 leading-relaxed">{{ $appointment->complaint }}</p>
                        </div>
                    @endif

                    @if($appointment->admin_note)
                        <div class="p-4 bg-emerald-50 border border-emerald-200/60 rounded-2xl text-xs">
                            <span class="text-emerald-800 font-bold block mb-1">
                                <i class="fa-solid fa-circle-info mr-1"></i> Catatan dari Rumah Sakit
                            </span>
                            <p class="text-emerald-900 leading-relaxed">{{ $appointment->admin_note }}</p>
                        </div>
                    @endif

                    <div class="pt-2 flex flex-col sm:flex-row gap-3">
                        <a href="https://wa.me/6281172345678?text=Halo%20RSIA%20Kasih%20Bunda,%20saya%20ingin%20konfirmasi%20janji%20temu%20kode%20{{ $appointment->booking_code }}" target="_blank" class="flex-1 py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Hubungi Customer Care RS</span>
                        </a>
                        <a href="{{ route('home') }}" class="py-3 px-6 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold text-xs text-center transition">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl p-10 shadow-lg text-center border border-slate-100 space-y-3">
                    <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto text-2xl">
                        <i class="fa-solid fa-circle-question"></i>
                    </div>
                    <h3 class="text-xl font-bold font-heading text-slate-800">Data Janji Temu Tidak Ditemukan</h3>
                    <p class="text-xs text-slate-500 max-w-sm mx-auto">
                        Tidak ada reservasi yang cocok dengan kata kunci "{{ $query }}". Mohon periksa kembali kode booking atau nomor WhatsApp Anda.
                    </p>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
