<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Judul Halaman -->
    <title>@yield('title', 'KataNusa - Menyatukan Cerita dari Seluruh Nusantara')</title>

    <!-- Meta Description -->
    <meta name="description" content="@yield('meta_description', 'KataNusa hadir sebagai platform yang menghubungkan para penulis dan pembaca dari berbagai latar belakang untuk berbagi cerita, pengetahuan, dan inspirasi. Kami percaya bahwa setiap tulisan, baik tentang teknologi, kehidupan, budaya, maupun ide-ide baru, memiliki nilai yang dapat memberikan perspektif segar dalam memahami dunia di sekitar kita. KataNusa adalah tempat bagi semua orang untuk menyuarakan pikiran dan menemukan wawasan baru.')">

    <!-- Meta Keywords -->
    <meta name="keywords" content="@yield('meta_keywords', 'KataNusa, artikel, penulis, pembaca, cerita, teknologi, kehidupan, budaya, ide-ide baru')">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph Tags (Untuk Social Media) -->
    <meta property="og:title" content="@yield('og_title', 'KataNusa - Menyatukan Cerita dari Seluruh Nusantara')">
    <meta property="og:description" content="@yield('og_description', 'KataNusa hadir sebagai platform yang menghubungkan para penulis dan pembaca dari berbagai latar belakang untuk berbagi cerita, pengetahuan, dan inspirasi. Kami percaya bahwa setiap tulisan, baik tentang teknologi, kehidupan, budaya, maupun ide-ide baru, memiliki nilai yang dapat memberikan perspektif segar dalam memahami dunia di sekitar kita. KataNusa adalah tempat bagi semua orang untuk menyuarakan pikiran dan menemukan wawasan baru.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/katanusa.png'))">
    <meta property="og:site_name" content="KataNusa">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'KataNusa - Menyatukan Cerita dari Seluruh Nusantara')">
    <meta name="twitter:description" content="@yield('twitter_description', 'KataNusa hadir sebagai platform yang menghubungkan para penulis dan pembaca dari berbagai latar belakang untuk berbagi cerita, pengetahuan, dan inspirasi. Kami percaya bahwa setiap tulisan, baik tentang teknologi, kehidupan, budaya, maupun ide-ide baru, memiliki nilai yang dapat memberikan perspektif segar dalam memahami dunia di sekitar kita. KataNusa adalah tempat bagi semua orang untuk menyuarakan pikiran dan menemukan wawasan baru.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/images/katanusa.png'))">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/katanusa.png') }}">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white font-inter flex flex-col min-h-screen">
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
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900">Beranda</a>
                        <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-gray-900">Kategori</a>
                        <a href="{{ route('trending') }}" class="text-gray-700 hover:text-gray-900">Trending</a>
                        <a href="{{ route('about') }}" class="text-gray-700 hover:text-gray-900">Tentang</a>
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

                    @auth
                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                            <span class="font-semibold">Hi, {{ auth()->user()->name }}</span>
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg">
                            <a href="{{ route('dashboard')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dasbor</a>
                            <form id="logout" method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                @csrf
                                <a href="#" @click.prevent="document.getElementById('logout').submit()" class="block text-gray-700 hover:bg-gray-100">Keluar</a>
                            </form>
                        </div>
                    </div>
                    @else
                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900">Masuk</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">Daftar</a>
                    </div>
                    @endauth

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
    <main class="container mx-auto px-4 py-8 flex-grow">

        @if (session('alert'))
            <x-alert :type="session('alert.type')" :message="session('alert.message')" />
        @endif

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
