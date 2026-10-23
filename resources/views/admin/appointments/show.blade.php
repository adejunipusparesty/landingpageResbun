@extends('layouts.admin')

@section('title', 'Detail Janji Temu #' . $appointment->booking_code . ' - RSIA Restu Bunda')
@section('page-title', 'Detail Janji Temu #' . $appointment->booking_code)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Janji Temu</span>
        </a>
        <div class="flex items-center gap-2">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $appointment->phone) }}?text=Halo%20{{ urlencode($appointment->patient_name) }},%20kami%20dari%20RSIA%20Kasih%20Bunda%20terkait%20janji%20temu%20kode%20{{ $appointment->booking_code }}" target="_blank" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                <span>Chat Pasien di WhatsApp</span>
            </a>
        </div>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-8">
        
        <!-- Header Info -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-slate-100 gap-4">
            <div>
                <span class="text-xs text-slate-400 uppercase font-bold tracking-wider">Kode Booking</span>
                <div class="text-2xl font-black font-heading text-brand-dark tracking-wide">{{ $appointment->booking_code }}</div>
                <span class="text-[11px] text-slate-400">Diajukan pada: {{ $appointment->created_at->format('d F Y, H:i') }} WIB</span>
            </div>

            <!-- Status Control Form -->
            <form action="{{ route('admin.appointments.status', $appointment->id) }}" method="POST" class="flex items-center gap-3">
                @csrf
                @method('PATCH')
                <div class="space-y-1">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Ubah Status</label>
                    <select name="status" class="p-2 rounded-xl border border-slate-200 bg-slate-50 text-xs font-bold text-slate-800 focus:bg-white focus:outline-none">
                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <button type="submit" class="mt-4 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs transition">
                    Simpan
                </button>
            </form>
        </div>

        <!-- Detail Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-xs">
            <div class="p-4 bg-slate-50 rounded-2xl space-y-1">
                <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Nama Pasien</span>
                <div class="text-base font-bold text-slate-900">{{ $appointment->patient_name }}</div>
            </div>

            <div class="p-4 bg-slate-50 rounded-2xl space-y-1">
                <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Nama Orang Tua / Wali</span>
                <div class="text-base font-bold text-slate-900">{{ $appointment->parent_name ?? '-' }}</div>
            </div>

            <div class="p-4 bg-slate-50 rounded-2xl space-y-1">
                <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Nomor WhatsApp Pasien</span>
                <div class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                    <span>{{ $appointment->phone }}</span>
                </div>
            </div>

            <div class="p-4 bg-slate-50 rounded-2xl space-y-1">
                <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Email</span>
                <div class="text-base font-bold text-slate-900">{{ $appointment->email ?? '-' }}</div>
            </div>

            <div class="p-4 bg-slate-50 rounded-2xl space-y-1">
                <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Dokter Spesialis</span>
                <div class="text-base font-bold text-slate-900">{{ $appointment->doctor ? $appointment->doctor->name : '-' }}</div>
                @if($appointment->doctor)
                    <div class="text-[11px] text-brand-600 font-medium">{{ $appointment->doctor->specialty }}</div>
                @endif
            </div>

            <div class="p-4 bg-slate-50 rounded-2xl space-y-1">
                <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Tanggal &amp; Sesi Kunjungan</span>
                <div class="text-base font-bold text-slate-900">{{ $appointment->appointment_date->format('d F Y') }}</div>
                <div class="text-[11px] text-slate-500 font-medium">{{ $appointment->appointment_time }}</div>
            </div>
        </div>

        <!-- Complaint Notes -->
        <div class="space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block">Keluhan / Catatan Medis dari Pasien</span>
            <div class="p-4 rounded-2xl bg-slate-50 text-slate-700 text-xs leading-relaxed border border-slate-100">
                {{ $appointment->complaint ?? 'Tidak ada keluhan khusus yang dicantumkan.' }}
            </div>
        </div>

        <!-- Admin Internal Notes Form -->
        <div class="space-y-2 pt-4 border-t border-slate-100">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block">Catatan Internal Petugas RS</span>
            <form action="{{ route('admin.appointments.status', $appointment->id) }}" method="POST" class="space-y-3">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="{{ $appointment->status }}">
                <textarea name="admin_note" rows="3" placeholder="Tuliskan catatan internal (misal: nomor antrean 05, sudah dihubungi via WA, konfirmasi dokter siap)..." class="w-full p-3 rounded-xl border border-slate-200 text-xs text-slate-800 focus:bg-white focus:outline-none focus:border-brand-500">{{ $appointment->admin_note }}</textarea>
                <div class="flex justify-end">
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow transition">
                        Simpan Catatan Internal
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
