@extends('layouts.app')

@section('title', 'Formulir Pendaftaran - ' . ($category === 'sd' ? 'Code & Play (SD)' : 'Code & Explore (SMP)'))

@section('content')
<div class="py-8 sm:py-12" x-data="registrationForm()">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <!-- Top Urgency Banner -->
        <div class="mb-6 p-3.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-2xl shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
            <div class="flex items-center gap-2 font-bold">
                <span class="px-2 py-0.5 bg-amber-400 text-red-950 font-black rounded-md text-[10px] animate-pulse">🔥 SISA 10 KURSI</span>
                <span>Promo 125rb/bln Terbatas Hari Ini!</span>
            </div>
            <div class="flex items-center gap-1.5 font-mono text-amber-300 font-bold">
                <span class="text-rose-100 font-sans text-[11px]">Sisa Waktu:</span>
                <span class="bg-black/30 px-2 py-0.5 rounded text-white" x-text="hours">00</span>:
                <span class="bg-black/30 px-2 py-0.5 rounded text-white" x-text="minutes">00</span>:
                <span class="bg-black/30 px-2 py-0.5 rounded text-white" x-text="seconds">00</span>
            </div>
        </div>

        <!-- Breadcrumb & Back -->
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('public.landing') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>

            <div class="flex items-center gap-2">
                <span class="px-3.5 py-1 text-xs font-black rounded-full {{ $category === 'sd' ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-sky-100 text-sky-800 border border-sky-300' }}">
                    {{ $category === 'sd' ? '🎮 Code & Play (SD)' : '🏰 Code & Explore (SMP)' }}
                </span>
            </div>
        </div>

        <!-- Header Card with Pricing Callout -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-md border border-indigo-100 mb-8 relative overflow-hidden">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl {{ $category === 'sd' ? 'bg-amber-500 text-white' : 'bg-sky-600 text-white' }} flex items-center justify-center text-3xl shadow-md shrink-0">
                        {{ $category === 'sd' ? '🐱' : '🧱' }}
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 font-display">
                            {{ $category === 'sd' ? 'Code & Play (SD)' : 'Code & Explore (SMP)' }}
                        </h1>
                        <p class="text-slate-600 text-xs sm:text-sm mt-1">
                            {{ $category === 'sd' ? 'Belajar coding dengan animasi interaktif, game mini, dan debugging dasar' : 'Belajar coding dengan desain 3D game dan script dasar' }}
                        </p>
                    </div>
                </div>

                <!-- Price Tag -->
                <div class="bg-rose-50 border-2 border-rose-200 rounded-2xl p-3.5 text-center shrink-0 w-full sm:w-auto">
                    <div class="flex items-center justify-center gap-2 text-xs text-slate-500">
                        <span class="line-through">250rb</span>
                        <span class="line-through">100rb</span>
                    </div>
                    <div class="text-xl font-black text-rose-600 font-display mt-0.5">
                        125rb <span class="text-xs font-bold text-slate-600">/ Bulan</span>
                    </div>
                    <span class="text-[10px] font-bold text-rose-800 bg-amber-300 px-2 py-0.5 rounded-full inline-block mt-1">
                        Sisa 10 Kuota Hari Ini
                    </span>
                </div>
            </div>
        </div>

        <!-- Global Validation Error Summary -->
        @if ($errors->any())
            <div class="mb-8 p-5 bg-rose-50 border-2 border-rose-200 rounded-2xl text-rose-800 shadow-sm">
                <div class="flex items-center gap-2 font-bold text-base mb-2">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>Terdapat beberapa data yang perlu diperbaiki:</span>
                </div>
                <ul class="list-disc list-inside text-sm space-y-1 text-rose-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Form -->
        <form id="registrationFormElement" action="{{ route('public.store') }}" method="POST" @submit.prevent="openConfirmationModal()" class="space-y-8">
            @csrf
            
            <input type="hidden" name="category" value="{{ $category }}">

            <!-- SECTION 1: DATA PESERTA -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-6">
                    <span class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 font-black text-sm flex items-center justify-center border border-indigo-100">1</span>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 font-display">Data Peserta (Anak)</h2>
                        <p class="text-xs text-slate-500">Informasi identitas calon siswa</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="full_name" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Nama Lengkap Peserta <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               id="full_name" 
                               name="full_name" 
                               value="{{ old('full_name') }}"
                               x-model="formData.full_name"
                               required
                               minlength="3"
                               placeholder="Contoh: Muhammad Rayhan Pratama" 
                               class="w-full px-4 py-3.5 rounded-2xl border @error('full_name') border-rose-400 bg-rose-50/30 ring-2 ring-rose-200 @else border-slate-300 bg-slate-50/50 hover:bg-white focus:bg-white @enderror focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400">
                        @error('full_name')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grid: Tanggal Lahir & Kategori Terpilih -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="birth_date" class="block text-sm font-bold text-slate-700 mb-1.5">
                                Tanggal Lahir <span class="text-rose-500">*</span>
                            </label>
                            <input type="date" 
                                   id="birth_date" 
                                   name="birth_date" 
                                   value="{{ old('birth_date') }}"
                                   x-model="formData.birth_date"
                                   required
                                   max="{{ date('Y-m-d') }}"
                                   class="w-full px-4 py-3.5 rounded-2xl border @error('birth_date') border-rose-400 bg-rose-50/30 ring-2 ring-rose-200 @else border-slate-300 bg-slate-50/50 hover:bg-white focus:bg-white @enderror focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all text-sm font-medium text-slate-900">
                            @error('birth_date')
                                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1.5">
                                Kategori Kelas
                            </label>
                            <div class="px-4 py-3.5 rounded-2xl border border-slate-200 bg-slate-100 text-slate-700 text-sm font-bold flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full {{ $category === 'sd' ? 'bg-amber-500' : 'bg-sky-500' }}"></span>
                                    {{ $category === 'sd' ? 'Code & Play (SD)' : 'Code & Explore (SMP)' }}
                                </span>
                                <span class="text-xs text-slate-500 font-normal">Otomatis</span>
                            </div>
                        </div>
                    </div>

                    <!-- Asal Sekolah -->
                    <div>
                        <label for="school" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Asal Sekolah <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               id="school" 
                               name="school" 
                               value="{{ old('school') }}"
                               x-model="formData.school"
                               required
                               placeholder="Contoh: {{ $category === 'sd' ? 'SDIT Nurul Fikri / SD Negeri 01' : 'SMP Negeri 1 / SMP Labschool' }}" 
                               class="w-full px-4 py-3.5 rounded-2xl border @error('school') border-rose-400 bg-rose-50/30 ring-2 ring-rose-200 @else border-slate-300 bg-slate-50/50 hover:bg-white focus:bg-white @enderror focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400">
                        @error('school')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SECTION 2: DATA ORANG TUA / WALI -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-6">
                    <span class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 font-black text-sm flex items-center justify-center border border-amber-100">2</span>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 font-display">Data Orang Tua / Wali</h2>
                        <p class="text-xs text-slate-500">Informasi kontak pendamping untuk pengiriman jadwal &amp; laporan</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <!-- Nama Orang Tua / Wali -->
                    <div>
                        <label for="parent_name" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Nama Orang Tua / Wali <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               id="parent_name" 
                               name="parent_name" 
                               value="{{ old('parent_name') }}"
                               x-model="formData.parent_name"
                               required
                               minlength="3"
                               placeholder="Contoh: Bambang Pratama / Siti Aminah" 
                               class="w-full px-4 py-3.5 rounded-2xl border @error('parent_name') border-rose-400 bg-rose-50/30 ring-2 ring-rose-200 @else border-slate-300 bg-slate-50/50 hover:bg-white focus:bg-white @enderror focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400">
                        @error('parent_name')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor HP (WhatsApp) -->
                    <div>
                        <label for="parent_phone" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Nomor HP / WhatsApp Orang Tua <span class="text-rose-500">*</span>
                        </label>
                        <input type="tel" 
                               id="parent_phone" 
                               name="parent_phone" 
                               value="{{ old('parent_phone') }}"
                               x-model="formData.parent_phone"
                               required
                               placeholder="Contoh: 081234567890" 
                               class="w-full px-4 py-3.5 rounded-2xl border @error('parent_phone') border-rose-400 bg-rose-50/30 ring-2 ring-rose-200 @else border-slate-300 bg-slate-50/50 hover:bg-white focus:bg-white @enderror focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400">
                        @error('parent_phone')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Lengkap -->
                    <div>
                        <label for="address" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Alamat Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="address" 
                                  name="address" 
                                  rows="3" 
                                  x-model="formData.address"
                                  required
                                  placeholder="Contoh: Jl. Boulevard Raya Blok A4 No. 12, Kelapa Gading, Jakarta Utara" 
                                  class="w-full px-4 py-3.5 rounded-2xl border @error('address') border-rose-400 bg-rose-50/30 ring-2 ring-rose-200 @else border-slate-300 bg-slate-50/50 hover:bg-white focus:bg-white @enderror focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SECTION 3: PERSETUJUAN & SUBMISSION -->
            <div class="bg-indigo-50/60 rounded-3xl p-6 sm:p-8 border border-indigo-100">
                <label class="flex items-start gap-3 cursor-pointer select-none">
                    <input type="checkbox" 
                           name="agreement" 
                           id="agreement" 
                           value="1" 
                           {{ old('agreement') ? 'checked' : '' }}
                           x-model="formData.agreement"
                           required
                           class="w-5 h-5 mt-0.5 rounded-lg text-indigo-600 focus:ring-indigo-500 border-slate-300 transition-all cursor-pointer">
                    <span class="text-sm font-semibold text-slate-800 leading-relaxed">
                        Saya memastikan data yang saya masukkan sudah benar.
                    </span>
                </label>
                @error('agreement')
                    <p class="mt-2 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror

                <div class="mt-6 pt-6 border-t border-indigo-100 flex flex-col sm:flex-row items-center justify-end gap-4">
                    <a href="{{ route('public.landing') }}" class="w-full sm:w-auto px-6 py-3.5 text-center text-sm font-bold text-slate-600 hover:text-slate-800 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-red-600 via-rose-600 to-red-600 hover:from-red-700 hover:to-rose-700 text-white font-extrabold text-base rounded-2xl shadow-lg shadow-rose-600/30 hover:shadow-xl hover:-translate-y-0.5 transition-all cursor-pointer">
                        <span>Daftar Sekarang</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </div>

        </form>

        <!-- MODAL KONFIRMASI PENDAFTARAN -->
        <div x-show="showConfirmModal" 
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             aria-labelledby="modal-title" 
             role="dialog" 
             aria-modal="true">
            
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
                 x-show="showConfirmModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"></div>

            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-100"
                     x-show="showConfirmModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <!-- Modal Header -->
                    <div class="bg-gradient-to-r from-red-600 to-rose-600 p-6 text-white text-center">
                        <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-3xl mx-auto mb-3">
                            🔍
                        </div>
                        <h3 class="text-xl font-black font-display" id="modal-title">Konfirmasi Data Pendaftaran</h3>
                        <p class="text-rose-100 text-xs mt-1">Pastikan seluruh data calon peserta dan orang tua sudah tepat.</p>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6 space-y-4 text-sm">
                        <div class="bg-slate-50 rounded-2xl p-4 divide-y divide-slate-200/80 border border-slate-200/70 space-y-3">
                            <div class="flex justify-between pt-1">
                                <span class="text-slate-500 text-xs font-semibold uppercase">Nama:</span>
                                <strong class="text-slate-900 text-right" x-text="formData.full_name"></strong>
                            </div>
                            <div class="flex justify-between pt-3">
                                <span class="text-slate-500 text-xs font-semibold uppercase">Tanggal Lahir:</span>
                                <span class="text-slate-900 font-medium text-right" x-text="formData.birth_date"></span>
                            </div>
                            <div class="flex justify-between pt-3">
                                <span class="text-slate-500 text-xs font-semibold uppercase">Sekolah:</span>
                                <span class="text-slate-900 font-medium text-right" x-text="formData.school"></span>
                            </div>
                            <div class="flex justify-between pt-3">
                                <span class="text-slate-500 text-xs font-semibold uppercase">Kategori Kelas:</span>
                                <span class="px-2.5 py-0.5 text-xs font-bold rounded-md {{ $category === 'sd' ? 'bg-amber-100 text-amber-800' : 'bg-sky-100 text-sky-800' }}">
                                    {{ $category === 'sd' ? 'Code & Play (SD)' : 'Code & Explore (SMP)' }}
                                </span>
                            </div>
                            <div class="flex justify-between pt-3">
                                <span class="text-slate-500 text-xs font-semibold uppercase">Nama Orang Tua/Wali:</span>
                                <strong class="text-slate-900 text-right" x-text="formData.parent_name"></strong>
                            </div>
                            <div class="flex justify-between pt-3">
                                <span class="text-slate-500 text-xs font-semibold uppercase">Nomor HP:</span>
                                <span class="text-slate-900 font-medium text-right font-mono" x-text="formData.parent_phone"></span>
                            </div>
                            <div class="flex flex-col pt-3">
                                <span class="text-slate-500 text-xs font-semibold uppercase mb-1">Alamat:</span>
                                <span class="text-slate-800 text-xs leading-relaxed" x-text="formData.address"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                        <button type="button" 
                                @click="showConfirmModal = false"
                                class="w-full sm:w-auto px-5 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm transition-all cursor-pointer">
                            Kembali Edit
                        </button>
                        <button type="button" 
                                @click="submitFinalForm()"
                                :disabled="isSubmitting"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-extrabold text-sm shadow-md transition-all disabled:opacity-50 cursor-pointer">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Konfirmasi Pendaftaran'"></span>
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function registrationForm() {
        return {
            showConfirmModal: false,
            isSubmitting: false,
            hours: '00',
            minutes: '00',
            seconds: '00',
            formData: {
                full_name: '{{ old('full_name', '') }}',
                birth_date: '{{ old('birth_date', '') }}',
                school: '{{ old('school', '') }}',
                parent_name: '{{ old('parent_name', '') }}',
                parent_phone: '{{ old('parent_phone', '') }}',
                address: '{{ old('address', '') }}',
                agreement: {{ old('agreement') ? 'true' : 'false' }}
            },
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
            },
            openConfirmationModal() {
                const form = document.getElementById('registrationFormElement');
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
                this.showConfirmModal = true;
            },
            submitFinalForm() {
                this.isSubmitting = true;
                const form = document.getElementById('registrationFormElement');
                form.submit();
            }
        };
    }
</script>
@endpush
