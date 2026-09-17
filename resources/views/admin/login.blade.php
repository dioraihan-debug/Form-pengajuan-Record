@extends('layouts.admin')

@section('content')
<div class="flex justify-center items-center py-10">
    <div class="w-full max-w-md bg-white/95 dark:bg-slate-900/95 backdrop-blur-sm rounded-2xl shadow-xl border border-pink-200 dark:border-pink-900/40 p-8 transition-colors">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#D6336C] to-[#FF4081] text-white shadow-lg mb-3">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Admin Login</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Masuk untuk mengelola permohonan rekaman CCTV</p>
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

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
            @csrf

            <div>
                <label for="username" class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                        placeholder="Masukkan username"
                        class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">
                </div>
            </div>

            <div>
                <label for="password" class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required
                        placeholder="••••••••"
                        class="w-full bg-[#FFF5F8]/50 dark:bg-slate-800/70 border border-pink-200 dark:border-slate-700 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 custom-focus transition">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full btn-brand text-white font-bold py-3 px-4 rounded-xl text-sm tracking-wide">
                    Masuk Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
