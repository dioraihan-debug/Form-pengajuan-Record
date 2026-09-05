<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Permintaan Rekaman CCTV</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Form Pengajuan Permintaan Rekaman CCTV Oleh Klien</h1>
        </div>
        <div class="text-right text-sm text-gray-500">
            <p>Tanggal Formulir: <span id="tanggal-formulir-display">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span></p>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <strong class="font-bold">Ada kesalahan!</strong>
            <ul class="list-disc mt-2 ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cctv.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Klien *</label>
                <input type="text" name="nama_klien" value="{{ old('nama_klien') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">No KTP *</label>
                <input type="text" name="no_ktp" value="{{ old('no_ktp') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">No HP *</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="col-span-1 md:col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Alamat *</label>
                <textarea name="alamat" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3">{{ old('alamat') }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kejadian *</label>
                <div class="flex">
                    <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" required class="shadow appearance-none border rounded-l w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <button type="button" onclick="setToday()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r text-sm">Hari Ini</button>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Waktu Kejadian *</label>
                <div class="flex">
                    <input type="time" id="waktu_kejadian" name="waktu_kejadian" value="{{ old('waktu_kejadian') }}" required class="shadow appearance-none border rounded-l w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <button type="button" onclick="setNow()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r text-sm">Sekarang</button>
                </div>
            </div>

            <div class="col-span-1 md:col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Posisi CCTV *</label>
                <input type="text" name="posisi_cctv" value="{{ old('posisi_cctv') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: Lobi Utama">
            </div>

            <div class="col-span-1 md:col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Alasan & Kronologi *</label>
                <textarea name="alasan_kronologi" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4">{{ old('alasan_kronologi') }}</textarea>
            </div>

            <div class="col-span-1 md:col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Foto KTP (Maks 5MB) *</label>
                <div class="flex flex-col space-y-3">
                    <div class="flex space-x-4">
                        <label class="cursor-pointer bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                            <span>Buka Galeri</span>
                            <input type="file" id="foto_ktp_gallery" class="hidden" accept="image/jpeg, image/png, image/jpg" onchange="handleFileSelect(this)">
                        </label>
                        <label class="cursor-pointer bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                            <span>Buka Kamera</span>
                            <input type="file" id="foto_ktp_camera" class="hidden" accept="image/jpeg, image/png, image/jpg" capture="environment" onchange="handleFileSelect(this)">
                        </label>
                    </div>
                    
                    <!-- The actual input that will be submitted -->
                    <input type="file" name="foto_ktp" id="foto_ktp_real" class="hidden" required>
                    
                    <!-- Preview Image -->
                    <div id="preview-container" class="hidden mt-4">
                        <p class="text-sm text-gray-600 mb-2">Preview Foto KTP:</p>
                        <img id="image-preview" src="#" alt="Preview" class="max-w-xs border rounded shadow-sm">
                        <button type="button" onclick="clearImage()" class="mt-2 text-sm text-red-500 hover:text-red-700">Hapus Foto</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline" type="submit">
                Kirim Pengajuan
            </button>
        </div>
    </form>
</div>

<script>
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
</script>

</body>
</html>
