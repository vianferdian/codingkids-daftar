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
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-indigo-100/70 shadow-xs" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Logo -->
                <a href="{{ route('public.landing') }}" class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
                    <div class="w-9 h-9 sm:w-11 sm:h-11 rounded-xl sm:rounded-2xl bg-gradient-to-tr from-indigo-600 via-blue-500 to-amber-400 p-0.5 shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform duration-300">
                        <div class="w-full h-full bg-white rounded-[10px] sm:rounded-[14px] flex items-center justify-center">
                            <span class="text-lg sm:text-2xl font-black bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent font-display">🚀</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-lg sm:text-2xl font-bold tracking-tight text-slate-900 font-display leading-tight">Coding<span class="text-indigo-600">Kids</span></span>
                            <span class="px-1.5 py-0.5 text-[10px] sm:text-xs font-bold bg-amber-100 text-amber-800 rounded-full border border-amber-200">SD &amp; SMP</span>
                        </div>
                        <p class="hidden sm:block text-xs text-slate-500 font-medium -mt-0.5">Platform Pendaftaran Coding Anak</p>
                    </div>
                </a>

                <!-- Nav Links Desktop -->
                <nav class="hidden md:flex items-center gap-6">
                    <a href="{{ route('public.landing') }}#kategori" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Pilihan Kategori</a>
                    <a href="{{ route('public.landing') }}#keunggulan" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Mengapa CodingKids?</a>
                    <a href="{{ route('public.landing') }}#faq" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Tanya Jawab</a>
                </nav>

                <!-- Actions & Mobile Hamburger -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('public.landing') }}#kategori" class="inline-flex items-center gap-1.5 sm:gap-2 px-3.5 py-2 sm:px-5 sm:py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-indigo-600/25 hover:shadow-lg hover:shadow-indigo-600/35 hover:-translate-y-0.5 transition-all">
                        <span>Daftar Sekarang</span>
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>

                    <!-- Mobile Hamburger Button -->
                    <button type="button" 
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="md:hidden inline-flex items-center justify-center p-2 rounded-xl text-slate-700 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none transition-colors"
                            aria-label="Buka Menu Navigasi">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.away="mobileMenuOpen = false"
             class="md:hidden bg-white/95 backdrop-blur-md border-b border-indigo-100 px-4 pt-3 pb-5 space-y-3 shadow-lg">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('public.landing') }}#kategori" 
                   @click="mobileMenuOpen = false"
                   class="px-3 py-2.5 rounded-xl text-sm font-bold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    🎯 Pilihan Kategori Kelas
                </a>
                <a href="{{ route('public.landing') }}#keunggulan" 
                   @click="mobileMenuOpen = false"
                   class="px-3 py-2.5 rounded-xl text-sm font-bold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    ⭐ Mengapa CodingKids?
                </a>
                <a href="{{ route('public.landing') }}#faq" 
                   @click="mobileMenuOpen = false"
                   class="px-3 py-2.5 rounded-xl text-sm font-bold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    ❓ Tanya Jawab (FAQ)
                </a>
            </div>

            <div class="pt-2 border-t border-slate-100 grid grid-cols-2 gap-2">
                <a href="{{ route('public.register', 'sd') }}" 
                   @click="mobileMenuOpen = false"
                   class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 font-bold text-xs text-center hover:bg-amber-100 transition-colors">
                    <span>🎮 Kelas SD</span>
                </a>
                <a href="{{ route('public.register', 'smp') }}" 
                   @click="mobileMenuOpen = false"
                   class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl bg-sky-50 border border-sky-200 text-sky-900 font-bold text-xs text-center hover:bg-sky-100 transition-colors">
                    <span>🏰 Kelas SMP</span>
                </a>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
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
            </div>

            <div class="pt-8 border-t border-slate-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} CodingKids Indonesia. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
