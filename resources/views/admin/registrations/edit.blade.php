@extends('layouts.admin')

@section('title', 'Edit Peserta - ' . $registration->full_name)
@section('page-title', 'Edit Data Peserta')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Back Button -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.peserta.show', $registration->id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Detail Peserta</span>
        </a>

        <span class="text-xs font-bold text-slate-700 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
            {{ $registration->package_name }}
        </span>
    </div>

    <!-- Error Summary -->
    @if ($errors->any())
        <div class="p-5 bg-rose-50 border-2 border-rose-200 rounded-2xl text-rose-800 shadow-sm">
            <div class="flex items-center gap-2 font-bold text-sm mb-2">
                <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>Mohon periksa data berikut:</span>
            </div>
            <ul class="list-disc list-inside text-xs space-y-1 text-rose-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
        
        <form action="{{ route('admin.peserta.update', $registration->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- SECTION 1: PESERTA -->
            <div class="space-y-4">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900 font-display">Data Calon Siswa</h3>
                    <p class="text-xs text-slate-500">Perbarui informasi identitas peserta kursus</p>
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label for="full_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nama Lengkap Peserta <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="full_name" 
                           name="full_name" 
                           value="{{ old('full_name', $registration->full_name) }}" 
                           required 
                           class="w-full px-4 py-3 rounded-2xl bg-slate-50 border @error('full_name') border-rose-400 @else border-slate-300 @enderror text-sm font-medium focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('full_name')
                        <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grid: Tanggal Lahir & Kategori -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="birth_date" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Tanggal Lahir <span class="text-rose-500">*</span>
                        </label>
                        <input type="date" 
                               id="birth_date" 
                               name="birth_date" 
                               value="{{ old('birth_date', $registration->birth_date->format('Y-m-d')) }}" 
                               required 
                               class="w-full px-4 py-3 rounded-2xl bg-slate-50 border @error('birth_date') border-rose-400 @else border-slate-300 @enderror text-sm font-medium focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('birth_date')
                        <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Kategori Kelas <span class="text-rose-500">*</span>
                    </label>
                    <select id="category" 
                            name="category" 
                            required
                            class="w-full px-4 py-3 rounded-2xl bg-slate-50 border @error('category') border-rose-400 @else border-slate-300 @enderror text-sm font-medium focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        <option value="sd" {{ old('category', $registration->category) === 'sd' ? 'selected' : '' }}>Code &amp; Play (SD)</option>
                        <option value="smp" {{ old('category', $registration->category) === 'smp' ? 'selected' : '' }}>Code &amp; Explore (SMP)</option>
                    </select>
                    @error('category')
                        <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Asal Sekolah -->
            <div>
                <label for="school" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Asal Sekolah <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       id="school" 
                       name="school" 
                       value="{{ old('school', $registration->school) }}" 
                       required 
                       class="w-full px-4 py-3 rounded-2xl bg-slate-50 border @error('school') border-rose-400 @else border-slate-300 @enderror text-sm font-medium focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                @error('school')
                    <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- SECTION 2: ORANG TUA / WALI -->
            <div class="space-y-4 pt-4">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900 font-display">Data Orang Tua / Wali</h3>
                    <p class="text-xs text-slate-500">Informasi kontak pendamping anak</p>
                </div>

                <div>
                    <label for="parent_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nama Orang Tua / Wali <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="parent_name" 
                           name="parent_name" 
                           value="{{ old('parent_name', $registration->parent_name) }}" 
                           required 
                           class="w-full px-4 py-3 rounded-2xl bg-slate-50 border @error('parent_name') border-rose-400 @else border-slate-300 @enderror text-sm font-medium focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('parent_name')
                        <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="parent_phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nomor HP / WhatsApp <span class="text-rose-500">*</span>
                    </label>
                    <input type="tel" 
                           id="parent_phone" 
                           name="parent_phone" 
                           value="{{ old('parent_phone', $registration->parent_phone) }}" 
                           required 
                           class="w-full px-4 py-3 rounded-2xl bg-slate-50 border @error('parent_phone') border-rose-400 @else border-slate-300 @enderror text-sm font-medium focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('parent_phone')
                        <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Alamat Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="address" 
                              name="address" 
                              rows="3" 
                              required 
                              class="w-full px-4 py-3 rounded-2xl bg-slate-50 border @error('address') border-rose-400 @else border-slate-300 @enderror text-sm font-medium focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('address', $registration->address) }}</textarea>
                    @error('address')
                        <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.peserta.show', $registration->id) }}" class="px-6 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-sm shadow-md shadow-indigo-600/30 transition-all cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
