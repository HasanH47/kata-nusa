@extends('layouts.app')

@section('title', 'Edit Profil - KataNusa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Edit Profil</h1>

        <form action="/dashboard/profile" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex items-center space-x-6 mb-6">
                <div class="shrink-0">
                    @if (auth()->user()->author->avatar)
                    <img id="preview" src="{{ auth()->user()->author->avatar }}0" alt="Profile" class="h-24 w-24 object-cover rounded-full">
                    @else
                    <div id="preview" class="h-24 w-24 bg-gray-200 flex items-center justify-center text-2xl font-bold text-gray-700 rounded-full">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    @endif
                </div>
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                    <input type="file"
                           id="avatar"
                           name="avatar"
                           accept="image/*"
                           class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-gray-50 file:text-gray-700
                                  hover:file:bg-gray-100">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text"
                       id="name"
                       name="name"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                       value="{{ auth()->user()->name }}">
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text"
                       id="username"
                       name="username"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                       value="{{ auth()->user()->author->username }}">
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                <textarea id="bio"
                          name="bio"
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                          placeholder="Ceritakan sedikit tentang diri Anda...">{{ auth()->user()->author->bio }}</textarea>
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <input type="text"
                       id="location"
                       name="location"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                       placeholder="Kota, Provinsi"
                       value="{{ auth()->user()->author->address }}">
            </div>

            <div>
                <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                <input type="url"
                       id="website"
                       name="website"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                       placeholder="https://example.com"
                       value="{{ auth()->user()->author->website }}">
            </div>

            <div class="pt-4 border-t border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Ubah Email</h2>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Baru</label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                           value="{{ auth()->user()->email }}">
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Ubah Kata Sandi</h2>
                <div class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Saat Ini</label>
                        <input type="password"
                               id="current_password"
                               name="current_password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    </div>
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
                        <input type="password"
                               id="new_password"
                               name="new_password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    </div>
                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                        <input type="password"
                               id="new_password_confirmation"
                               name="new_password_confirmation"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const avatar = document.getElementById('avatar');
        const preview = document.getElementById('preview');

        if (avatar) {
            avatar.addEventListener('change', function() {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (preview.tagName === 'DIV') {
                        const img = document.createElement('img');
                        img.id = 'preview';
                        img.src = e.target.result;
                        img.alt = 'Profile';
                        img.className = 'h-24 w-24 object-cover rounded-full';
                        preview.replaceWith(img);
                    } else {
                        preview.src = e.target.result;
                    }
                };
                reader.readAsDataURL(this.files[0]);
            });
        }
    });
</script>
@endpush
