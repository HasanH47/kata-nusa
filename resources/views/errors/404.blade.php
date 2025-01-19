@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - KataNusa')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-9xl font-bold text-gray-900">404</h1>
        <p class="mt-4 text-xl text-gray-600">Maaf, halaman yang Anda cari tidak ditemukan.</p>
        <a href="/" class="inline-block mt-8 px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
