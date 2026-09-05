<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kusuma Agrowisata</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <nav class="bg-green-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="font-bold text-xl tracking-tight">Kusuma Agrowisata Admin</span>
                </div>
                
                @auth('admin')
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.riwayat') }}" class="hover:bg-green-600 px-3 py-2 rounded-md text-sm font-medium">Riwayat Laporan</a>
                    <a href="{{ route('admin.password.change') }}" class="hover:bg-green-600 px-3 py-2 rounded-md text-sm font-medium">Ganti Password</a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-2 rounded-md text-sm font-medium transition">Logout</button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 py-8 max-w-7xl">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} Kusuma Agrowisata. All rights reserved.</p>
    </footer>

</body>
</html>
