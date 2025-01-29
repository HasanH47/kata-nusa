@extends('layouts.app')

@section('title', 'Masuk - KataNusa')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white border border-gray-200 rounded-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h1>
                <p class="text-gray-600 mt-2">Masuk untuk melanjutkan cerita Anda</p>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox"
                               id="remember"
                               name="remember"
                               {{ old('remember') ? 'checked' : '' }}
                               class="h-4 w-4 text-gray-900 focus:ring-gray-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                    </div>

                    {{-- <a href="/forgot-password" class="text-sm text-gray-700 hover:text-gray-900">Lupa kata sandi?</a> --}}
                </div>

                @if ($errors->has('login'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ $errors->first('login') }}</span>
                    </div>
                @endif

                <button type="submit"
                        class="w-full py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Masuk
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-gray-900 hover:text-gray-700">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection
