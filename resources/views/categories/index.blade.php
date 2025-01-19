@extends('layouts.app')

@section('title', 'Kategori - KataNusa')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Jelajahi Kategori</h1>

    <!-- Category Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach(['Budaya', 'Sejarah', 'Kuliner', 'Wisata', 'Seni', 'Tradisi', 'Bahasa', 'Arsitektur', 'Kerajinan'] as $category)
        <a href="/categories/{{ strtolower($category) }}" class="group">
            <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900 group-hover:text-gray-700">{{ $category }}</h2>
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                        {{ rand(50, 200) }} artikel
                    </span>
                </div>
                <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
                <div class="flex items-center text-gray-500">
                    <span class="text-sm">Lihat artikel</span>
                    <svg class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
