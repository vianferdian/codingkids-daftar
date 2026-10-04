<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - CodingKids</title>

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
    </style>
</head>
<body class="h-full flex items-center justify-center p-4 selection:bg-indigo-500 selection:text-white relative overflow-hidden">

    <!-- Background glowing orbs -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-sky-500/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10" x-data="{ showPassword: false }">
        
        <!-- Logo & Branding -->
        <div class="text-center mb-8">
            <a href="{{ route('public.landing') }}" class="inline-flex items-center gap-3 group">
                <div class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-3xl shadow-lg shadow-indigo-600/30 group-hover:scale-105 transition-transform">
                    🚀
                </div>
            </a>
            <h1 class="text-2xl font-black text-white mt-4 font-display">Coding<span class="text-indigo-400">Kids</span> Admin</h1>
            <p class="text-slate-400 text-sm mt-1">Masuk untuk mengelola data pendaftaran &amp; laporan</p>
        </div>

        <!-- Login Card -->
        <div class="bg-slate-800/90 backdrop-blur-xl border border-slate-700/80 rounded-3xl p-8 shadow-2xl">
            
            @if(session('info'))
                <div class="mb-6 p-4 rounded-2xl bg-sky-950/50 border border-sky-800 text-sky-300 text-xs font-semibold">
                    {{ session('info') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-950/60 border border-rose-800 text-rose-300 text-xs font-semibold space-y-1">
                    @foreach($errors->all() as $error)
                        <p class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ $error }}</span>
                        </p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Email Administrator
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', 'admin@codingkids.id') }}" 
                           required 
                           autocomplete="email"
                           placeholder="admin@codingkids.id"
                           class="w-full px-4 py-3.5 rounded-2xl bg-slate-900/80 border border-slate-700 text-white placeholder:text-slate-500 text-sm font-medium focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all">
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-300">
                            Kata Sandi
                        </label>
                    </div>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" 
                               id="password" 
                               name="password" 
                               value="admin123"
                               required 
                               autocomplete="current-password"
                               placeholder="••••••••"
                               class="w-full px-4 py-3.5 rounded-2xl bg-slate-900/80 border border-slate-700 text-white placeholder:text-slate-500 text-sm font-medium focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all pr-12">
                        
                        <button type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-200 p-1">
                            <span x-text="showPassword ? '🙈' : '👁️'" class="text-sm"></span>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-300">
                        <input type="checkbox" name="remember" value="1" class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-indigo-600 focus:ring-indigo-500">
                        <span>Ingat Saya</span>
                    </label>
                    <span class="text-slate-500 text-[11px]">Akun Default: admin123</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-4 px-6 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-extrabold text-sm rounded-2xl shadow-lg shadow-indigo-600/30 hover:shadow-xl hover:shadow-indigo-600/40 hover:-translate-y-0.5 active:translate-y-0 transition-all">
                    Masuk ke Dashboard Admin
                </button>
            </form>

            <div class="mt-6 text-center border-t border-slate-700/60 pt-5">
                <a href="{{ route('public.landing') }}" class="text-xs text-slate-400 hover:text-indigo-400 font-semibold transition-colors">
                    ← Kembali ke Halaman Utama Pendaftaran
                </a>
            </div>

        </div>

    </div>

</body>
</html>
