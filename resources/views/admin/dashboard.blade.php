@extends('layouts.admin')

@section('title', 'Dashboard - Admin CodingKids')
@section('page-title', 'Ringkasan & Dashboard')

@section('content')
<div class="space-y-8">

    <!-- 4 Key Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Total Peserta -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Peserta</p>
                    <h3 class="text-3xl font-black text-slate-900 mt-2 font-display">{{ number_format($totalPeserta) }}</h3>
                    <span class="text-xs font-medium text-slate-400 mt-1 inline-block">Seluruh Kategori</span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl border border-indigo-100">
                    👥
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 to-blue-500"></div>
        </div>

        <!-- Peserta SD (Code & Play) -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">SD (Code &amp; Play)</p>
                    <h3 class="text-3xl font-black text-amber-600 mt-2 font-display">{{ number_format($pesertaSd) }}</h3>
                    <span class="text-xs font-medium text-amber-700/80 mt-1 inline-block">
                        {{ $totalPeserta > 0 ? round(($pesertaSd / $totalPeserta) * 100) : 0 }}% dari Total
                    </span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl border border-amber-100">
                    🎮
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-400 to-orange-400"></div>
        </div>

        <!-- Peserta SMP (Code & Explore) -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">SMP (Code &amp; Explore)</p>
                    <h3 class="text-3xl font-black text-sky-600 mt-2 font-display">{{ number_format($pesertaSmp) }}</h3>
                    <span class="text-xs font-medium text-sky-700/80 mt-1 inline-block">
                        {{ $totalPeserta > 0 ? round(($pesertaSmp / $totalPeserta) * 100) : 0 }}% dari Total
                    </span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-2xl border border-sky-100">
                    💻
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-sky-500 to-indigo-500"></div>
        </div>

        <!-- Pendaftaran Hari Ini -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Pendaftaran Hari Ini</p>
                    <h3 class="text-3xl font-black text-emerald-600 mt-2 font-display">{{ number_format($pendaftaranHariIni) }}</h3>
                    <span class="text-xs font-medium text-emerald-700/80 mt-1 inline-block">
                        Registrasi Terkini
                    </span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl border border-emerald-100">
                    ⚡
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 to-teal-500"></div>
        </div>

    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Trend 7 Hari Terakhir -->
        <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base font-bold text-slate-900 font-display">Tren Pendaftaran 7 Hari Terakhir</h3>
                    <p class="text-xs text-slate-500">Statistik registrasi harian peserta baru</p>
                </div>
                <div class="flex items-center gap-3 text-xs font-bold">
                    <span class="flex items-center gap-1.5 text-amber-600">
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span> SD
                    </span>
                    <span class="flex items-center gap-1.5 text-sky-600">
                        <span class="w-3 h-3 rounded-full bg-sky-500"></span> SMP
                    </span>
                </div>
            </div>

            <div class="h-64 relative">
                <canvas id="registrationTrendChart"></canvas>
            </div>
        </div>

        <!-- Perbandingan Kategori (Doughnut Chart) -->
        <div class="lg:col-span-4 bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="text-base font-bold text-slate-900 font-display">Proporsi Kategori Kelas</h3>
                <p class="text-xs text-slate-500 mb-4">Perbandingan komposisi peserta SD vs SMP</p>
            </div>

            <div class="h-48 relative flex items-center justify-center">
                <canvas id="categoryRatioChart"></canvas>
            </div>

            <div class="grid grid-cols-2 gap-3 pt-4 border-t border-slate-100 text-center">
                <div class="bg-amber-50/70 p-3 rounded-2xl border border-amber-100">
                    <div class="text-xs font-bold text-amber-800">Code &amp; Play (SD)</div>
                    <div class="text-lg font-black text-amber-900 font-display">{{ $pesertaSd }} Siswa</div>
                </div>
                <div class="bg-sky-50/70 p-3 rounded-2xl border border-sky-100">
                    <div class="text-xs font-bold text-sky-800">Code &amp; Explore (SMP)</div>
                    <div class="text-lg font-black text-sky-900 font-display">{{ $pesertaSmp }} Siswa</div>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Registrations Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-900 font-display">Peserta Terbaru</h3>
                <p class="text-xs text-slate-500">Daftar calon siswa yang baru saja mendaftar</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.peserta.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                    <span>Lihat Semua Peserta</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 text-[11px] uppercase font-bold tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-6">Nama Peserta</th>
                        <th class="py-3.5 px-6">Kategori Kelas</th>
                        <th class="py-3.5 px-6">Asal Sekolah</th>
                        <th class="py-3.5 px-6">Tanggal Daftar</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentRegistrations as $item)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6 font-bold text-slate-900">
                                <a href="{{ route('admin.peserta.show', $item->id) }}" class="hover:text-indigo-600">
                                    {{ $item->full_name }}
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-lg {{ $item->category === 'sd' ? 'bg-amber-100 text-amber-800' : 'bg-sky-100 text-sky-800' }}">
                                    {{ $item->package_name }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-slate-700">
                                {{ $item->school }}
                            </td>
                            <td class="py-4 px-6 text-slate-500 text-xs">
                                {{ $item->registered_at->translatedFormat('d M Y, H:i') }} WIB
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.peserta.show', $item->id) }}" class="p-1.5 rounded-lg bg-slate-100 hover:bg-indigo-50 hover:text-indigo-600 text-slate-600 transition-colors" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.peserta.edit', $item->id) }}" class="p-1.5 rounded-lg bg-slate-100 hover:bg-amber-50 hover:text-amber-600 text-slate-600 transition-colors" title="Edit Peserta">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400 text-sm">
                                Belum ada data pendaftaran peserta.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const trendLabels = {!! json_encode($last7Days->pluck('label')) !!};
        const trendSd = {!! json_encode($last7Days->pluck('sd')) !!};
        const trendSmp = {!! json_encode($last7Days->pluck('smp')) !!};

        const ctxTrend = document.getElementById('registrationTrendChart').getContext('2d');
        new Chart(ctxTrend, {
            type: 'bar',
            data: {
                labels: trendLabels,
                datasets: [
                    {
                        label: 'SD (Code & Play)',
                        data: trendSd,
                        backgroundColor: '#f59e0b',
                        borderRadius: 6,
                    },
                    {
                        label: 'SMP (Code & Explore)',
                        data: trendSmp,
                        backgroundColor: '#0ea5e9',
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { 
                        beginAtZero: true, 
                        ticks: { stepSize: 1 },
                        grid: { color: '#f1f5f9' }
                    }
                }
            }
        });

        const ctxRatio = document.getElementById('categoryRatioChart').getContext('2d');
        const sdTotal = {{ $pesertaSd }};
        const smpTotal = {{ $pesertaSmp }};

        new Chart(ctxRatio, {
            type: 'doughnut',
            data: {
                labels: ['SD (Code & Play)', 'SMP (Code & Explore)'],
                datasets: [{
                    data: [sdTotal || (sdTotal + smpTotal === 0 ? 1 : 0), smpTotal],
                    backgroundColor: ['#f59e0b', '#0ea5e9'],
                    hoverOffset: 4,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endpush
