<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - RSIA Restu Bunda')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
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

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        .sidebar-link.active {
            background-color: #047857;
            color: #ffffff;
            font-weight: 700;
        }
        .sidebar-link:hover:not(.active) {
            background-color: #064e3b;
            color: #d1fae5;
        }
        /* Custom scrollbar for sidebar */
        #admin-sidebar::-webkit-scrollbar {
            width: 4px;
        }
        #admin-sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 9999px;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased flex min-h-screen">

    <!-- Sidebar (Sticky on Desktop, Off-canvas on Mobile) -->
    <aside id="admin-sidebar" class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between shrink-0 border-r border-slate-800 transition-all duration-300 z-50 fixed inset-y-0 left-0 lg:sticky lg:top-0 lg:h-screen lg:overflow-y-auto -translate-x-full lg:translate-x-0">
        <div>
            <!-- Hospital Brand Header -->
            <div class="h-20 px-5 flex items-center border-b border-slate-800/80 bg-slate-950/40 shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="p-2 rounded-2xl bg-white shadow-sm flex items-center justify-center w-full hover:opacity-95 transition">
                    <img src="{{ asset('images/logo.png') }}" alt="RSIA Restu Bunda" class="h-9 w-auto object-contain">
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="p-3 space-y-1.5 text-xs font-medium">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-3.5 py-3 rounded-xl transition text-slate-300">
                    <i class="fa-solid fa-chart-line text-sm w-4 text-center"></i>
                    <span>Ringkasan Dashboard</span>
                </a>

                <a href="{{ route('admin.appointments.index') }}" class="sidebar-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }} flex items-center justify-between px-3.5 py-3 rounded-xl transition text-slate-300">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-calendar-check text-sm w-4 text-center"></i>
                        <span>Janji Temu Pasien</span>
                    </div>
                    @php
                        $pendingCount = \App\Models\Appointment::where('status', 'pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="bg-amber-500 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.doctors.index') }}" class="sidebar-link {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }} flex items-center gap-3 px-3.5 py-3 rounded-xl transition text-slate-300">
                    <i class="fa-solid fa-user-doctor text-sm w-4 text-center"></i>
                    <span>Kelola Tim Dokter</span>
                </a>

                <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }} flex items-center gap-3 px-3.5 py-3 rounded-xl transition text-slate-300">
                    <i class="fa-solid fa-hand-holding-medical text-sm w-4 text-center"></i>
                    <span>Layanan Medis</span>
                </a>

                <a href="{{ route('admin.facilities.index') }}" class="sidebar-link {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }} flex items-center gap-3 px-3.5 py-3 rounded-xl transition text-slate-300">
                    <i class="fa-solid fa-hospital-user text-sm w-4 text-center"></i>
                    <span>Fasilitas Rawat</span>
                </a>

                <a href="{{ route('admin.articles.index') }}" class="sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }} flex items-center gap-3 px-3.5 py-3 rounded-xl transition text-slate-300">
                    <i class="fa-solid fa-newspaper text-sm w-4 text-center"></i>
                    <span>Artikel &amp; Edukasi</span>
                </a>

                <!-- Testimoni Pasien Module -->
                <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }} flex items-center justify-between px-3.5 py-3 rounded-xl transition text-slate-300">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-comments text-sm w-4 text-center"></i>
                        <span>Testimoni Pasien</span>
                    </div>
                    @php
                        $testimonialTotalCount = \App\Models\Testimonial::count();
                    @endphp
                    @if($testimonialTotalCount > 0)
                        <span class="bg-emerald-600/70 text-emerald-100 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $testimonialTotalCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }} flex items-center gap-3 px-3.5 py-3 rounded-xl transition text-slate-300">
                    <i class="fa-solid fa-sliders text-sm w-4 text-center"></i>
                    <span>Pengaturan Rumah Sakit</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Bottom Actions -->
        <div class="p-3 border-t border-slate-800 space-y-2 shrink-0">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-slate-800/60 hover:bg-slate-800 text-emerald-400 text-xs font-semibold transition">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs w-4 text-center"></i>
                <span>Lihat Website Pasien</span>
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-rose-950/40 text-rose-400 text-xs font-semibold transition">
                    <i class="fa-solid fa-arrow-right-from-bracket text-xs w-4 text-center"></i>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay for mobile sidebar -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 hidden lg:hidden"></div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top Navbar Header (Sticky / Frozen at Top) -->
        <header class="h-20 bg-white/95 backdrop-blur-md border-b border-slate-200/80 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30 shadow-sm transition-all duration-200">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <div>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 font-heading tracking-tight">@yield('page-title', 'Dashboard')</h1>
                    <span class="text-xs text-slate-500 hidden sm:inline"><i class="fa-regular fa-calendar mr-1"></i> {{ date('l, d F Y') }}</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 transition">
                    <i class="fa-solid fa-globe text-emerald-600"></i>
                    <span>Buka Web Pasien</span>
                </a>
                <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>
                <div class="flex items-center gap-2 pl-1">
                    <div class="w-8 h-8 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-800 hidden md:inline">{{ Auth::user()->name ?? 'Admin' }}</span>
                </div>
            </div>
        </header>

        <!-- Page Alerts handled by SweetAlert2 (Auto-Dismiss) -->

        <!-- Dynamic Body -->
        <main class="p-4 sm:p-8 flex-1">
            @yield('content')
        </main>

        <!-- Admin Footer (Sticky / Frozen at Bottom) -->
        <footer class="sticky bottom-0 z-20 bg-white/95 backdrop-blur-md border-t border-slate-200/80 px-4 sm:px-8 py-3 text-center text-xs text-slate-500 shadow-sm transition-all duration-200 flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="font-medium text-center text-slate-600">RSIA Restu Bunda Management System</span>
            </div>
            <div class="text-[11px] text-slate-400">
                &copy; {{ date('Y') }} RSIA Restu Bunda. Seluruh hak cipta dilindungi.
            </div>
        </footer>
    </div>

    <!-- SweetAlert2 (Local, Offline-ready) -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Global Helper: Show Auto-Dismissing Toast Notification
        window.showToast = function(icon, title, message = '', timer = 2800) {
            if (typeof Swal === 'undefined') return;
            Swal.fire({
                icon: icon, // 'success', 'error', 'info', 'warning'
                title: title,
                text: message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: timer,
                timerProgressBar: true,
                background: '#ffffff',
                color: '#1e293b',
                iconColor: icon === 'success' ? '#10b981' : (icon === 'error' ? '#f43f5e' : (icon === 'warning' ? '#f59e0b' : '#3b82f6')),
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                },
                customClass: {
                    popup: 'rounded-2xl shadow-xl border border-slate-100 p-4 mt-4 mr-4',
                    title: 'font-heading font-extrabold text-sm text-slate-800',
                    htmlContainer: 'text-xs text-slate-600',
                }
            });
        };

        // Global Delete Confirmation with SweetAlert2
        document.addEventListener('submit', function(e) {
            const form = e.target;
            const methodInput = form.querySelector('input[name="_method"][value="DELETE"]');
            if (methodInput && !form.dataset.swalConfirmed) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Data Ini?',
                    text: 'Data yang dihapus tidak dapat dipulihkan kembali.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fa-solid fa-trash mr-1.5"></i> Ya, Hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#94a3b8',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-3xl shadow-2xl border border-slate-100 p-6',
                        title: 'font-heading font-extrabold text-lg text-slate-900',
                        htmlContainer: 'text-xs text-slate-500',
                        confirmButton: 'rounded-2xl px-5 py-2.5 font-bold text-xs uppercase tracking-wider shadow-md shadow-rose-600/20 cursor-pointer',
                        cancelButton: 'rounded-2xl px-5 py-2.5 font-bold text-xs uppercase tracking-wider text-slate-700 bg-slate-100 hover:bg-slate-200 border-0 cursor-pointer',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.dataset.swalConfirmed = 'true';
                        form.submit();
                    }
                });
            }
        });

        // Flash Notifications from Laravel Session (Auto-Dismissing Toast)
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                window.showToast('success', 'Berhasil!', "{{ addslashes(session('success')) }}", 2800);
            @endif

            @if(session('error'))
                window.showToast('error', 'Gagal!', "{{ addslashes(session('error')) }}", 3500);
            @endif

            @if(session('info'))
                window.showToast('info', 'Informasi', "{{ addslashes(session('info')) }}", 3000);
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Perhatian!',
                    html: '{!! implode("<br>", array_map("addslashes", $errors->all())) !!}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4500,
                    timerProgressBar: true,
                    background: '#ffffff',
                    color: '#1e293b',
                    iconColor: '#f43f5e',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    },
                    customClass: {
                        popup: 'rounded-2xl shadow-xl border border-rose-100 p-4 mt-4 mr-4',
                        title: 'font-heading font-extrabold text-sm text-slate-800',
                        htmlContainer: 'text-xs text-slate-600 text-left',
                    }
                });
            @endif
        });
    </script>
    @stack('scripts')
</body>
</html>
