@extends('layouts.admin')

@section('title', 'Data Peserta - Admin CodingKids')
@section('page-title', 'Data Peserta Pendaftaran')

@section('content')
<div class="space-y-6" x-data="participantTable()">

    <!-- Header Actions & Search / Filters Card -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
        
        <form action="{{ route('admin.peserta.index') }}" method="GET" class="space-y-4">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">
                
                <!-- Search Keyword -->
                <div class="lg:col-span-4 relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari nama, sekolah, orang tua, no HP..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-300 text-sm focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <!-- Filter Kategori -->
                <div class="lg:col-span-3">
                    <select name="category" class="w-full px-3.5 py-2.5 rounded-2xl bg-slate-50 border border-slate-300 text-sm focus:bg-white focus:outline-none focus:border-indigo-500">
                        <option value="">Semua Kategori</option>
                        <option value="sd" {{ request('category') === 'sd' ? 'selected' : '' }}>SD (Code &amp; Play)</option>
                        <option value="smp" {{ request('category') === 'smp' ? 'selected' : '' }}>SMP (Code &amp; Explore)</option>
                    </select>
                </div>

                <!-- Filter Sekolah -->
                <div class="lg:col-span-3">
                    <select name="school" class="w-full px-3.5 py-2.5 rounded-2xl bg-slate-50 border border-slate-300 text-sm focus:bg-white focus:outline-none focus:border-indigo-500">
                        <option value="">Semua Sekolah</option>
                        @foreach($schools as $sch)
                            <option value="{{ $sch }}" {{ request('school') === $sch ? 'selected' : '' }}>{{ $sch }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Daftar -->
                <div class="lg:col-span-1">
                    <input type="date" 
                           name="date" 
                           value="{{ request('date') }}"
                           class="w-full px-2.5 py-2.5 rounded-2xl bg-slate-50 border border-slate-300 text-xs focus:bg-white focus:outline-none focus:border-indigo-500"
                           title="Filter tanggal pendaftaran">
                </div>

                <!-- Action Filter Buttons -->
                <div class="lg:col-span-1 flex items-center gap-1.5">
                    <button type="submit" class="w-full h-full py-2.5 px-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-xs shadow-xs transition-colors flex items-center justify-center cursor-pointer">
                        <span>Cari</span>
                    </button>
                    @if(request()->hasAny(['search', 'category', 'school', 'date']))
                        <a href="{{ route('admin.peserta.index') }}" class="p-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition-colors" title="Reset Filter">
                            ✕
                        </a>
                    @endif
                </div>

            </div>

        </form>

    </div>

    <!-- Data Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-900 font-display">Tabel Data Peserta</h3>
                <p class="text-xs text-slate-500">Menampilkan total {{ $registrations->total() }} peserta terdaftar</p>
            </div>

            <!-- Quick Export Links to Reports -->
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.laporan.excel', request()->all()) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold border border-emerald-200 transition-colors">
                    <span>Export Excel</span>
                </a>
                <a href="{{ route('admin.laporan.csv', request()->all()) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-sky-50 hover:bg-sky-100 text-sky-700 text-xs font-bold border border-sky-200 transition-colors">
                    <span>Export CSV</span>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 text-[11px] uppercase font-bold tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 text-center">No</th>
                        <th class="py-3.5 px-4">Nama Lengkap</th>
                        <th class="py-3.5 px-4">Tgl Lahir</th>
                        <th class="py-3.5 px-4">Kategori Kelas</th>
                        <th class="py-3.5 px-4">Sekolah</th>
                        <th class="py-3.5 px-4">Orang Tua</th>
                        <th class="py-3.5 px-4">Nomor HP</th>
                        <th class="py-3.5 px-4">Tgl Daftar</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($registrations as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-4 text-center text-xs text-slate-400 font-medium">
                                {{ $registrations->firstItem() + $index }}
                            </td>
                            <td class="py-4 px-4 font-bold text-slate-900">
                                <a href="{{ route('admin.peserta.show', $item->id) }}" class="hover:text-indigo-600">
                                    {{ $item->full_name }}
                                </a>
                            </td>
                            <td class="py-4 px-4 text-xs text-slate-600 whitespace-nowrap">
                                {{ $item->birth_date->translatedFormat('d-m-Y') }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-lg {{ $item->category === 'sd' ? 'bg-amber-100 text-amber-800' : 'bg-sky-100 text-sky-800' }}">
                                    {{ $item->package_name }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-slate-700 text-xs">
                                {{ $item->school }}
                            </td>
                            <td class="py-4 px-4 text-slate-700 text-xs font-medium">
                                {{ $item->parent_name }}
                            </td>
                            <td class="py-4 px-4 font-mono text-xs text-slate-600 whitespace-nowrap">
                                {{ $item->parent_phone }}
                            </td>
                            <td class="py-4 px-4 text-xs text-slate-500 whitespace-nowrap">
                                {{ $item->registered_at->translatedFormat('d-m-Y H:i') }}
                            </td>
                            <td class="py-4 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Detail -->
                                    <a href="{{ route('admin.peserta.show', $item->id) }}" 
                                       class="p-1.5 rounded-lg bg-slate-100 hover:bg-indigo-50 text-slate-600 hover:text-indigo-600 transition-colors" 
                                       title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.peserta.edit', $item->id) }}" 
                                       class="p-1.5 rounded-lg bg-slate-100 hover:bg-amber-50 text-slate-600 hover:text-amber-600 transition-colors" 
                                       title="Edit Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <button type="button" 
                                            @click="confirmDelete('{{ route('admin.peserta.destroy', $item->id) }}', '{{ $item->full_name }}')" 
                                            class="p-1.5 rounded-lg bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 transition-colors cursor-pointer" 
                                            title="Hapus Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="text-3xl">📭</span>
                                    <p class="font-bold text-slate-600 text-base">Tidak ada data peserta.</p>
                                    <p class="text-xs text-slate-400">Coba ubah kata kunci pencarian atau filter yang dipilih.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($registrations->hasPages())
            <div class="p-6 border-t border-slate-100">
                {{ $registrations->links() }}
            </div>
        @endif

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
                    <p class="text-sm font-bold text-rose-900" x-text="deleteParticipantName"></p>
                </div>

                <form :action="deleteActionUrl" method="POST">
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

@push('scripts')
<script>
    function participantTable() {
        return {
            showDeleteModal: false,
            deleteActionUrl: '',
            deleteParticipantName: '',
            confirmDelete(url, name) {
                this.deleteActionUrl = url;
                this.deleteParticipantName = name;
                this.showDeleteModal = true;
            }
        };
    }
</script>
@endpush
