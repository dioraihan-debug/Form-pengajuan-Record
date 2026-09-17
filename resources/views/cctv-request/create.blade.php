<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Permintaan Rekaman CCTV - Kusuma Agrowisata</title>
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
        // Check theme on initial load to prevent flash
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
            background-image: radial-gradient(#FFB6C1 0.75px, transparent 0.75px), radial-gradient(#FFB6C1 0.75px, #FFF5F8 0.75px);
            background-size: 30px 30px;
            background-position: 0 0, 15px 15px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .dark body {
            background-color: #0F1117;
            background-image: radial-gradient(#2D1822 0.75px, transparent 0.75px), radial-gradient(#2D1822 0.75px, #0F1117 0.75px);
            color: #F1F5F9;
        }
        .custom-focus:focus {
            outline: none;
            border-color: #FF4081;
            box-shadow: 0 0 0 3px rgba(255, 64, 129, 0.25);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #D6336C 0%, #FF4081 100%);
            box-shadow: 0 4px 14px rgba(214, 51, 108, 0.35);
            transition: all 0.25s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #C2255C 0%, #E63572 100%);
            box-shadow: 0 6px 20px rgba(214, 51, 108, 0.45);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 flex flex-col justify-between relative">

    <!-- Theme Toggle in Top-Left Corner -->
    <div class="fixed top-4 left-4 z-50">
        <button id="theme-toggle" type="button" onclick="toggleTheme()" 
                class="flex items-center space-x-2 px-3 py-2 rounded-full bg-white/90 dark:bg-slate-800/90 backdrop-blur-md border border-pink-200 dark:border-pink-900/60 text-slate-700 dark:text-pink-200 shadow-lg hover:shadow-pink-200/50 dark:hover:shadow-pink-950/50 hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#FF4081]">
            <!-- Sun Icon (shown in dark mode) -->
            <svg id="theme-toggle-light-icon" class="hidden w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
            <!-- Moon Icon (shown in light mode) -->
            <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4 text-[#D6336C]" fill="currentColor" viewBox="0 0 20 20">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <span id="theme-toggle-text" class="text-xs font-bold select-none">Light</span>
        </button>
    </div>

    <div class="max-w-3xl mx-auto w-full mt-4">
        <!-- Top Header Card -->
        <div class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-sm border border-pink-200/80 dark:border-pink-900/40 rounded-2xl shadow-xl overflow-hidden mb-6 transition-colors">
            <div class="bg-gradient-to-r from-[#D6336C] via-[#E63977] to-[#FF4081] p-6 text-white text-center sm:text-left sm:flex sm:items-center sm:justify-between">
                <div class="flex items-center space-x-4 justify-center sm:justify-start">
                    <div class="bg-white p-2 rounded-xl shadow-md">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                        @else
                            <span class="text-[#D6336C] font-extrabold text-sm tracking-wide">KUSUMA</span>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold tracking-tight">Pengajuan Rekaman CCTV</h1>
                        <p class="text-pink-100 text-xs sm:text-sm font-medium">Kusuma Agrowisata Group</p>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 text-center sm:text-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 backdrop-blur-md text-white border border-white/30">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </span>
                </div>
            </div>

            <!-- Form Body -->
            <div class="p-6 sm:p-8">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 dark:bg-rose-950/40 border-l-4 border-[#D6336C] p-4 rounded-r-xl">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 text-[#D6336C]">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-bold text-red-800 dark:text-rose-300">Terdapat kesalahan pengisian data:</h3>
                                <ul class="list-disc mt-1 ml-4 text-xs text-red-700 dark:text-rose-400 space-y-0.5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('cctv.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Section: Data Klien -->
                    <div>
                        <div class="flex items-center space-x-2 border-b border-pink-200 dark:border-pink-900/50 pb-2 mb-4">
                            <span class="w-2.5 h-6 bg-[#D6336C] rounded-full inline-block"></span>
                            <h2 class="text-base font-bold text-slate-800 dark:text-white">Informasi Pemohon</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Nama Klien <span class="text-[#D6336C]">*</span></label>
                                <input type="text" name="nama_klien" value="{{ old('nama_klien') }}" required 
                                       placeholder="Nama Lengkap sesuai KTP"
                                       class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">
                            </div>
                            
                            <div>
                                <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">No. KTP / NIK <span class="text-[#D6336C]">*</span></label>
                                <input type="text" name="no_ktp" value="{{ old('no_ktp') }}" required 
                                       placeholder="16 Digit Nomor KTP"
                                       class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">
                            </div>

                            <div>
                                <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">No. WhatsApp / HP <span class="text-[#D6336C]">*</span></label>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}" required 
                                       placeholder="08xxxxxxxxxx"
                                       class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">
                            </div>

                            <div>
                                <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Posisi / Lokasi CCTV <span class="text-[#D6336C]">*</span></label>
                                <input type="text" name="posisi_cctv" value="{{ old('posisi_cctv') }}" required 
                                       placeholder="Contoh: Lobi Hotel / Parkiran Depan"
                                       class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Alamat Lengkap <span class="text-[#D6336C]">*</span></label>
                                <textarea name="alamat" required rows="2" 
                                          placeholder="Alamat domisili atau tempat tinggal"
                                          class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Detail Kejadian -->
                    <div>
                        <div class="flex items-center space-x-2 border-b border-pink-200 dark:border-pink-900/50 pb-2 mb-4">
                            <span class="w-2.5 h-6 bg-[#FF4081] rounded-full inline-block"></span>
                            <h2 class="text-base font-bold text-slate-800 dark:text-white">Detail Kejadian & Kronologi</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-4">
                            <div>
                                <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Tanggal Kejadian <span class="text-[#D6336C]">*</span></label>
                                <div class="flex rounded-xl overflow-hidden shadow-sm">
                                    <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" required 
                                           class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-r-0 border-pink-200 dark:border-slate-700 rounded-l-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 custom-focus">
                                    <button type="button" onclick="setToday()" class="bg-[#FFF5F8] dark:bg-slate-800 hover:bg-[#FFB6C1] dark:hover:bg-slate-700 text-[#D6336C] dark:text-pink-300 border border-pink-200 dark:border-slate-700 font-bold px-3 py-2 text-xs transition">
                                        Hari Ini
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Waktu Kejadian <span class="text-[#D6336C]">*</span></label>
                                <div class="flex rounded-xl overflow-hidden shadow-sm">
                                    <input type="time" id="waktu_kejadian" name="waktu_kejadian" value="{{ old('waktu_kejadian') }}" required 
                                           class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-r-0 border-pink-200 dark:border-slate-700 rounded-l-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 custom-focus">
                                    <button type="button" onclick="setNow()" class="bg-[#FFF5F8] dark:bg-slate-800 hover:bg-[#FFB6C1] dark:hover:bg-slate-700 text-[#D6336C] dark:text-pink-300 border border-pink-200 dark:border-slate-700 font-bold px-3 py-2 text-xs transition">
                                        Sekarang
                                    </button>
                                </div>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Alasan & Kronologi Permintaan <span class="text-[#D6336C]">*</span></label>
                                <textarea name="alasan_kronologi" required rows="3" 
                                          placeholder="Jelaskan secara detail kejadian dan alasan permintaan rekaman CCTV..."
                                          class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">{{ old('alasan_kronologi') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Foto KTP -->
                    <div>
                        <div class="flex items-center space-x-2 border-b border-pink-200 dark:border-pink-900/50 pb-2 mb-4">
                            <span class="w-2.5 h-6 bg-[#D6336C] rounded-full inline-block"></span>
                            <h2 class="text-base font-bold text-slate-800 dark:text-white">Lampiran Foto KTP</h2>
                        </div>

                        <div class="bg-[#FFF5F8] dark:bg-slate-800/50 border border-dashed border-[#FFB6C1] dark:border-pink-900/50 rounded-2xl p-5 text-center">
                            <div class="flex flex-wrap justify-center gap-3 mb-3">
                                <label class="cursor-pointer inline-flex items-center px-4 py-2.5 bg-white dark:bg-slate-800 border border-[#FFB6C1] dark:border-pink-900/60 hover:bg-pink-50 dark:hover:bg-slate-700 text-[#D6336C] dark:text-pink-300 rounded-xl font-bold text-xs shadow-sm transition">
                                    <svg class="w-4 h-4 mr-2 text-[#FF4081]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Pilih dari Galeri</span>
                                    <input type="file" id="foto_ktp_gallery" class="hidden" accept="image/jpeg, image/png, image/jpg" onchange="handleFileSelect(this)">
                                </label>
                                
                                <label class="cursor-pointer inline-flex items-center px-4 py-2.5 bg-white dark:bg-slate-800 border border-[#FFB6C1] dark:border-pink-900/60 hover:bg-pink-50 dark:hover:bg-slate-700 text-[#D6336C] dark:text-pink-300 rounded-xl font-bold text-xs shadow-sm transition">
                                    <svg class="w-4 h-4 mr-2 text-[#FF4081]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>Ambil Foto Kamera</span>
                                    <input type="file" id="foto_ktp_camera" class="hidden" accept="image/jpeg, image/png, image/jpg" capture="environment" onchange="handleFileSelect(this)">
                                </label>
                            </div>
                            
                            <p class="text-xs text-slate-500 dark:text-slate-400">Format: JPG, JPEG, PNG (Maksimal 5MB)</p>

                            <!-- The actual input that will be submitted -->
                            <input type="file" name="foto_ktp" id="foto_ktp_real" class="hidden" required>
                            
                            <!-- Preview Image -->
                            <div id="preview-container" class="hidden mt-4 pt-4 border-t border-pink-200 dark:border-slate-700">
                                <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Pratinjau Foto KTP:</p>
                                <div class="inline-block relative">
                                    <img id="image-preview" src="#" alt="Preview" class="max-w-xs max-h-48 rounded-xl border border-[#FFB6C1] dark:border-pink-900 shadow-md object-contain">
                                    <button type="button" onclick="clearImage()" class="absolute -top-2 -right-2 bg-[#D6336C] hover:bg-red-700 text-white rounded-full p-1 shadow transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 flex items-center justify-between">
                        <div class="text-xs text-slate-500 dark:text-slate-400 italic">
                            * Pastikan seluruh data terisi dengan benar.
                        </div>
                        <button type="submit" class="btn-gradient text-white font-bold py-3 px-8 rounded-xl text-sm tracking-wide">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer Note & Admin Link -->
        <div class="text-center text-xs text-slate-500 dark:text-slate-400 mb-8 space-y-1">
            <p>&copy; {{ date('Y') }} Kusuma Agrowisata Group. All rights reserved.</p>
            <p>
                <a href="{{ route('admin.login') }}" class="text-[#D6336C] dark:text-pink-400 hover:text-[#FF4081] font-semibold transition underline decoration-pink-300 dark:decoration-pink-600">
                    Panel Admin
                </a>
            </p>
        </div>
    </div>

    @if(session('download_url'))
    <!-- Success & Download Modal -->
    <div id="success-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300">
        <div class="bg-white dark:bg-slate-900 border border-pink-200 dark:border-pink-900/50 rounded-2xl shadow-2xl max-w-md w-full p-6 text-center transform transition-all scale-100">
            <!-- Icon Circle -->
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-pink-100 dark:bg-pink-950/60 text-[#D6336C] dark:text-pink-400 mb-4 ring-8 ring-pink-50 dark:ring-pink-950/30">
                <svg class="h-9 w-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">
                Pengajuan Berhasil!
            </h3>
            
            <p class="text-sm text-slate-600 dark:text-slate-300 mb-6 leading-relaxed">
                Form pengajuan rekaman CCTV atas nama <span class="font-bold text-[#D6336C] dark:text-pink-400">{{ session('client_name') }}</span> telah berhasil dikirim dan tersimpan. Silakan unduh dokumen form PDF pengajuan Anda.
            </p>
            
            <div class="space-y-3">
                <a href="{{ session('download_url') }}" id="btn-download-pdf" onclick="handlePdfDownload()" download class="w-full btn-gradient text-white font-bold py-3.5 px-6 rounded-xl text-sm tracking-wide flex items-center justify-center space-x-2 shadow-lg hover:shadow-pink-500/30 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span id="btn-download-text">Unduh Form PDF</span>
                </a>
                
                <button type="button" onclick="closeModalAndReset()" class="w-full bg-slate-100 dark:bg-slate-800 hover:bg-pink-50 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 font-semibold py-2.5 px-4 rounded-xl text-xs transition">
                    Selesai / Buat Pengajuan Baru
                </button>
            </div>
        </div>
    </div>
    @endif

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

    function setToday() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal_kejadian').value = today;
    }

    function setNow() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('waktu_kejadian').value = `${hours}:${minutes}`;
    }

    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Validate size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                input.value = '';
                return;
            }

            // Transfer file to the real input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            document.getElementById('foto_ktp_real').files = dataTransfer.files;

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function clearImage() {
        document.getElementById('foto_ktp_gallery').value = '';
        document.getElementById('foto_ktp_camera').value = '';
        document.getElementById('foto_ktp_real').value = '';
        document.getElementById('preview-container').classList.add('hidden');
        document.getElementById('image-preview').src = '#';
    }

    function handlePdfDownload() {
        const btnText = document.getElementById('btn-download-text');
        if (btnText) {
            btnText.textContent = 'Mengunduh PDF...';
        }
    }

    function closeModalAndReset() {
        const modal = document.getElementById('success-modal');
        if (modal) {
            modal.style.display = 'none';
        }
        window.location.href = "{{ route('cctv.create') }}";
    }
</script>

</body>
</html>
