@extends('layouts.app')

@section('content')
<div class="flex flex-col lg:flex-row gap-8">
    <!-- Main Content -->
    <div class="lg:w-2/3">
        @auth
            <!-- Feed Toggle -->
            <div class="flex items-center space-x-4 mb-8">
                <a href="?feed=latest" class="px-4 py-2 bg-gray-900 text-white rounded-lg">Terbaru</a>
                <a href="?feed=following" class="px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">Diikuti</a>
            </div>
        @endauth

        <!-- Article List -->
        <div class="space-y-8">
            @if ($articles->count() > 0)
            @foreach($articles as $article)
            <article class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-48 object-cover mb-4">
                <div class="flex items-center space-x-4 mb-4">
                    <img src="{{ $article->author->avatar }}" alt="{{ $article->author->username }}" class="w-10 h-10 rounded-full">
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $article->author->user->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $article->updated_at }}</p>
                    </div>
                </div>

                <h2 class="text-xl font-bold text-gray-900 mb-2 hover:text-gray-700">
                    <a href="{{route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                </h2>

                <p class="text-gray-600 mb-4">
                    {{ $article->summary }}
                </p>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
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
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500">{{ $article->setEstimatedReadingTime() }} menit baca</span>
                    </div>
                </div>
            </article>
            @endforeach
            @else
            <article class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-bold text-gray-900 mb-2 hover:text-gray-700">
                    Tidak ada artikel
                </h2>
            </article>
            @endif
        </div>

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $articles->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:w-1/3 space-y-8">
        <!-- Trending Articles -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Trending</h2>
            <div class="space-y-4">
                @if ($trendingArticles->count() > 0)
                     @foreach($trendingArticles as $trendingArticle)
                        <a href="{{ route('articles.show', $trendingArticle->slug) }}" class="flex items-start space-x-4 group">
                            <span class="text-2xl font-bold text-gray-300 group-hover:text-gray-400">0{{ $loop->iteration }}</span>
                            <div>
                                <h3 class="font-medium text-gray-900 group-hover:text-gray-700">{{ $trendingArticle->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $trendingArticle->views }} pembaca</p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="text-gray-600">Tidak ada artikel trending saat ini.</p>
                @endif
            </div>
        </div>

        <!-- Categories -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Kategori</h2>
            <div class="space-y-2">
                @if ($trendingCategories->count() > 0)
                    @foreach($trendingCategories as $trendingCategory)
                <a href="{{ route('categories.show', $trendingCategory->name) }}" class="flex items-center justify-between py-2 hover:bg-gray-50 rounded-lg px-3">
                    <span class="text-gray-700">{{ $trendingCategory->name }}</span>
                    <span class="text-sm text-gray-500">{{ $trendingCategory->articleCategories->count() }}</span>
                </a>
                @endforeach
                @else
                    <p class="text-gray-600">Tidak ada kategori saat ini.</p>
                @endif
            </div>
        </div>

        <!-- People to Follow -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Penulis untuk Diikuti</h2>
            <div class="space-y-4">
                @if ($trendingAuthors->count() > 0)
                    @foreach($trendingAuthors as $trendingAuthor)
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img src="{{ $trendingAuthor->avatar }}" alt="{{ $trendingAuthor->username }}" class="w-10 h-10 rounded-full">
                        <div>
                            <h3 class="font-medium text-gray-900">{{ $trendingAuthor->user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $trendingAuthor->followers->count() }} pengikut</p>
                        </div>
                    </div>
                    <button class="px-4 py-1 border border-gray-900 rounded-full text-sm font-medium text-gray-900 hover:bg-gray-900 hover:text-white transition-colors">
                        Ikuti
                    </button>
                </div>
                @endforeach
                @else
                    <p class="text-gray-600">Tidak ada penulis untuk diikuti saat ini.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
