<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kusuma Agrowisata</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            light: '#FFF5F8',
                            soft: '#FFB6C1',
                            vibrant: '#FF4081',
                            deep: '#D6336C',
                            dark: '#9E1C48',
                        }
                    }
                }
            }
        }
    </script>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FFF5F8;
            background-image: radial-gradient(#FFB6C1 0.65px, transparent 0.65px), radial-gradient(#FFB6C1 0.65px, #FFF5F8 0.65px);
            background-size: 32px 32px;
            background-position: 0 0, 16px 16px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .dark body {
            background-color: #0F1117;
            background-image: radial-gradient(#2D1822 0.75px, transparent 0.75px), radial-gradient(#2D1822 0.75px, #0F1117 0.75px);
            color: #F1F5F9;
        }
        .btn-brand {
            background: linear-gradient(135deg, #D6336C 0%, #FF4081 100%);
            box-shadow: 0 4px 14px rgba(214, 51, 108, 0.3);
            transition: all 0.25s ease;
        }
        .btn-brand:hover {
            background: linear-gradient(135deg, #C2255C 0%, #E63572 100%);
            box-shadow: 0 6px 18px rgba(214, 51, 108, 0.4);
            transform: translateY(-1px);
        }
        .custom-focus:focus {
            outline: none;
            border-color: #FF4081;
            box-shadow: 0 0 0 3px rgba(255, 64, 129, 0.25);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen text-slate-800 dark:text-slate-100">

    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-[#D6336C] via-[#E63977] to-[#FF4081] text-white shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Left: Theme Switch & Brand -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <!-- Theme Toggle Switch -->
                    <button id="theme-toggle" type="button" onclick="toggleTheme()" 
                            class="flex items-center space-x-1.5 px-2.5 py-1.5 rounded-full bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 text-white shadow-sm hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white">
                        <!-- Sun Icon -->
                        <svg id="theme-toggle-light-icon" class="hidden w-3.5 h-3.5 text-amber-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                        <!-- Moon Icon -->
                        <svg id="theme-toggle-dark-icon" class="hidden w-3.5 h-3.5 text-pink-100" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <span id="theme-toggle-text" class="text-[11px] font-bold select-none">Light</span>
                    </button>

                    <!-- Brand / Logo -->
                    <a href="{{ route('admin.riwayat') }}" class="flex items-center space-x-2.5 group">
                        <div class="bg-white p-1.5 rounded-xl shadow-sm group-hover:scale-105 transition-transform duration-200">
                            @if(file_exists(public_path('images/logo.png')))
                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-6 sm:h-7 w-auto object-contain">
                            @else
                                <span class="text-[#D6336C] font-extrabold text-xs">KA</span>
                            @endif
                        </div>
                        <div>
                            <span class="font-extrabold text-sm sm:text-base tracking-tight block">Kusuma Agrowisata</span>
                            <span class="text-[9px] sm:text-[10px] text-pink-100 font-semibold uppercase tracking-wider block -mt-0.5">Admin Dashboard</span>
                        </div>
                    </a>
                </div>
                
                <!-- Nav Links -->
                @auth('admin')
                <div class="flex items-center space-x-1.5 sm:space-x-3">
                    <a href="{{ route('admin.riwayat') }}" 
                       class="{{ request()->routeIs('admin.riwayat*') ? 'bg-white/20 text-white font-bold shadow-sm' : 'text-pink-100 hover:bg-white/10 hover:text-white' }} px-2.5 sm:px-3 py-1.5 sm:py-2 rounded-xl text-xs sm:text-sm font-semibold transition">
                        Riwayat
                    </a>
                    <a href="{{ route('admin.password.change') }}" 
                       class="{{ request()->routeIs('admin.password*') ? 'bg-white/20 text-white font-bold shadow-sm' : 'text-pink-100 hover:bg-white/10 hover:text-white' }} px-2.5 sm:px-3 py-1.5 sm:py-2 rounded-xl text-xs sm:text-sm font-semibold transition">
                        Ganti Password
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white/15 hover:bg-white/25 text-white border border-white/30 px-2.5 sm:px-3 py-1.5 sm:py-2 rounded-xl text-xs sm:text-sm font-bold transition flex items-center space-x-1">
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-7xl">
        @if (session('success'))
            <div class="bg-emerald-50 dark:bg-emerald-950/40 border-l-4 border-emerald-500 text-emerald-800 dark:text-emerald-300 px-4 py-3.5 rounded-r-xl shadow-sm mb-6 flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-rose-50 dark:bg-rose-950/40 border-l-4 border-[#D6336C] text-[#D6336C] dark:text-rose-300 px-4 py-3.5 rounded-r-xl shadow-sm mb-6 flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-[#D6336C] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-sm border-t border-pink-200 dark:border-pink-900/40 text-slate-500 dark:text-slate-400 text-center py-5 mt-auto transition-colors">
        <div class="container mx-auto px-4 flex flex-col sm:flex-row justify-between items-center text-xs space-y-2 sm:space-y-0">
            <p>&copy; {{ date('Y') }} Kusuma Agrowisata Group. All rights reserved.</p>
            <p>
                <a href="{{ route('cctv.create') }}" class="text-[#D6336C] dark:text-pink-400 hover:text-[#FF4081] font-semibold transition">
                    &larr; Kembali ke Form Pemohon
                </a>
            </p>
        </div>
    </footer>

<script>
    function updateToggleUI() {
        const isDark = document.documentElement.classList.contains('dark');
        const lightIcon = document.getElementById('theme-toggle-light-icon');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const toggleText = document.getElementById('theme-toggle-text');
        
        if (isDark) {
            if (lightIcon) lightIcon.classList.remove('hidden');
            if (darkIcon) darkIcon.classList.add('hidden');
            if (toggleText) toggleText.textContent = 'Dark';
        } else {
            if (lightIcon) lightIcon.classList.add('hidden');
            if (darkIcon) darkIcon.classList.remove('hidden');
            if (toggleText) toggleText.textContent = 'Light';
        }
    }

    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
        updateToggleUI();
    }

    document.addEventListener('DOMContentLoaded', updateToggleUI);
</script>

</body>
</html>
