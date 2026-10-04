@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - CodingKids')

@section('content')
<div class="py-10 sm:py-16">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">

        <!-- Main Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-indigo-100 text-center relative overflow-hidden">
            
            <!-- Glow Background -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-64 h-32 bg-emerald-200/40 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Success Icon -->
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-3xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-4xl sm:text-5xl mx-auto mb-6 shadow-lg shadow-emerald-500/10">
                🎉
            </div>

            <!-- Title & Subtitle -->
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200 mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Status: Pendaftaran Berhasil
            </span>

            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 font-display">
                Pendaftaran Berhasil!
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-2 max-w-md mx-auto">
                Terima kasih, data calon peserta telah tersimpan di sistem kami. Tim kami akan segera menghubungi Anda.
            </p>

            <!-- Price & Promo Confirmation Box -->
            <div class="my-6 p-4 rounded-2xl bg-gradient-to-r from-red-50 to-rose-50 border border-rose-200 flex items-center justify-between text-left">
                <div>
                    <span class="text-xs font-bold text-rose-800 uppercase tracking-wide">Paket Kelas:</span>
                    <p class="text-base font-black text-slate-900 font-display">{{ $registration->package_name }}</p>
                </div>
                <div class="text-right">
                    <span class="text-[11px] text-slate-500 line-through">Rp 250.000</span>
                    <p class="text-lg font-black text-rose-600 font-display">Rp 125.000 <span class="text-xs font-normal text-slate-600">/bln</span></p>
                </div>
            </div>

            <!-- Detail Info Summary Card -->
            <div class="bg-slate-50/80 rounded-2xl p-5 text-left border border-slate-200/70 divide-y divide-slate-200/60 space-y-3 mb-8 text-sm">
                <div class="flex justify-between items-center pt-1">
                    <span class="text-slate-500 font-medium text-xs">Nama Peserta:</span>
                    <strong class="text-slate-900 font-bold text-base text-right">{{ $registration->full_name }}</strong>
                </div>
                <div class="flex justify-between items-center pt-3">
                    <span class="text-slate-500 font-medium text-xs">Kategori:</span>
                    <span class="px-3 py-1 text-xs font-extrabold rounded-lg {{ $registration->category === 'sd' ? 'bg-amber-100 text-amber-800' : 'bg-sky-100 text-sky-800' }}">
                        {{ $registration->category === 'sd' ? 'Code & Play (SD)' : 'Code & Explore (SMP)' }}
                    </span>
                </div>
                <div class="flex justify-between items-center pt-3">
                    <span class="text-slate-500 font-medium text-xs">Asal Sekolah:</span>
                    <span class="text-slate-800 font-semibold text-right">{{ $registration->school }}</span>
                </div>
                <div class="flex justify-between items-center pt-3">
                    <span class="text-slate-500 font-medium text-xs">Nama Orang Tua/Wali:</span>
                    <span class="text-slate-800 font-semibold text-right">{{ $registration->parent_name }}</span>
                </div>
                <div class="flex justify-between items-center pt-3">
                    <span class="text-slate-500 font-medium text-xs">Nomor HP / WhatsApp:</span>
                    <span class="text-slate-800 font-mono font-semibold text-right">{{ $registration->parent_phone }}</span>
                </div>
                <div class="flex justify-between items-center pt-3">
                    <span class="text-slate-500 font-medium text-xs">Tanggal Pendaftaran:</span>
                    <span class="text-slate-800 font-medium text-right">{{ $registration->registered_at->translatedFormat('d F Y, H:i') }} WIB</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('public.print-slip', $registration->id) }}" 
                   target="_blank"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-4 bg-gradient-to-r from-indigo-600 via-blue-600 to-indigo-700 hover:from-indigo-700 hover:to-blue-800 text-white font-extrabold text-sm rounded-2xl shadow-lg shadow-indigo-600/25 hover:shadow-xl hover:-translate-y-0.5 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Cetak Bukti Pendaftaran</span>
                </a>

                <a href="{{ route('public.landing') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm rounded-2xl transition-all">
                    <span>Kembali ke Beranda</span>
                </a>
            </div>

            <p class="text-xs text-slate-400 mt-6">
                Tim mentor CodingKids akan menghubungi via WhatsApp untuk konfirmasi jadwal kelas dan pengenalan mentor.
            </p>

        </div>

    </div>
</div>
@endsection
