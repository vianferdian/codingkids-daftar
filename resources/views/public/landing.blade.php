@extends('layouts.app')

@section('title', 'CodingKids - Pendaftaran Peserta Kursus Coding Anak SD & SMP')

@section('content')
<div class="overflow-hidden" x-data="dailyCountdown()">

    <!-- Sticky / Top Urgency Bar -->
    <div class="bg-gradient-to-r from-red-600 via-rose-600 to-red-600 text-white py-2.5 px-4 shadow-sm relative z-20">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-xs sm:text-sm font-bold">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full bg-amber-400 text-red-950 font-black text-[11px] animate-pulse">
                    🔥 KUOTA TERBATAS
                </span>
                <span>Promo Hari Ini: Sisa <strong class="text-amber-300 underline font-black text-sm">10 Kursi Lagi</strong>!</span>
            </div>

            <!-- Countdown Timer Header -->
            <div class="flex items-center gap-2 font-mono">
                <span class="text-rose-100 font-sans font-medium text-xs">Sisa Waktu Promo:</span>
                <div class="flex items-center gap-1">
                    <span class="bg-black/30 px-2 py-0.5 rounded-md text-amber-300 font-black text-xs sm:text-sm" x-text="hours">00</span>
                    <span>:</span>
                    <span class="bg-black/30 px-2 py-0.5 rounded-md text-amber-300 font-black text-xs sm:text-sm" x-text="minutes">00</span>
                    <span>:</span>
                    <span class="bg-black/30 px-2 py-0.5 rounded-md text-amber-300 font-black text-xs sm:text-sm" x-text="seconds">00</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative pt-8 pb-14 lg:pt-12 lg:pb-18 hero-pattern">
        <!-- Glow Orbs -->
        <div class="absolute top-10 left-1/2 -translate-x-1/2 w-96 h-96 bg-indigo-300/25 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-amber-200/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-5">
                
                <!-- Bubbly Header Badge -->
                <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white border border-indigo-100 shadow-sm text-xs sm:text-sm font-bold text-indigo-700">
                    <span class="text-lg">🤖</span>
                    <span>CODING CLASS UNTUK GENERASI JUARA</span>
                    <span class="text-lg">🚀</span>
                </div>

                <!-- Main Title -->
                <h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-[1.1] font-display">
                    CODING <span class="bg-gradient-to-r from-indigo-600 via-blue-600 to-sky-500 bg-clip-text text-transparent">KIDS</span>
                </h1>

                <div class="inline-block px-6 py-2 bg-amber-800 text-amber-100 font-extrabold text-sm sm:text-base rounded-2xl shadow-md transform -rotate-1">
                    ✨ CODING CLASS SD &amp; SMP ✨
                </div>

                <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto">
                    Bimbing buah hati Anda menjadi kreator teknologi dengan belajar coding interaktif, pembuatan game, animasi, dan logika algoritma yang menyenangkan!
                </p>

                <!-- Value Highlights (Pills from Poster) -->
                <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-purple-200 shadow-xs text-xs sm:text-sm font-bold text-purple-700">
                        <span class="text-base">🎮</span>
                        <span>Hasil karya siswa</span>
                    </div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-amber-200 shadow-xs text-xs sm:text-sm font-bold text-amber-700">
                        <span class="text-base">📑</span>
                        <span>Progress report anak</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- PROMO & PRICING BANNER DENGAN HITUNG MUNDUR & KUOTA TERSISA 10 -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 -mt-6 mb-10 relative z-10">
        <div class="bg-white rounded-3xl p-6 sm:p-8 border-2 border-rose-200 shadow-xl relative overflow-hidden">
            
            <!-- Quota & Timer Bar Inside Banner -->
            <div class="mb-6 p-4 rounded-2xl bg-gradient-to-r from-amber-50 to-rose-50 border border-rose-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                
                <!-- Sisa Kuota 10 -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-600 text-white flex items-center justify-center text-xl shrink-0 shadow-sm animate-bounce">
                        🔥
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-slate-700">Kuota Promo Hari Ini:</span>
                            <span class="px-2.5 py-0.5 bg-rose-600 text-white font-black text-xs rounded-full">Sisa 10 Kursi</span>
                        </div>
                        <div class="w-48 sm:w-56 bg-slate-200 h-2 rounded-full mt-1.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-400 to-rose-600 h-full rounded-full" style="width: 50%"></div>
                        </div>
                    </div>
                </div>

                <!-- Live Daily Countdown Blocks -->
                <div class="flex items-center justify-center sm:justify-end gap-1.5 font-mono text-slate-900">
                    <div class="bg-slate-900 text-amber-300 font-black text-sm px-2.5 py-1 rounded-lg shadow-xs">
                        <span x-text="hours">00</span><span class="text-[9px] text-slate-400 block -mt-1 font-sans">Jam</span>
                    </div>
                    <span class="font-bold">:</span>
                    <div class="bg-slate-900 text-amber-300 font-black text-sm px-2.5 py-1 rounded-lg shadow-xs">
                        <span x-text="minutes">00</span><span class="text-[9px] text-slate-400 block -mt-1 font-sans">Mnt</span>
                    </div>
                    <span class="font-bold">:</span>
                    <div class="bg-slate-900 text-amber-300 font-black text-sm px-2.5 py-1 rounded-lg shadow-xs">
                        <span x-text="seconds">00</span><span class="text-[9px] text-slate-400 block -mt-1 font-sans">Dtk</span>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                
                <!-- Strike-through Normal Prices -->
                <div class="md:col-span-6 flex items-center justify-center md:justify-start gap-6 border-b md:border-b-0 md:border-r border-slate-200 pb-5 md:pb-0 md:pr-6">
                    <div class="text-center">
                        <p class="text-xs font-semibold text-slate-500 mb-1">Harga kursus per bulan</p>
                        <div class="relative inline-block">
                            <span class="text-2xl sm:text-3xl font-black text-slate-800 font-display">250rb</span>
                            <div class="absolute inset-x-0 top-1/2 h-1 bg-rose-500 transform -rotate-12 rounded-full"></div>
                        </div>
                    </div>

                    <div class="h-10 w-px bg-slate-200 hidden sm:block"></div>

                    <div class="text-center">
                        <p class="text-xs font-semibold text-slate-500 mb-1">Biaya registrasi</p>
                        <div class="relative inline-block">
                            <span class="text-2xl sm:text-3xl font-black text-slate-800 font-display">100rb</span>
                            <div class="absolute inset-x-0 top-1/2 h-1 bg-rose-500 transform -rotate-12 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Promo Price Highlight Bubble -->
                <div class="md:col-span-6 text-center">
                    <div class="relative inline-block bg-gradient-to-r from-red-600 via-rose-600 to-red-600 text-white rounded-3xl p-5 sm:p-6 shadow-lg shadow-rose-600/30">
                        <span class="block text-xs font-bold uppercase tracking-wider text-amber-200 mb-0.5">Cukup</span>
                        <div class="flex items-baseline justify-center gap-1.5">
                            <span class="text-4xl sm:text-5xl font-black text-amber-300 font-display tracking-tight">125rb</span>
                            <span class="text-sm sm:text-base font-bold text-white">/ Bulan</span>
                        </div>
                        <div class="mt-2 inline-block px-3 py-1 bg-amber-400 text-red-950 text-xs font-black rounded-full shadow-xs uppercase tracking-wide">
                            Khusus 20 Pendaftar pertama
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Action Red Strip -->
            <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                <a href="#kategori" class="inline-flex items-center justify-center gap-2 w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-black text-sm sm:text-base shadow-md uppercase tracking-wider hover:scale-[1.01] transition-all">
                    <span>KELAS TERBATAS! KLIK PILIH KATEGORI UNTUK DAFTAR</span>
                    <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

        </div>
    </section>

    <!-- Category Selection Cards -->
    <section id="kategori" class="py-8 bg-slate-50 relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-8">
                <span class="text-xs sm:text-sm font-bold tracking-wider text-indigo-600 uppercase bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                    Pilihan Program Belajar
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-2 font-display">
                    Pilih Kategori Kelas Anak
                </h2>
                <p class="text-slate-600 mt-1 text-sm sm:text-base">
                    Pilih jenjang Sekolah Dasar (SD) atau Sekolah Menengah Pertama (SMP) untuk langsung mengisi form pendaftaran.
                </p>
            </div>

            <!-- 2 Category Cards with Strike-Through Pricing -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- CARD 1: SD (Code & Play) -->
                <div class="bg-white rounded-3xl p-8 border-2 border-amber-200/90 hover:border-amber-400 shadow-md hover:shadow-xl transition-all flex flex-col justify-between relative group hover:-translate-y-1">
                    
                    <div class="absolute -top-3.5 right-6">
                        <span class="px-3.5 py-1 text-xs font-black uppercase tracking-wider bg-amber-500 text-white rounded-full shadow-sm">
                            Tingkat SD
                        </span>
                    </div>

                    <div>
                        <!-- Header with Cat / Game Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-3xl shadow-xs group-hover:scale-110 transition-transform">
                                    🎮
                                </div>
                                <div>
                                    <h3 class="text-2xl font-black text-slate-900 font-display">Code &amp; Play</h3>
                                    <span class="text-xs font-bold text-amber-600 uppercase tracking-wide">Kategori SD</span>
                                </div>
                            </div>
                            <span class="text-3xl">🐱</span>
                        </div>

                        <p class="text-slate-700 text-sm sm:text-base font-medium leading-relaxed my-4 bg-amber-50/60 p-5 rounded-2xl border border-amber-100">
                            "Belajar coding dengan animasi interaktif, game mini, dan debugging dasar"
                        </p>

                        <!-- Harga Coret Card Box -->
                        <div class="my-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                            <div class="flex items-center justify-between text-xs text-slate-500 pb-2 border-b border-slate-200">
                                <span>Harga Normal Kursus:</span>
                                <div class="flex items-center gap-2">
                                    <span class="line-through text-rose-500 font-bold">250rb</span>
                                    <span class="line-through text-rose-400 text-[11px]">+ Reg 100rb</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-2">
                                <div>
                                    <span class="text-xs font-bold text-slate-700">Promo Pendaftar:</span>
                                    <span class="block text-[10px] text-amber-800 font-semibold">Sisa 10 Kuota Hari Ini</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl sm:text-2xl font-black text-rose-600 font-display">125rb <span class="text-xs font-bold text-slate-600">/ Bulan</span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('public.register', 'sd') }}" class="w-full inline-flex items-center justify-center gap-2.5 px-6 py-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-black text-base rounded-2xl shadow-md shadow-amber-500/30 hover:shadow-lg transition-all mt-2 cursor-pointer">
                        <span>Daftar Kategori SD</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>

                <!-- CARD 2: SMP (Code & Explore) -->
                <div class="bg-white rounded-3xl p-8 border-2 border-sky-200/90 hover:border-sky-400 shadow-md hover:shadow-xl transition-all flex flex-col justify-between relative group hover:-translate-y-1">
                    
                    <div class="absolute -top-3.5 right-6">
                        <span class="px-3.5 py-1 text-xs font-black uppercase tracking-wider bg-sky-600 text-white rounded-full shadow-sm">
                            Tingkat SMP
                        </span>
                    </div>

                    <div>
                        <!-- Header with 3D Castle Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-14 h-14 rounded-2xl bg-sky-100 text-sky-700 flex items-center justify-center text-3xl shadow-xs group-hover:scale-110 transition-transform">
                                    🏰
                                </div>
                                <div>
                                    <h3 class="text-2xl font-black text-slate-900 font-display">Code &amp; Explore</h3>
                                    <span class="text-xs font-bold text-sky-600 uppercase tracking-wide">Kategori SMP</span>
                                </div>
                            </div>
                            <span class="text-3xl">🧱</span>
                        </div>

                        <p class="text-slate-700 text-sm sm:text-base font-medium leading-relaxed my-4 bg-sky-50/60 p-5 rounded-2xl border border-sky-100">
                            "Belajar coding dengan desain 3D game dan script dasar"
                        </p>

                        <!-- Harga Coret Card Box -->
                        <div class="my-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                            <div class="flex items-center justify-between text-xs text-slate-500 pb-2 border-b border-slate-200">
                                <span>Harga Normal Kursus:</span>
                                <div class="flex items-center gap-2">
                                    <span class="line-through text-rose-500 font-bold">250rb</span>
                                    <span class="line-through text-rose-400 text-[11px]">+ Reg 100rb</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-2">
                                <div>
                                    <span class="text-xs font-bold text-slate-700">Promo Pendaftar:</span>
                                    <span class="block text-[10px] text-sky-800 font-semibold">Sisa 10 Kuota Hari Ini</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl sm:text-2xl font-black text-rose-600 font-display">125rb <span class="text-xs font-bold text-slate-600">/ Bulan</span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('public.register', 'smp') }}" class="w-full inline-flex items-center justify-center gap-2.5 px-6 py-4 bg-gradient-to-r from-sky-600 to-indigo-600 hover:from-sky-700 hover:to-indigo-700 text-white font-black text-base rounded-2xl shadow-md shadow-sky-600/30 hover:shadow-lg transition-all mt-2 cursor-pointer">
                        <span>Daftar Kategori SMP</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    function dailyCountdown() {
        return {
            hours: '00',
            minutes: '00',
            seconds: '00',
            init() {
                this.updateTimer();
                setInterval(() => {
                    this.updateTimer();
                }, 1000);
            },
            updateTimer() {
                const now = new Date();
                const endOfDay = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59);
                let diff = Math.floor((endOfDay.getTime() - now.getTime()) / 1000);

                if (diff < 0) {
                    diff = 0;
                }

                const h = Math.floor(diff / 3600);
                const m = Math.floor((diff % 3600) / 60);
                const s = diff % 60;

                this.hours = String(h).padStart(2, '0');
                this.minutes = String(m).padStart(2, '0');
                this.seconds = String(s).padStart(2, '0');
            }
        };
    }
</script>
@endpush
