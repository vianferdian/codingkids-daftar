<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CodingKids - Pendaftaran Peserta Kursus Coding Anak SD & SMP')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-display {
            font-family: 'Fredoka', cursive, sans-serif;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-indigo-50/70 via-sky-50/50 to-amber-50/60 min-h-screen flex flex-col text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <header class="sticky top-0 z-40 bg-white/85 backdrop-blur-md border-b border-indigo-100/70 shadow-xs">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('public.landing') }}" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-600 via-blue-500 to-amber-400 p-0.5 shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform duration-300">
                        <div class="w-full h-full bg-white rounded-[14px] flex items-center justify-center">
                            <span class="text-2xl font-black bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent font-display">🚀</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-2xl font-bold tracking-tight text-slate-900 font-display">Coding<span class="text-indigo-600">Kids</span></span>
                            <span class="px-2 py-0.5 text-xs font-bold bg-amber-100 text-amber-800 rounded-full border border-amber-200">SD &amp; SMP</span>
                        </div>
                        <p class="text-xs text-slate-700 font-medium">Platform Pendaftaran Coding Anak</p>
                    </div>
                </a>

                <!-- Nav Links -->
                <nav class="hidden md:flex items-center gap-6">
                    <a href="{{ route('public.landing') }}#kategori" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Pilihan Kategori</a>
                    <a href="{{ route('public.landing') }}#keunggulan" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Mengapa CodingKids?</a>
                    <a href="{{ route('public.landing') }}#faq" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Tanya Jawab</a>
                </nav>

                <!-- Actions -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs sm:text-sm font-semibold text-slate-600 hover:text-indigo-600 bg-slate-100 hover:bg-indigo-50 rounded-xl transition-all">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <span>Portal Admin</span>
                    </a>
                    <a href="{{ route('public.landing') }}#kategori" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold text-sm rounded-xl shadow-md shadow-indigo-600/25 hover:shadow-lg hover:shadow-indigo-600/35 hover:-translate-y-0.5 transition-all">
                        <span>Daftar Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Notification Banner -->
    @if(session('success'))
        <div class="max-w-5xl mx-auto px-4 sm:px-6 pt-4 w-full">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl flex items-start gap-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm font-medium">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-5xl mx-auto px-4 sm:px-6 pt-4 w-full">
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-2xl flex items-start gap-3 shadow-sm">
                <svg class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm font-medium">{{ session('error') }}</div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-12 pb-8 border-t border-slate-800 mt-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Col 1 -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-xl">
                            🚀
                        </div>
                        <span class="text-2xl font-black text-white font-display">Coding<span class="text-indigo-400">Kids</span></span>
                    </div>
                    <p class="text-slate-400 text-sm max-w-md leading-relaxed">
                        Membimbing generasi muda Indonesia menguasai logika pemrograman, kecerdasan buatan, dan kreativitas teknologi secara menyenangkan dan ramah anak.
                    </p>
                    <div class="flex items-center gap-3 pt-2 text-xs text-slate-400 font-medium">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-800 border border-slate-700">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Pendaftaran Dibuka
                        </span>
                        <span>Tingkat SD &amp; SMP</span>
                    </div>
                </div>

                <!-- Col 2 -->
                <div class="space-y-3">
                    <h4 class="text-white font-bold text-sm tracking-wider uppercase">Pilihan Kelas</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('public.register', 'sd') }}" class="hover:text-amber-400 transition-colors">✨ Kelas Coding SD (Scratch &amp; Robotik)</a></li>
                        <li><a href="{{ route('public.register', 'smp') }}" class="hover:text-cyan-400 transition-colors">⚡ Kelas Coding SMP (Python &amp; Web)</a></li>
                        <li><a href="{{ route('public.landing') }}#keunggulan" class="hover:text-indigo-400 transition-colors">🎯 Kurikulum &amp; Silabus</a></li>
                    </ul>
                </div>

                <!-- Col 3 -->
                <div class="space-y-3">
                    <h4 class="text-white font-bold text-sm tracking-wider uppercase">Bantuan &amp; Kontak</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li class="flex items-center gap-2">
                            <span>📞 WhatsApp:</span> <strong class="text-white">0812-3456-7890</strong>
                        </li>
                        <li class="flex items-center gap-2">
                            <span>✉️ Email:</span> <span class="text-white">halo@codingkids.id</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span>📍 Lokasi:</span> <span class="text-white">Jakarta, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} CodingKids Indonesia. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.login') }}" class="text-slate-400 hover:text-white transition-colors">Akses Administrator</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
