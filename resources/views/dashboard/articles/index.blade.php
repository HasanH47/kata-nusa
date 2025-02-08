@extends('layouts.app')

@section('title', 'Artikel Saya - KataNusa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Artikel Saya</h1>
        <a href="{{ route('dashboard.articles.create') }}"
           class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 flex items-center space-x-2">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tulis Artikel</span>
        </a>
    </div>

    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8" aria-label="Article Tabs">
            <a href="{{ route('dashboard.articles.index', ['published' => 1]) }}" class="{{ request('published', '1') === '1' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 py-4 px-1 text-sm font-medium">
            Diterbitkan ({{ $countArticlePublished }})
            </a>
            <a href="{{ route('dashboard.articles.index', ['published' => 0]) }}" class="{{ request('published') === '0' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 py-4 px-1 text-sm font-medium">
            Draft ({{ $countArticleDraft }})
            </a>
        </nav>
    </div>

    <!-- Article List -->
    <div class="space-y-6">
        @if ($articles->count() > 0)
            @foreach($articles as $article)
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        <a href="#" class="hover:text-gray-700">{{ $article->title }}</a>
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        {{ $article->summary }}
                    </p>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        @if ($article->published_at)
                            <span>Diterbitkan pada {{ $article->published_at }}</span>
                        @else
                            <span>Belum diterbitkan</span>
                        @endif
                        <span>•</span>
                        <span class="flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
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
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('dashboard.articles.edit', $article->uuid) }}" class="p-2 text-gray-500 hover:text-gray-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </a>
                    <form action="{{ route('dashboard.articles.destroy', $article->uuid) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="p-2 text-gray-500 hover:text-gray-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p>Tidak ada artikel</p>
        @endif
    </div>

    <!-- Pagination Links -->
    <div class="mt-8">
        {{ $articles->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
