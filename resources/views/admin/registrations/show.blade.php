@extends('layouts.admin')

@section('title', 'Detail Peserta - ' . $registration->full_name)
@section('page-title', 'Detail Peserta')

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{ showDeleteModal: false }">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <a href="{{ route('admin.peserta.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Data Peserta</span>
        </a>

        <div class="flex items-center gap-3">
            <!-- Cetak Bukti -->
            <a href="{{ route('public.print-slip', $registration->id) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak Slip</span>
            </a>

            <!-- Edit -->
            <a href="{{ route('admin.peserta.edit', $registration->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 font-bold text-xs transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Edit Data</span>
            </a>

            <!-- Hapus -->
            <button type="button" 
                    @click="showDeleteModal = true" 
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-bold text-xs transition-colors cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <span>Hapus</span>
            </button>
        </div>
    </div>

    <!-- Header Summary Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl {{ $registration->category === 'sd' ? 'bg-amber-100 text-amber-700' : 'bg-sky-100 text-sky-700' }} flex items-center justify-center text-3xl shrink-0 font-bold">
                {{ $registration->category === 'sd' ? '🐱' : '🧱' }}
            </div>
            <div>
                <div class="flex items-center gap-2.5">
                    <h2 class="text-2xl font-black text-slate-900 font-display">{{ $registration->full_name }}</h2>
                    <span class="px-3 py-1 text-xs font-extrabold rounded-lg {{ $registration->category === 'sd' ? 'bg-amber-100 text-amber-800' : 'bg-sky-100 text-sky-800' }}">
                        {{ $registration->package_name }}
                    </span>
                </div>
                <p class="text-sm font-semibold text-slate-500 mt-1">{{ $registration->school }}</p>
            </div>
        </div>

        <div class="text-left sm:text-right bg-slate-50 p-4 rounded-2xl border border-slate-100">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Biaya Paket:</span>
            <div class="text-lg font-black text-rose-600 font-display">Rp 125.000 <span class="text-xs font-normal text-slate-500">/bln</span></div>
        </div>
    </div>

    <!-- 3 Cards Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- CARD 1: DATA PESERTA -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-4">
                <span class="text-lg">🧒</span>
                <h3 class="font-bold text-slate-900 text-base font-display">Data Calon Siswa</h3>
            </div>

            <div class="space-y-3.5 text-sm">
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase">Nama Lengkap</span>
                    <p class="font-bold text-slate-900 text-base">{{ $registration->full_name }}</p>
                </div>

                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase">Tanggal Lahir</span>
                    <p class="font-medium text-slate-800">{{ $registration->birth_date->translatedFormat('d F Y') }} (Usia ~{{ $registration->birth_date->age }} tahun)</p>
                </div>

                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase">Kategori Kelas</span>
                    <p class="font-bold text-slate-800">
                        {{ $registration->package_name }}
                    </p>
                    <p class="text-xs text-slate-500">{{ $registration->package_description }}</p>
                </div>

                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase">Asal Sekolah</span>
                    <p class="font-semibold text-slate-800">{{ $registration->school }}</p>
                </div>
            </div>
        </div>

        <!-- CARD 2: DATA ORANG TUA / WALI -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-4">
                <span class="text-lg">👨‍👩‍👧</span>
                <h3 class="font-bold text-slate-900 text-base font-display">Data Orang Tua / Wali</h3>
            </div>

            <div class="space-y-3.5 text-sm">
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase">Nama Orang Tua / Wali</span>
                    <p class="font-bold text-slate-900 text-base">{{ $registration->parent_name }}</p>
                </div>

                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase">Nomor HP / WhatsApp</span>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="font-mono font-bold text-slate-800">{{ $registration->parent_phone }}</span>
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $registration->parent_phone)) }}" 
                           target="_blank" 
                           class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-bold hover:bg-emerald-200 transition-colors">
                            <span>Hubungi WA</span>
                        </a>
                    </div>
                </div>

                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase">Alamat Lengkap</span>
                    <p class="font-medium text-slate-800 leading-relaxed">{{ $registration->address }}</p>
                </div>
            </div>
        </div>

    </div>

    <!-- CARD 3: INFORMASI PENDAFTARAN -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs">
        <div class="flex items-center gap-2.5 border-b border-slate-100 pb-4 mb-4">
            <span class="text-lg">ℹ️</span>
            <h3 class="font-bold text-slate-900 text-base font-display">Informasi Pendaftaran Sistem</h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase">Waktu Pendaftaran Masuk</span>
                <p class="font-semibold text-slate-800 mt-0.5">
                    {{ $registration->registered_at->translatedFormat('d F Y, H:i:s') }} WIB
                </p>
            </div>

            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase">Terakhir Diperbarui</span>
                <p class="font-semibold text-slate-800 mt-0.5">
                    {{ $registration->updated_at->translatedFormat('d F Y, H:i:s') }} WIB
                </p>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" 
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title" 
         role="dialog" 
         aria-modal="true">
        
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
             x-show="showDeleteModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md p-6 border border-slate-100"
                 x-show="showDeleteModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <div class="w-14 h-14 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-2xl mx-auto mb-4">
                    ⚠️
                </div>

                <h3 class="text-lg font-bold text-center text-slate-900 font-display">Hapus Data Peserta</h3>
                
                <p class="text-slate-600 text-sm text-center mt-2">
                    Apakah Anda yakin ingin menghapus data peserta ini?
                </p>

                <div class="my-4 p-3.5 bg-rose-50 rounded-2xl border border-rose-100 text-center">
                    <p class="text-sm font-bold text-rose-900">{{ $registration->full_name }}</p>
                </div>

                <form action="{{ route('admin.peserta.destroy', $registration->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <div class="flex items-center justify-center gap-3 mt-6">
                        <button type="button" 
                                @click="showDeleteModal = false"
                                class="w-full px-5 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="w-full px-5 py-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-sm shadow-md shadow-rose-600/30 transition-all cursor-pointer">
                            Hapus
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection
