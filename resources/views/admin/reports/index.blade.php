@extends('layouts.admin')

@section('title', 'Laporan Pendaftaran - Admin CodingKids')
@section('page-title', 'Laporan Peserta')

@section('content')
<div class="space-y-6">

    <!-- Filters & Export Card -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
        
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="space-y-4">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">
                
                <!-- Filter Kategori -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Kategori Jenjang</label>
                    <select name="category" class="w-full px-3.5 py-2.5 rounded-2xl bg-slate-50 border border-slate-300 text-sm focus:bg-white focus:outline-none focus:border-indigo-500">
                        <option value="">Semua Kategori (SD &amp; SMP)</option>
                        <option value="sd" {{ request('category') === 'sd' ? 'selected' : '' }}>SD (Code &amp; Play)</option>
                        <option value="smp" {{ request('category') === 'smp' ? 'selected' : '' }}>SMP (Code &amp; Explore)</option>
                    </select>
                </div>

                <!-- Filter Sekolah -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Asal Sekolah</label>
                    <select name="school" class="w-full px-3.5 py-2.5 rounded-2xl bg-slate-50 border border-slate-300 text-sm focus:bg-white focus:outline-none focus:border-indigo-500">
                        <option value="">Semua Sekolah</option>
                        @foreach($schools as $sch)
                            <option value="{{ $sch }}" {{ request('school') === $sch ? 'selected' : '' }}>{{ $sch }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Mulai -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Periode Dari</label>
                    <input type="date" 
                           name="start_date" 
                           value="{{ request('start_date') }}"
                           class="w-full px-3.5 py-2.5 rounded-2xl bg-slate-50 border border-slate-300 text-sm focus:bg-white focus:outline-none focus:border-indigo-500">
                </div>

                <!-- Tanggal Akhir -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Sampai Tanggal</label>
                    <input type="date" 
                           name="end_date" 
                           value="{{ request('end_date') }}"
                           class="w-full px-3.5 py-2.5 rounded-2xl bg-slate-50 border border-slate-300 text-sm focus:bg-white focus:outline-none focus:border-indigo-500">
                </div>

                <!-- Filter Buttons -->
                <div class="lg:col-span-2 flex items-end gap-2">
                    <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-xs shadow-xs transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span>Filter</span>
                    </button>
                    @if(request()->hasAny(['category', 'school', 'start_date', 'end_date']))
                        <a href="{{ route('admin.laporan.index') }}" class="p-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition-colors" title="Reset Filter">
                            ✕
                        </a>
                    @endif
                </div>

            </div>

        </form>

    </div>

    <!-- Summary Counters for Filtered Results -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        
        <div class="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Peserta Laporan</p>
                <h4 class="text-2xl font-black text-slate-900 mt-1 font-display">{{ number_format($totalPeserta) }} Siswa</h4>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                📊
            </div>
        </div>

        <div class="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-amber-700 uppercase tracking-wider">SD (Code &amp; Play)</p>
                <h4 class="text-2xl font-black text-amber-600 mt-1 font-display">{{ number_format($pesertaSd) }} Siswa</h4>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                🎮
            </div>
        </div>

        <div class="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-sky-700 uppercase tracking-wider">SMP (Code &amp; Explore)</p>
                <h4 class="text-2xl font-black text-sky-600 mt-1 font-display">{{ number_format($pesertaSmp) }} Siswa</h4>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl">
                💻
            </div>
        </div>

    </div>

    <!-- Main Table & Export Actions -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-900 font-display">Data Laporan Pendaftaran</h3>
                <p class="text-xs text-slate-500">Menampilkan data berdasarkan filter yang aktif</p>
            </div>

            <!-- Export Buttons -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Export Excel -->
                <a href="{{ route('admin.laporan.excel', request()->all()) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-xs transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Export Excel (.xlsx)</span>
                </a>

                <!-- Export CSV -->
                <a href="{{ route('admin.laporan.csv', request()->all()) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold shadow-xs transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Export CSV</span>
                </a>

                <!-- Print -->
                <a href="{{ route('admin.laporan.print', request()->all()) }}" 
                   target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold shadow-xs transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    <span>Cetak Laporan</span>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 text-[11px] uppercase font-bold tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-3 text-center">No</th>
                        <th class="py-3.5 px-3">Nama Peserta</th>
                        <th class="py-3.5 px-3">Tgl Lahir</th>
                        <th class="py-3.5 px-3">Kategori</th>
                        <th class="py-3.5 px-3">Sekolah</th>
                        <th class="py-3.5 px-3">Orang Tua/Wali</th>
                        <th class="py-3.5 px-3">Nomor HP</th>
                        <th class="py-3.5 px-3">Alamat</th>
                        <th class="py-3.5 px-3 text-right">Tgl Daftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($registrations as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors text-xs">
                            <td class="py-3.5 px-3 text-center text-slate-400 font-medium">
                                {{ $registrations->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-3 font-bold text-slate-900 whitespace-nowrap">
                                <a href="{{ route('admin.peserta.show', $item->id) }}" class="hover:text-indigo-600">
                                    {{ $item->full_name }}
                                </a>
                            </td>
                            <td class="py-3.5 px-3 text-slate-600 whitespace-nowrap">
                                {{ $item->birth_date->translatedFormat('d-m-Y') }}
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                <span class="px-2 py-0.5 text-[11px] font-bold rounded-md {{ $item->category === 'sd' ? 'bg-amber-100 text-amber-800' : 'bg-sky-100 text-sky-800' }}">
                                    {{ $item->package_name }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 text-slate-700">
                                {{ $item->school }}
                            </td>
                            <td class="py-3.5 px-3 text-slate-700 font-medium whitespace-nowrap">
                                {{ $item->parent_name }}
                            </td>
                            <td class="py-3.5 px-3 font-mono text-slate-600 whitespace-nowrap">
                                {{ $item->parent_phone }}
                            </td>
                            <td class="py-3.5 px-3 text-slate-600 max-w-xs truncate" title="{{ $item->address }}">
                                {{ $item->address }}
                            </td>
                            <td class="py-3.5 px-3 text-right text-slate-500 whitespace-nowrap">
                                {{ $item->registered_at->translatedFormat('d-m-Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="text-3xl">📄</span>
                                    <p class="font-bold text-slate-600 text-base">Tidak ada data pendaftaran yang sesuai kriteria laporan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($registrations->hasPages())
            <div class="p-6 border-t border-slate-100">
                {{ $registrations->links() }}
            </div>
        @endif

    </div>

</div>
@endsection
