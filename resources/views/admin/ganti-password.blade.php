@extends('layouts.admin')

@section('content')
<div class="flex justify-center mt-10">
    <div class="w-full max-w-lg bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Ganti Password Admin</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf

            <div class="mb-4">
                <label for="password_lama" class="block text-gray-700 text-sm font-bold mb-2">Password Lama</label>
                <input id="password_lama" type="password" name="password_lama" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-green-300">
            </div>

            <div class="mb-4">
                <label for="password_baru" class="block text-gray-700 text-sm font-bold mb-2">Password Baru</label>
                <input id="password_baru" type="password" name="password_baru" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-green-300">
                <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter.</p>
            </div>

            <div class="mb-6">
                <label for="konfirmasi_password_baru" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password Baru</label>
                <input id="konfirmasi_password_baru" type="password" name="konfirmasi_password_baru" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-green-300">
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('admin.riwayat') }}" class="text-gray-600 hover:text-gray-800 mr-4 text-sm font-bold">Batal</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition">
                    Simpan Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
