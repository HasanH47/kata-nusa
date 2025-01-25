@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Trending di KataNusa</h1>

    <!-- Time Period Filter -->
    <div class="bg-white border border-gray-200 rounded-lg p-4 mb-8">
        <div class="flex items-center space-x-4">
            <a href="#" class="px-4 py-2 bg-gray-900 text-white rounded-lg">Hari Ini</a>
            <a href="#" class="px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">Minggu Ini</a>
            <a href="#" class="px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">Bulan Ini</a>
            <a href="#" class="px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">Tahun Ini</a>
        </div>
    </div>

    <!-- Trending Articles -->
    <div class="space-y-6">
        @foreach(range(1, 10) as $index)
        <article class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start space-x-6">
                <span class="text-4xl font-bold text-gray-200">{{ str_pad($index, 2, '0', STR_PAD_LEFT) }}</span>
                <div class="flex-1">
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="https://via.placeholder.com/40" alt="Author" class="w-10 h-10 rounded-full">
                        <div>
                            <h3 class="font-medium text-gray-900">Penulis {{ $index }}</h3>
                            <p class="text-sm text-gray-500">{{ date('d M Y') }}</p>
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900 mb-2 hover:text-gray-700">
                        <a href="#">Judul Artikel Trending {{ $index }}</a>
                    </h2>

                    <p class="text-gray-600 mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-6 text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9. <boltAction type="file" filePath="resources/views/trending.blade.php">542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ rand(1000, 9999) }}
                            </span>
                            <span class="flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                {{ rand(100, 999) }}
                            </span>
                            <span class="flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                                {{ rand(50, 200) }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ rand(3, 10) }} menit baca</span>
                            <div class="flex items-center space-x-1 text-sm">
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-lg">#Budaya</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-lg">#Sejarah</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</div>
@endsection
