@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Trending di KataNusa</h1>

    <!-- Time Period Filter -->
    <div class="bg-white border border-gray-200 rounded-lg p-4 mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('trending', ['period' => 'daily'])}}"
               class="px-4 py-2 text-gray-700 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-100
               {{ request('period', 'daily') === 'daily' ? 'bg-gray-900 text-white hover:bg-gray-800' : ''}}">
               Hari Ini
            </a>
            <a href="{{ route('trending', ['period' => 'weekly'])}}"
               class="px-4 py-2 text-gray-700 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-100
               {{ request('period') === 'weekly' ? 'bg-gray-900 text-white hover:bg-gray-800' : ''}}">
               Minggu Ini
            </a>
            <a href="{{ route('trending', ['period' => 'monthly'])}}"
               class="px-4 py-2 text-gray-700 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-100
               {{ request('period') === 'monthly' ? 'bg-gray-900 text-white hover:bg-gray-800' : ''}}">
               Bulan Ini
            </a>
            <a href="{{ route('trending', ['period' => 'yearly'])}}"
               class="px-4 py-2 text-gray-700 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-100
               {{ request('period') === 'yearly' ? 'bg-gray-900 text-white hover:bg-gray-800' : ''}}">
               Tahun Ini
            </a>
        </div>
    </div>

    <!-- Trending Articles -->
    <div class="space-y-6">
        @foreach($articles as $article)
        <article class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start space-x-6">
                <span class="text-4xl font-bold text-gray-200">{{ str_pad($article, 2, '0', STR_PAD_LEFT) }}</span>
                <div class="flex-1">
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="{{ $article->author->avatar }}" alt="{{ $article->author->username }}" class="w-10 h-10 rounded-full">
                        <div>
                            <h3 class="font-medium text-gray-900">Penulis {{ $article->author->user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $article->updated_at }}</p>
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900 mb-2 hover:text-gray-700">
                        <a href="#">Judul Artikel Trending {{ $article->title }}</a>
                    </h2>

                    <p class="text-gray-600 mb-4">
                        {{ $article->summary }}
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-6 text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9. <boltAction type="file" filePath="resources/views/trending.blade.php">542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ $article->views }}
                            </span>
                            <span class="flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                {{ $article->likes }}
                            </span>
                            <span class="flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                                {{ $article->articleComments->count() }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ rand(3, 10) }} menit baca</span>
                            <div class="flex items-center space-x-1 text-sm">
                                @foreach ($article->articleCategories as $articleCategory)
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-lg">#{{ $articleCategory->category->name }}</span>
                                @endforeach
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
