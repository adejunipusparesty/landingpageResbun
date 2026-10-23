<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas Admin - RSIA Restu Bunda</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3 { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-tr from-emerald-950 via-slate-900 to-emerald-900 min-h-screen flex items-center justify-center p-4">

    <!-- Decorative background elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-teal-500/10 blur-3xl"></div>
    </div>

    <div class="max-w-md w-full relative z-10">
        <!-- Back to Home link -->
        <div class="mb-6 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-emerald-300 hover:text-white transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Website RSIA Restu Bunda</span>
            </a>
        </div>

        <!-- Login Card -->
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl p-8 sm:p-10 shadow-2xl border border-white/20">
            <!-- Brand header -->
            <div class="text-center mb-8">
                <div class="p-3 rounded-2xl bg-white shadow-md border border-slate-100 inline-block mx-auto mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="RSIA Restu Bunda" class="h-12 w-auto object-contain">
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Portal Admin RSIA</h2>
                <p class="text-xs text-slate-500 mt-1">Sistem Manajemen &amp; Pelayanan Pasien Terpadu</p>
            </div>
            <!-- Form -->
            <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Petugas</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-regular fa-envelope text-xs"></i>
                        </div>
                        <input type="email" id="emailInput" name="email" value="[EMAIL_ADDRESS]" required placeholder="Masukkan email Anda" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-xs font-medium text-slate-800 focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </div>
                        <input type="password" id="passwordInput" name="password" value="" required placeholder="Masukkan kata sandi" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-xs font-medium text-slate-800 focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span>Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs uppercase tracking-wider shadow-lg shadow-emerald-600/30 transition active:scale-[0.98] flex items-center justify-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Masuk ke Dashboard</span>
                </button>
            </form>

            <!-- Quick Demo Button -->
            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <span class="text-[11px] text-slate-400 block mb-2 font-medium">Akun Pengujian Demo Tersedia:</span>
                <button type="button" onclick="fillDemoCredentials()" class="w-full py-2.5 px-4 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-bold transition border border-emerald-200 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-key text-xs"></i>
                    <span>Gunakan Akun Demo (admin@restubunda.co.id)</span>
                </button>
            </div>
        </div>

        <p class="text-center text-xs text-emerald-400/60 mt-6">&copy; {{ date('Y') }} RSIA Restu Bunda IT Systems</p>
    </div>

    <script>
        function fillDemoCredentials() {
            document.getElementById('emailInput').value = 'admin@restubunda.co.id';
            document.getElementById('passwordInput').value = 'admin123';
        }
    </script>
    <!-- SweetAlert2 (Local, Offline-ready) -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: "{{ addslashes(session('info')) }}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#ffffff',
                    color: '#1e293b',
                    iconColor: '#3b82f6',
                    customClass: {
                        popup: 'rounded-2xl shadow-xl border border-blue-100 p-4 mt-4 mr-4',
                        title: 'font-heading font-extrabold text-sm text-slate-800',
                        htmlContainer: 'text-xs text-slate-600',
                    }
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    html: '{!! implode("<br>", array_map("addslashes", $errors->all())) !!}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    background: '#ffffff',
                    color: '#1e293b',
                    iconColor: '#f43f5e',
                    customClass: {
                        popup: 'rounded-2xl shadow-xl border border-rose-100 p-4 mt-4 mr-4',
                        title: 'font-heading font-extrabold text-sm text-slate-800',
                        htmlContainer: 'text-xs text-slate-600 text-left',
                    }
                });
            @endif
        });
    </script>
</body>
</html>
