@extends('layouts.admin')

@section('content')
<div class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-sm rounded-2xl shadow-xl border border-pink-200 dark:border-pink-900/40 p-6 sm:p-8 transition-colors">
    
    {{-- Success Notification --}}
    @if(session('success'))
    <div id="flash-success" class="mb-5 flex items-center gap-3 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/50 text-emerald-700 dark:text-emerald-300 rounded-xl px-4 py-3 text-sm font-medium shadow-sm transition-all">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
        <button type="button" onclick="this.closest('#flash-success').remove()" class="ml-auto text-emerald-400 hover:text-emerald-600 dark:hover:text-emerald-200 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between pb-6 border-b border-pink-200 dark:border-pink-900/50 gap-4">
        <div>
            <div class="flex items-center space-x-2">
                <span class="w-3 h-7 bg-[#D6336C] rounded-full inline-block"></span>
                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Riwayat Pengajuan Rekaman CCTV</h2>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 ml-5">Daftar seluruh formulir pengajuan CCTV dari klien & pengunjung</p>
        </div>

        <!-- Search & Filter Form -->
        <form action="{{ route('admin.riwayat') }}" method="GET" class="flex flex-wrap sm:flex-nowrap gap-2 items-center">
            <div class="relative flex-grow sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari Nama / No KTP..." 
                       class="w-full bg-[#FFF5F8]/60 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl pl-9 pr-4 py-2 text-xs sm:text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">
            </div>

            <!-- Status Filter Dropdown -->
            <select name="status_pencarian" onchange="this.form.submit()"
                    class="bg-[#FFF5F8]/60 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl px-3 py-2 text-xs sm:text-sm text-slate-700 dark:text-slate-200 custom-focus transition cursor-pointer">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status_pencarian') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                <option value="ditemukan" {{ request('status_pencarian') == 'ditemukan' ? 'selected' : '' }}>✅ Ditemukan</option>
                <option value="belum_ditemukan" {{ request('status_pencarian') == 'belum_ditemukan' ? 'selected' : '' }}>❌ Belum Ditemukan</option>
            </select>

            <button type="submit" class="btn-brand text-white font-bold py-2 px-4 rounded-xl text-xs sm:text-sm shadow-sm transition">
                Cari
            </button>

            @if(request('search') || request('status_pencarian'))
                <a href="{{ route('admin.riwayat') }}" class="bg-[#FFF5F8] dark:bg-slate-800 hover:bg-[#FFB6C1] dark:hover:bg-slate-700 text-[#D6336C] dark:text-pink-300 border border-pink-200 dark:border-slate-700 font-bold py-2 px-3 rounded-xl text-xs sm:text-sm transition">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto mt-6 rounded-xl border border-pink-200 dark:border-slate-800 shadow-sm">
        <table class="min-w-full divide-y divide-pink-200 dark:divide-slate-800">
            <thead>
                <tr class="bg-gradient-to-r from-[#D6336C] to-[#FF4081] text-white">
                    <th class="py-3.5 px-4 text-left text-xs font-bold uppercase tracking-wider">No</th>
                    <th class="py-3.5 px-4 text-left text-xs font-bold uppercase tracking-wider">Nama Klien</th>
                    <th class="py-3.5 px-4 text-left text-xs font-bold uppercase tracking-wider">Tanggal Kejadian</th>
                    <th class="py-3.5 px-4 text-left text-xs font-bold uppercase tracking-wider">No. KTP</th>
                    <th class="py-3.5 px-4 text-left text-xs font-bold uppercase tracking-wider">No. WhatsApp</th>
                    <th class="py-3.5 px-4 text-left text-xs font-bold uppercase tracking-wider">Posisi CCTV</th>
                    <th class="py-3.5 px-4 text-center text-xs font-bold uppercase tracking-wider">Status</th>
                    <th class="py-3.5 px-4 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pink-100 dark:divide-slate-800 bg-white dark:bg-slate-900">
                @forelse($requests as $key => $req)
                    <tr class="hover:bg-[#FFF5F8] dark:hover:bg-slate-800/60 transition-colors {{ $key % 2 == 0 ? 'bg-white dark:bg-slate-900' : 'bg-[#FFF5F8]/40 dark:bg-slate-800/40' }}">
                        <td class="py-3.5 px-4 text-xs font-semibold text-slate-500 dark:text-slate-400">{{ $requests->firstItem() + $key }}</td>
                        <td class="py-3.5 px-4 text-xs sm:text-sm font-bold text-slate-800 dark:text-slate-100">{{ $req->nama_klien }}</td>
                        <td class="py-3.5 px-4 text-xs text-slate-600 dark:text-slate-300">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-pink-50 dark:bg-pink-950/40 text-[#D6336C] dark:text-pink-300 border border-pink-200 dark:border-pink-900/50">
                                {{ \Carbon\Carbon::parse($req->tanggal_kejadian)->translatedFormat('d M Y') }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-xs text-slate-600 dark:text-slate-300 font-mono">{{ $req->no_ktp }}</td>
                        <td class="py-3.5 px-4 text-xs text-slate-600 dark:text-slate-300">{{ $req->no_hp }}</td>
                        <td class="py-3.5 px-4 text-xs text-slate-700 dark:text-slate-200 font-medium">{{ $req->posisi_cctv }}</td>
                        
                        {{-- Status Badge --}}
                        <td class="py-3.5 px-4 text-xs text-center">
                            @if($req->status_pencarian === 'ditemukan')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50">
                                    ✅ Ditemukan
                                </span>
                            @elseif($req->status_pencarian === 'belum_ditemukan')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800/50">
                                    ❌ Belum Ditemukan
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50">
                                    ⏳ Pending
                                </span>
                            @endif
                        </td>

                        {{-- Action Buttons --}}
                        <td class="py-3.5 px-4 text-xs text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                {{-- Download PDF --}}
                                <a href="{{ route('admin.riwayat.download-pdf', $req->id) }}" target="_blank" 
                                   class="inline-flex items-center btn-brand text-white text-xs font-bold py-1.5 px-3 rounded-lg shadow-sm hover:scale-105 transition transform" title="Unduh PDF">
                                    <svg class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    PDF
                                </a>

                                {{-- Edit Status Button --}}
                                <button type="button" onclick="toggleStatusDropdown({{ $req->id }})"
                                        class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-bold py-1.5 px-3 rounded-lg shadow-sm hover:scale-105 transition transform" title="Edit Status">
                                    <svg class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>

                                {{-- Dokumentasi Button --}}
                                <button type="button" onclick="toggleDokPanel({{ $req->id }})"
                                        class="inline-flex items-center {{ $req->foto_dokumentasi ? 'bg-emerald-500 hover:bg-emerald-600' : 'bg-sky-500 hover:bg-sky-600' }} text-white text-xs font-bold py-1.5 px-3 rounded-lg shadow-sm hover:scale-105 transition transform" title="Dokumentasi Hasil">
                                    <svg class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Dokumentasi
                                </button>
                            </div>

                            {{-- Dokumentasi Panel (hidden by default) --}}
                            <div id="dok-panel-{{ $req->id }}" class="hidden mt-2 p-3 rounded-xl border border-pink-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-left">
                                @if($req->foto_dokumentasi)
                                    @php($dokUrl = asset('storage/' . $req->foto_dokumentasi))
                                    <a href="{{ $dokUrl }}" target="_blank" class="block mb-2">
                                        @if(strtolower(pathinfo($req->foto_dokumentasi, PATHINFO_EXTENSION)) === 'pdf')
                                            <span class="inline-flex items-center text-xs font-bold text-[#D6336C] dark:text-pink-300 underline">📄 Buka dokumentasi (PDF)</span>
                                        @else
                                            <img src="{{ $dokUrl }}" alt="Dokumentasi" class="max-h-32 rounded-lg border border-pink-200 dark:border-slate-600">
                                        @endif
                                        <span class="block text-[11px] text-slate-500 dark:text-slate-400">Dokumentasi saat ini. Upload baru akan menggantinya.</span>
                                    </a>
                                @endif

                                <form action="{{ route('admin.riwayat.upload-dokumentasi', $req->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="flex flex-wrap gap-1.5">
                                        <label class="cursor-pointer inline-flex items-center bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-xs font-bold py-1.5 px-3 rounded-lg transition">
                                            📁 Ambil dari File
                                            <input type="file" class="hidden" accept="image/jpeg, image/png, image/jpg, application/pdf" onchange="handleDokSelect(this, {{ $req->id }})">
                                        </label>
                                    </div>
                                    <input type="file" name="foto_dokumentasi" id="dok-real-{{ $req->id }}" class="hidden">
                                    <img id="dok-preview-{{ $req->id }}" class="hidden mt-2 max-h-32 rounded-lg border border-pink-200 dark:border-slate-600" alt="Pratinjau">
                                    <p id="dok-pdfname-{{ $req->id }}" class="hidden mt-2 text-xs font-semibold text-slate-700 dark:text-slate-200"></p>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">JPG/PNG atau PDF, maks. 10MB. Foto otomatis dikompres.</p>
                                    <div class="flex gap-1.5 mt-2">
                                        <button type="submit" id="dok-submit-{{ $req->id }}" disabled
                                                class="bg-emerald-500 hover:bg-emerald-600 disabled:opacity-40 disabled:cursor-not-allowed text-white text-xs font-bold py-1.5 px-3 rounded-lg transition">
                                            Simpan
                                        </button>
                                        <button type="button" onclick="toggleDokPanel({{ $req->id }})" class="bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300 text-xs font-bold py-1.5 px-3 rounded-lg transition">
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {{-- Inline Status Dropdown (hidden by default) --}}
                            <div id="status-dropdown-{{ $req->id }}" class="hidden mt-2">
                                <form action="{{ route('admin.riwayat.update-status', $req->id) }}" method="POST" class="flex items-center gap-1.5 justify-center">
                                    @csrf
                                    <select name="status_pencarian" class="bg-white dark:bg-slate-800 border border-pink-200 dark:border-slate-700 rounded-lg px-2 py-1.5 text-xs text-slate-700 dark:text-slate-200 custom-focus transition cursor-pointer">
                                        <option value="ditemukan" {{ $req->status_pencarian === 'ditemukan' ? 'selected' : '' }}>✅ Ditemukan</option>
                                        <option value="belum_ditemukan" {{ $req->status_pencarian === 'belum_ditemukan' ? 'selected' : '' }}>❌ Belum Ditemukan</option>
                                    </select>
                                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold py-1.5 px-2.5 rounded-lg shadow-sm transition" title="Simpan">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                    <button type="button" onclick="toggleStatusDropdown({{ $req->id }})" class="bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300 text-xs font-bold py-1.5 px-2.5 rounded-lg transition" title="Batal">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-12 px-4 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
                                <svg class="w-12 h-12 text-pink-300 dark:text-pink-900 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">Tidak ada data laporan CCTV</p>
                                <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Silakan sesuaikan pencarian atau tunggu pengajuan baru.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $requests->links() }}
    </div>
</div>

<script>
    function toggleStatusDropdown(id) {
        const dropdown = document.getElementById('status-dropdown-' + id);
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }

    function toggleDokPanel(id) {
        const panel = document.getElementById('dok-panel-' + id);
        if (panel) panel.classList.toggle('hidden');
    }

    function compressImage(file, maxDim = 1600, quality = 0.8) {
        return new Promise((resolve) => {
            const img = new Image();
            const url = URL.createObjectURL(file);
            img.onload = () => {
                URL.revokeObjectURL(url);
                const scale = Math.min(1, maxDim / Math.max(img.width, img.height));
                const w = Math.round(img.width * scale);
                const h = Math.round(img.height * scale);
                const canvas = document.createElement('canvas');
                canvas.width = w;
                canvas.height = h;
                const ctx = canvas.getContext('2d');
                ctx.fillStyle = '#fff';
                ctx.fillRect(0, 0, w, h);
                ctx.drawImage(img, 0, 0, w, h);
                canvas.toBlob((blob) => {
                    if (!blob || blob.size >= file.size) return resolve(file);
                    const name = file.name.replace(/\.[^.]+$/, '') + '.jpg';
                    resolve(new File([blob], name, { type: 'image/jpeg', lastModified: Date.now() }));
                }, 'image/jpeg', quality);
            };
            img.onerror = () => { URL.revokeObjectURL(url); resolve(file); };
            img.src = url;
        });
    }

    async function handleDokSelect(input, id) {
        if (!input.files || !input.files[0]) return;
        const original = input.files[0];
        if (original.size > 10 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 10MB.');
            input.value = '';
            return;
        }
        const isPdf = original.type === 'application/pdf' || /\.pdf$/i.test(original.name);
        const file = isPdf ? original : await compressImage(original);
        const dt = new DataTransfer();
        dt.items.add(file);
        document.getElementById('dok-real-' + id).files = dt.files;

        const preview = document.getElementById('dok-preview-' + id);
        const pdfName = document.getElementById('dok-pdfname-' + id);
        if (isPdf) {
            preview.classList.add('hidden');
            pdfName.textContent = '📄 ' + file.name;
            pdfName.classList.remove('hidden');
        } else {
            pdfName.classList.add('hidden');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
        document.getElementById('dok-submit-' + id).disabled = false;
        input.value = '';
    }

    // Auto-hide flash message after 4 seconds
    const flash = document.getElementById('flash-success');
    if (flash) {
        setTimeout(() => {
            flash.style.transition = 'opacity 0.5s ease';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
        }, 4000);
    }
</script>
@endsection
