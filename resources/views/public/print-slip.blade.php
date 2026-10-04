<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - {{ $registration->full_name }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fredoka:wght@600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-display {
            font-family: 'Fredoka', sans-serif;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                padding: 0 !important;
            }
            .slip-card {
                box-shadow: none !important;
                border: 2px solid #000 !important;
                border-radius: 12px !important;
            }
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-8 px-4 sm:px-6">

    <!-- Action Bar (Hidden on Print) -->
    <div class="max-w-2xl mx-auto mb-6 no-print flex items-center justify-between bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
        <a href="{{ route('public.success', $registration->id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali</span>
        </a>

        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-sm transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak / Simpan PDF</span>
            </button>
        </div>
    </div>

    <!-- Official Slip Card -->
    <div class="max-w-2xl mx-auto bg-white rounded-3xl p-8 sm:p-10 shadow-lg border border-slate-200/90 slip-card">
        
        <!-- Header -->
        <div class="flex items-center justify-between border-b-2 border-slate-800 pb-5 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl font-bold">
                    🚀
                </div>
                <div>
                    <div class="text-2xl font-black text-slate-900 font-display tracking-tight">Coding<span class="text-indigo-600">Kids</span> Indonesia</div>
                    <p class="text-xs text-slate-500 font-medium">Lembaga Kursus &amp; Pelatihan Pemrograman Anak</p>
                </div>
            </div>

            <div class="text-right">
                <div class="text-[10px] uppercase font-bold tracking-wider text-slate-500">Tanda Bukti</div>
                <div class="text-base font-extrabold text-indigo-700">REGISTRASI RESMI</div>
            </div>
        </div>

        <!-- Class & Status Badge -->
        <div class="flex items-center justify-between bg-slate-50 rounded-2xl p-4 border border-slate-200 mb-6">
            <div>
                <span class="text-xs text-slate-500 uppercase font-semibold">Program Kelas:</span>
                <div class="text-xl font-black text-slate-900 font-display">{{ $registration->package_name }}</div>
                <p class="text-xs text-slate-600">{{ $registration->package_description }}</p>
            </div>
            <div class="text-right">
                <span class="text-xs text-slate-500 uppercase font-semibold">Status:</span>
                <div>
                    <span class="inline-block px-3 py-1 text-xs font-black rounded-lg bg-emerald-100 text-emerald-900 border border-emerald-300">
                        TERVERIFIKASI
                    </span>
                </div>
            </div>
        </div>

        <!-- Detailed Information Grid -->
        <div class="space-y-4 text-sm mb-8">
            <div class="border-b border-slate-200/70 pb-2">
                <h3 class="text-xs font-black uppercase tracking-wider text-indigo-700">I. Data Peserta (Anak)</h3>
            </div>
            
            <div class="grid grid-cols-3 gap-2">
                <div class="text-slate-500 font-medium">Nama Lengkap</div>
                <div class="col-span-2 font-bold text-slate-900">: {{ $registration->full_name }}</div>

                <div class="text-slate-500 font-medium">Tanggal Lahir</div>
                <div class="col-span-2 text-slate-800">: {{ $registration->birth_date->translatedFormat('d F Y') }}</div>

                <div class="text-slate-500 font-medium">Asal Sekolah</div>
                <div class="col-span-2 font-semibold text-slate-900">: {{ $registration->school }}</div>
            </div>

            <div class="border-b border-slate-200/70 pb-2 pt-3">
                <h3 class="text-xs font-black uppercase tracking-wider text-indigo-700">II. Data Orang Tua / Wali</h3>
            </div>

            <div class="grid grid-cols-3 gap-2">
                <div class="text-slate-500 font-medium">Nama Orang Tua</div>
                <div class="col-span-2 font-bold text-slate-900">: {{ $registration->parent_name }}</div>

                <div class="text-slate-500 font-medium">Nomor HP / WA</div>
                <div class="col-span-2 font-mono text-slate-800">: {{ $registration->parent_phone }}</div>

                <div class="text-slate-500 font-medium">Alamat Lengkap</div>
                <div class="col-span-2 text-slate-800 leading-relaxed">: {{ $registration->address }}</div>
            </div>

            <div class="border-b border-slate-200/70 pb-2 pt-3">
                <h3 class="text-xs font-black uppercase tracking-wider text-indigo-700">III. Informasi Kursus &amp; Biaya</h3>
            </div>

            <div class="grid grid-cols-3 gap-2">
                <div class="text-slate-500 font-medium">Biaya Promo</div>
                <div class="col-span-2 font-black text-rose-600">: Rp 125.000 / Bulan (Khusus 20 Pendaftar Pertama)</div>

                <div class="text-slate-500 font-medium">Waktu Daftar</div>
                <div class="col-span-2 text-slate-800">: {{ $registration->registered_at->translatedFormat('d F Y, H:i:s') }} WIB</div>
            </div>
        </div>

        <!-- Note and Signatures -->
        <div class="grid grid-cols-2 gap-6 pt-4 border-t border-slate-200 text-xs">
            <div>
                <p class="font-bold text-slate-800 mb-1">Catatan:</p>
                <ul class="list-disc list-inside text-slate-500 space-y-0.5">
                    <li>Simpan bukti ini sebagai tanda registrasi resmi.</li>
                    <li>Admin akan menghubungi via WhatsApp untuk konfirmasi jadwal.</li>
                </ul>
            </div>

            <div class="text-center space-y-12">
                <div>
                    <span class="text-slate-500">Jakarta, {{ date('d F Y') }}</span>
                    <p class="font-bold text-slate-800">Panitia CodingKids</p>
                </div>
                <div>
                    <p class="font-bold text-slate-900 border-b border-slate-400 inline-block px-8 pb-1">Administrasi &amp; Admissions</p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
