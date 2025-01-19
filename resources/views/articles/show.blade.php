@extends('layouts.app')

@section('title', 'Judul Artikel - KataNusa')

@section('content')
<article class="max-w-4xl mx-auto">
    <div class="bg-white border border-gray-200 rounded-lg p-8 mb-8">
        <!-- Article Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Judul Artikel yang Menarik Perhatian</h1>

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <img src="https://via.placeholder.com/40" alt="Author" class="w-10 h-10 rounded-full">
                    <div>
                        <h3 class="font-medium text-gray-900">Nama Penulis</h3>
                        <p class="text-sm text-gray-500">Diterbitkan pada 12 Jan 2024</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span>123</span>
                    </button>

                    <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span>45</span>
                    </button>

                    <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                        </svg>
                        <span>Bagikan</span>
                    </button>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">#Budaya</span>
                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">#Sejarah</span>
                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">#Nusantara</span>
            </div>
        </header>

        <!-- Article Content -->
        <div class="prose prose-lg max-w-none">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

            <h2>Sub Judul Artikel</h2>

            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <blockquote>
                "Kutipan menarik dari artikel ini yang bisa menjadi highlight."
            </blockquote>

            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="bg-white border border-gray-200 rounded-lg p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Komentar (12)</h2>

        <!-- New Comment Form -->
        <form class="mb-8">
            <div class="flex space-x-4">
                <img src="https://via.placeholder.com/40" alt="Your Avatar" class="w-10 h-10 rounded-full">
                <div class="flex-1">
                    <textarea
                        rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                        placeholder="Tulis komentar Anda..."></textarea>
                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                            Kirim Komentar
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Comments List -->
        <div class="space-y-6">
            @foreach(range(1, 3) as $index)
            <div class="flex space-x-4">
                <img src="https://via.placeholder.com/40" alt="Commenter" class="w-10 h-10 rounded-full">
                <div class="flex-1">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-medium text-gray-900">Nama Komentator</h4>
                            <span class="text-sm text-gray-500">2 jam yang lalu</span>
                        </div>
                        <p class="text-gray-700">Komentar yang sangat menarik tentang artikel ini. Saya sangat setuju dengan pendapat penulis.</p>
                        <div class="mt-2 flex items-center space-x-4">
                            <button class="text-sm text-gray-500 hover:text-gray-700">Balas</button>
                            <button class="flex items-center space-x-1 text-sm text-gray-500 hover:text-gray-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span>12</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</article>
@endsection
