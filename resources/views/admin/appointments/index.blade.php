@extends('layouts.admin')

@section('title', 'Kelola Janji Temu Pasien - RSIA Restu Bunda')
@section('page-title', 'Janji Temu Pasien')

@section('content')
<div class="space-y-6">

    <!-- Top Action & Search Bar -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Status Tabs -->
            <div class="flex flex-wrap gap-2 text-xs font-bold">
                <a href="{{ route('admin.appointments.index') }}" class="px-3.5 py-2 rounded-xl {{ !$status ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }} transition">
                    Semua
                </a>
                <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}" class="px-3.5 py-2 rounded-xl {{ $status == 'pending' ? 'bg-amber-500 text-white' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }} transition">
                    Pending
                </a>
                <a href="{{ route('admin.appointments.index', ['status' => 'confirmed']) }}" class="px-3.5 py-2 rounded-xl {{ $status == 'confirmed' ? 'bg-emerald-600 text-white' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }} transition">
                    Dikonfirmasi
                </a>
                <a href="{{ route('admin.appointments.index', ['status' => 'completed']) }}" class="px-3.5 py-2 rounded-xl {{ $status == 'completed' ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-700 hover:bg-blue-100' }} transition">
                    Selesai
                </a>
                <a href="{{ route('admin.appointments.index', ['status' => 'cancelled']) }}" class="px-3.5 py-2 rounded-xl {{ $status == 'cancelled' ? 'bg-rose-600 text-white' : 'bg-rose-50 text-rose-700 hover:bg-rose-100' }} transition">
                    Batal
                </a>
            </div>

            <!-- Add manual booking button -->
            <button onclick="toggleModal('manualBookingModal')" class="py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition flex items-center gap-2 self-start md:self-auto">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Janji Temu Manual</span>
            </button>
        </div>

        <!-- Search & Filter Form -->
        <form action="{{ route('admin.appointments.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 pt-2">
            @if($status)
                <input type="hidden" name="status" value="{{ $status }}">
            @endif
            <div class="sm:col-span-8 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari kode booking, nama pasien, orang tua, no hp..." class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:border-brand-500">
            </div>
            <div class="sm:col-span-3">
                <input type="date" name="date" value="{{ $date }}" class="w-full px-3 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:border-brand-500">
            </div>
            <div class="sm:col-span-1">
                <button type="submit" class="w-full py-2.5 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs transition">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Appointments Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-4 px-6">Kode Booking</th>
                        <th class="py-4 px-6">Nama Pasien &amp; Wali</th>
                        <th class="py-4 px-6">Dokter &amp; Jadwal</th>
                        <th class="py-4 px-6">WhatsApp</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($appointments as $apt)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-brand-700 block">{{ $apt->booking_code }}</span>
                                <span class="text-[11px] text-slate-400">Dibuat: {{ $apt->created_at->format('d/m/Y H:i') }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-800 block">{{ $apt->patient_name }}</span>
                                @if($apt->parent_name)
                                    <span class="text-slate-400 text-[11px]">Wali: {{ $apt->parent_name }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-700 block">{{ $apt->doctor ? $apt->doctor->name : ($apt->service_category ?? 'Umum') }}</span>
                                <span class="text-slate-400 text-[11px] block">{{ $apt->appointment_date->format('d M Y') }} • {{ $apt->appointment_time }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $apt->phone) }}?text=Halo%20{{ urlencode($apt->patient_name) }},%20kami%20dari%20RSIA%20Kasih%20Bunda%20konfirmasi%20janji%20temu%20kode%20{{ $apt->booking_code }}" target="_blank" class="inline-flex items-center gap-1.5 font-bold text-emerald-600 hover:text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-lg">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    <span>{{ $apt->phone }}</span>
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                <form action="{{ route('admin.appointments.status', $apt->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="rounded-lg text-[11px] font-bold py-1 px-2.5 border cursor-pointer focus:outline-none {{ $apt->status == 'confirmed' ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : ($apt->status == 'pending' ? 'bg-amber-50 text-amber-800 border-amber-200' : ($apt->status == 'completed' ? 'bg-blue-50 text-blue-800 border-blue-200' : 'bg-rose-50 text-rose-800 border-rose-200')) }}">
                                        <option value="pending" {{ $apt->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $apt->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                        <option value="completed" {{ $apt->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                        <option value="cancelled" {{ $apt->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.appointments.show', $apt->id) }}" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition" title="Lihat Rincian">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.appointments.destroy', $apt->id) }}" method="POST" class="inline">
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
                            <td colspan="6" class="text-center py-10 text-slate-400">Tidak ada data janji temu yang sesuai dengan filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($appointments->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal: Manual Booking Addition -->
<div id="manualBookingModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative">
        <button onclick="toggleModal('manualBookingModal')" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
        <h3 class="text-xl font-bold font-heading text-slate-900 mb-1">Tambah Janji Temu Manual</h3>
        <p class="text-xs text-slate-500 mb-5">Input janji temu untuk pasien yang mendaftar via telepon atau loket.</p>

        <form action="{{ route('admin.appointments.store') }}" method="POST" class="space-y-3.5 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 mb-1">Nama Pasien</label>
                <input type="text" name="patient_name" required placeholder="Nama pasien" class="w-full p-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nama Orang Tua / Wali</label>
                    <input type="text" name="parent_name" placeholder="Nama wali" class="w-full p-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">No. WhatsApp</label>
                    <input type="tel" name="phone" required placeholder="08xxxxxxxxxx" class="w-full p-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Dokter Spesialis</label>
                    <select name="doctor_id" class="w-full p-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                        <option value="">Pilih Dokter</option>
                        @foreach($doctors as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Layanan / Poli</label>
                    <input type="text" name="service_category" placeholder="Contoh: Poli Anak" class="w-full p-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tanggal Kunjungan</label>
                    <input type="date" name="appointment_date" value="{{ date('Y-m-d') }}" required class="w-full p-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Sesi Waktu</label>
                    <input type="text" name="appointment_time" value="Pagi (08:00 - 12:00)" class="w-full p-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Status Awal</label>
                <select name="status" class="w-full p-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                    <option value="confirmed">Langsung Dikonfirmasi</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Keluhan / Catatan</label>
                <textarea name="complaint" rows="2" placeholder="Catatan singkat..." class="w-full p-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none"></textarea>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold transition">
                    Simpan Janji Temu
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }
</script>
@endsection
