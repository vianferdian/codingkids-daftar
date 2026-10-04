<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendaftaran CodingKids - {{ date('d-m-Y') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fredoka:wght@600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                padding: 0 !important;
                font-size: 9pt;
            }
            @page {
                size: A4 landscape;
                margin: 12mm;
            }
            table {
                page-break-inside: auto;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            thead {
                display: table-header-group;
            }
            tfoot {
                display: table-footer-group;
            }
        }
    </style>
</head>
<body class="p-6">

    <!-- Action Bar (Hidden on Print) -->
    <div class="max-w-6xl mx-auto mb-6 no-print flex items-center justify-between bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
        <a href="{{ route('admin.laporan.index', request()->all()) }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Laporan</span>
        </a>

        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-sm transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak / Cetak ke PDF</span>
            </button>
        </div>
    </div>

    <!-- Official A4 Document Container -->
    <div class="max-w-6xl mx-auto bg-white p-8 sm:p-10 rounded-3xl shadow-sm border border-slate-200">
        
        <!-- Header -->
        <div class="flex items-center justify-between border-b-2 border-slate-800 pb-5 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl font-bold">
                    🚀
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-900 font-display">Coding<span class="text-indigo-600">Kids</span> Indonesia</h1>
                    <p class="text-xs text-slate-500 font-medium">Lembaga Pendidikan &amp; Kursus Pemrograman Anak</p>
                </div>
            </div>

            <div class="text-right">
                <h2 class="text-lg font-black uppercase text-slate-900">Laporan Pendaftaran CodingKids</h2>
                <p class="text-xs text-slate-500">Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
            </div>
        </div>

        <!-- Filter & Summary Overview -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-200 mb-6 text-xs">
            <div>
                <span class="text-slate-500 font-medium">Filter Kategori:</span>
                <p class="font-bold text-slate-900">{{ $filters['category'] ? strtoupper($filters['category']) : 'Semua Kategori (SD & SMP)' }}</p>
            </div>
            <div>
                <span class="text-slate-500 font-medium">Filter Sekolah:</span>
                <p class="font-bold text-slate-900 truncate">{{ $filters['school'] ?: 'Semua Sekolah' }}</p>
            </div>
            <div>
                <span class="text-slate-500 font-medium">Periode Pendaftaran:</span>
                <p class="font-bold text-slate-900">
                    {{ $filters['start_date'] ? \Carbon\Carbon::parse($filters['start_date'])->format('d/m/Y') : 'Awal' }} s/d {{ $filters['end_date'] ? \Carbon\Carbon::parse($filters['end_date'])->format('d/m/Y') : 'Sekarang' }}
                </p>
            </div>
            <div>
                <span class="text-slate-500 font-medium">Total Peserta:</span>
                <p class="font-bold text-indigo-700 text-sm">{{ $totalPeserta }} Siswa (SD: {{ $pesertaSd }}, SMP: {{ $pesertaSmp }})</p>
            </div>
        </div>

        <!-- Report Table -->
        <table class="w-full text-left text-xs border border-slate-300 divide-y divide-slate-300">
            <thead class="bg-slate-100 font-bold uppercase text-[10px] text-slate-700">
                <tr>
                    <th class="py-2.5 px-2 text-center border-r border-slate-300">No</th>
                    <th class="py-2.5 px-2 border-r border-slate-300">Nama Peserta</th>
                    <th class="py-2.5 px-2 text-center border-r border-slate-300">Tgl Lahir</th>
                    <th class="py-2.5 px-2 text-center border-r border-slate-300">Kategori</th>
                    <th class="py-2.5 px-2 border-r border-slate-300">Asal Sekolah</th>
                    <th class="py-2.5 px-2 border-r border-slate-300">Orang Tua / Wali</th>
                    <th class="py-2.5 px-2 border-r border-slate-300">Nomor HP</th>
                    <th class="py-2.5 px-2 border-r border-slate-300">Alamat</th>
                    <th class="py-2.5 px-2 text-center">Tgl Daftar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($registrations as $index => $item)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-slate-50/50' }}">
                        <td class="py-2 px-2 text-center border-r border-slate-200 font-medium">{{ $index + 1 }}</td>
                        <td class="py-2 px-2 font-bold text-slate-900 border-r border-slate-200">{{ $item->full_name }}</td>
                        <td class="py-2 px-2 text-center border-r border-slate-200 whitespace-nowrap">{{ $item->birth_date->format('d/m/Y') }}</td>
                        <td class="py-2 px-2 text-center font-bold border-r border-slate-200">{{ $item->category_label }}</td>
                        <td class="py-2 px-2 border-r border-slate-200">{{ $item->school }}</td>
                        <td class="py-2 px-2 border-r border-slate-200">{{ $item->parent_name }}</td>
                        <td class="py-2 px-2 font-mono border-r border-slate-200 whitespace-nowrap">{{ $item->parent_phone }}</td>
                        <td class="py-2 px-2 border-r border-slate-200 leading-tight text-[11px]">{{ $item->address }}</td>
                        <td class="py-2 px-2 text-center whitespace-nowrap text-slate-600">{{ $item->registered_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="py-6 text-center text-slate-400">Tidak ada data pendaftaran yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Signature Section -->
        <div class="mt-10 pt-4 flex justify-between items-end text-xs text-slate-700">
            <div>
                <p class="font-semibold">Dicetak oleh Sistem Informasi CodingKids</p>
                <p class="text-slate-400 text-[10px]">Dokumen ini sah dicetak secara elektronik.</p>
            </div>

            <div class="text-center w-56 space-y-16">
                <div>
                    <p>Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                    <p class="font-bold">Penanggung Jawab / Admin</p>
                </div>
                <div>
                    <p class="font-bold border-b border-slate-800 pb-1">{{ auth()->user()->name ?? 'Administrator' }}</p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
