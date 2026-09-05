@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Laporan CCTV</h2>

    <!-- Search / Filter -->
    <div class="mb-6">
        <form action="{{ route('admin.riwayat') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / No KTP..." 
                   class="shadow appearance-none border rounded w-full md:w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-green-300">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.riwayat') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded text-center transition">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-green-700 text-white">
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">No</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">Nama Klien</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">Tanggal Kejadian</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">No KTP</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">No Handphone</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">Posisi CCTV</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $key => $req)
                    <tr class="hover:bg-gray-50 {{ $key % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                        <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $requests->firstItem() + $key }}</td>
                        <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $req->nama_klien }}</td>
                        <td class="py-3 px-4 border-b text-sm text-gray-700">{{ \Carbon\Carbon::parse($req->tanggal_kejadian)->translatedFormat('d F Y') }}</td>
                        <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $req->no_ktp }}</td>
                        <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $req->no_hp }}</td>
                        <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $req->posisi_cctv }}</td>
                        <td class="py-3 px-4 border-b text-sm text-center">
                            <a href="{{ route('admin.riwayat.download-pdf', $req->id) }}" target="_blank" class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white text-xs font-bold py-1 px-3 rounded transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Unduh PDF
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 px-4 text-center text-gray-500">
                            Tidak ada data laporan CCTV.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $requests->links() }}
    </div>
</div>
@endsection
