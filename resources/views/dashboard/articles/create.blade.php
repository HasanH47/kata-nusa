@extends('layouts.app')

@section('title', 'Tulis Artikel - KataNusa')

@section('content')
<div class="mx-auto">
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Tulis Artikel Baru</h1>

        <form action="/articles" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel</label>
                <input type="text"
                       id="title"
                       name="title"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                       placeholder="Masukkan judul artikel yang menarik">
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Ringkasan</label>
                <textarea id="excerpt"
                          name="excerpt"
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                          placeholder="Tuliskan ringkasan singkat artikel (maksimal 150 karakter)"></textarea>
            </div>

            <div id="preview-wrapper" class="py-4 rounded-lg hidden">
                <img id="preview" class="w-full rounded-lg" src="" alt="Preview Gambar">
            </div>

            <div>
                <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Cover</label>
                <input type="file"
                       id="cover_image"
                       name="cover_image"
                       accept="image/*"
                       class="block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-gray-50 file:text-gray-700
                              hover:file:bg-gray-100">
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
                <div id="editor" class="min-h-[400px] border border-gray-300 rounded-lg"></div>
                <input type="hidden" name="content" id="content">
            </div>

            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tag</label>
                <input type="text"
                       id="tags"
                       name="tags"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                       placeholder="Tambahkan tag (pisahkan dengan koma)">
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Simpan Draft
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                    Terbitkan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'color': [] }, { 'background': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        },
        placeholder: 'Mulai menulis artikel Anda...'
    });

    // Sync editor content with hidden input
    document.querySelector('form').onsubmit = function() {
        document.querySelector('#content').value = quill.root.innerHTML;
    };

    document.querySelector('#cover_image').onchange = function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('#preview-wrapper').classList.remove('hidden');
            document.querySelector('#preview').src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    };
</script>
@endpush
