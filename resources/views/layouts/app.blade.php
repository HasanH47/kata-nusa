<!DOCTYPE html>
<html lang="id">
<head>
    {!! seo($page ?? $SEOData) !!}
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white min-h-screen font-inter">
    <!-- Header -->
    <header class="border-b border-gray-200">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <!-- Logo -->
                    <a href="/" class="flex items-center">
                        <span class="text-2xl font-bold text-gray-900">KataNusa</span>
                    </a>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="{{ route('home')}}" class="text-gray-700 hover:text-gray-900">Beranda</a>
                        <a href="{{route('categories.index')}}" class="text-gray-700 hover:text-gray-900">Kategori</a>
                        <a href="{{route('trending')}}" class="text-gray-700 hover:text-gray-900">Trending</a>
                        <a href="{{route('about')}}" class="text-gray-700 hover:text-gray-900">Tentang</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="hidden md:block">
                        <div class="relative">
                            <input type="text"
                                   placeholder="Cari artikel..."
                                   class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-500">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-2">
                        <a href="{{route('login')}}" class="px-4 py-2 text-gray-700 hover:text-gray-900">Masuk</a>
                        <a href="{{route('register')}}" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">Daftar</a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button class="md:hidden">
                        <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 h-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 bg-white">
        <div class="container mx-auto px-4 py-6">
            <div class="text-center text-gray-600">
                <p>&copy; {{ date('Y') }} KataNusa. Menyatukan Cerita dari Seluruh Nusantara.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
