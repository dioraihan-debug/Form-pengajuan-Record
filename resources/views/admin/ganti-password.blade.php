@extends('layouts.admin')

@section('content')
<div class="flex justify-center py-6">
    <div class="w-full max-w-lg bg-white/95 dark:bg-slate-900/95 backdrop-blur-sm rounded-2xl shadow-xl border border-pink-200 dark:border-pink-900/40 p-8 transition-colors">
        
        <div class="flex items-center space-x-3 pb-4 mb-6 border-b border-pink-200 dark:border-pink-900/50">
            <span class="w-3 h-7 bg-[#D6336C] rounded-full inline-block"></span>
            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Ganti Password Admin</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Perbarui kata sandi akun admin untuk keamanan data</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-5 bg-rose-50 dark:bg-rose-950/40 border-l-4 border-[#D6336C] p-3.5 rounded-r-xl text-xs text-[#D6336C] dark:text-rose-300">
                <ul class="list-disc ml-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-5">
            @csrf

            <div>
                <label for="password_lama" class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Password Saat Ini</label>
                <input id="password_lama" type="password" name="password_lama" required
                       placeholder="Masukkan password saat ini"
                       class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">
            </div>

            <div>
                <label for="password_baru" class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Password Baru</label>
                <input id="password_baru" type="password" name="password_baru" required
                       placeholder="Minimal 6 karakter"
                       class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">
                <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-1">Gunakan kombinasi huruf dan angka untuk keamanan optimal.</p>
            </div>

            <div>
                <label for="konfirmasi_password_baru" class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Konfirmasi Password Baru</label>
                <input id="konfirmasi_password_baru" type="password" name="konfirmasi_password_baru" required
                       placeholder="Ulangi password baru"
                       class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.riwayat') }}" 
                   class="bg-[#FFF5F8] dark:bg-slate-800 hover:bg-[#FFB6C1] dark:hover:bg-slate-700 text-[#D6336C] dark:text-pink-300 border border-pink-200 dark:border-slate-700 font-bold py-2.5 px-5 rounded-xl text-xs sm:text-sm transition">
                    Batal
                </a>
                <button type="submit" class="btn-brand text-white font-bold py-2.5 px-6 rounded-xl text-xs sm:text-sm tracking-wide">
                    Simpan Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
