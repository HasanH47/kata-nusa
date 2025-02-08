@extends('layouts.app')

@section('title', 'Edit Artikel - KataNusa')

@section('content')
<div class="mx-auto">
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Edit Artikel</h1>

        <form id="article-form" action="{{ route('dashboard.articles.update', $article->uuid) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="is_published" id="is_published" value="{{ $article->is_published }}">

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel</label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title', $article->title) }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                       placeholder="Masukkan judul artikel yang menarik">
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="summary" class="block text-sm font-medium text-gray-700 mb-1">Ringkasan</label>
                <textarea id="summary"
                          name="summary"
                          rows="3"
                          required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                          placeholder="Tuliskan ringkasan singkat artikel (maksimal 150 karakter)">{{ old('summary', $article->summary) }}</textarea>
                @error('summary')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div id="preview-wrapper" class="py-4 rounded-lg {{ $article->thumbnail ? '' : 'hidden' }}">
                <img id="preview" class="w-full rounded-lg" src="{{ $article->thumbnail ? $article->thumbnail : '' }}" alt="Preview Gambar">
            </div>

            <div>
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Gambar Cover</label>
                <input type="file"
                       id="thumbnail"
                       name="thumbnail"
                       accept="image/*"
                       class="block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-gray-50 file:text-gray-700
                              hover:file:bg-gray-100">
                <p class="mt-1 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar</p>
                @error('thumbnail')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
                <div id="editor" class="min-h-[400px] border border-gray-300 rounded-lg"></div>
                <input type="hidden" name="body" id="body" value="{{ old('body', $article->body) }}" required>
                @error('body')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tag</label>
                <div id="tag-container" class="flex flex-wrap gap-2 border border-gray-300 rounded-lg p-2">
                    <input type="text"
                           id="tag-input"
                           class="flex-grow px-4 py-2 border-none focus:outline-none focus:ring-0"
                           placeholder="Tambahkan tag (pisahkan dengan koma)"
                           required>
                </div>
                <input type="hidden" name="tags[]" id="tags" value="{{ old('tags', json_encode($article->articleCategories->pluck('category.name'))) }}">
                @error('tags')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('dashboard.articles.index') }}"
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="button"
                        id="draft"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Simpan sebagai Draft
                </button>
                <button type="button"
                        id="publish"
                        class="px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                    {{ $article->is_published ? 'Update Artikel' : 'Terbitkan' }}
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

    document.addEventListener('DOMContentLoaded', function() {
        const isPublishedInput = document.getElementById('is_published');
        const editorInput = document.getElementById('editor');
        const bodyInput = document.getElementById('body');
        const thumbnailInput = document.getElementById('thumbnail');
        const previewWrapper = document.getElementById('preview-wrapper');
        const preview = document.getElementById('preview');
        const tagInput = document.getElementById('tag-input');
        const tagContainer = document.getElementById('tag-container');
        const hiddenTagInput = document.getElementById('tags');
        const draftButton = document.getElementById('draft');
        const publishButton = document.getElementById('publish');
        const articleForm = document.getElementById('article-form');

        let tags = [];

        var oldBody = document.getElementById('body').value;
        if (oldBody) {
            quill.root.innerHTML = oldBody;
        }

        if (thumbnailInput) {
            thumbnailInput.addEventListener('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewWrapper.classList.remove('hidden');
                };
                reader.readAsDataURL(this.files[0]);
            });
        }

        if (tagInput) {
            tagInput.addEventListener('keypress', function(event) {
                if (event.key === ',') {
                    event.preventDefault();
                    const tag = tagInput.value.trim().replace(',', '');
                    if (tag && !tags.includes(tag)) {
                        tags.push(tag);
                        addTagBadge(tag);
                        tagInput.value = '';
                        updateHiddenTagInput();
                    }
                }
            });
        }

        function addTagBadge(tag) {
            const badge = document.createElement('span');
            badge.className = 'inline-flex items-center bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-sm font-medium';
            badge.textContent = tag;

            const removeButton = document.createElement('button');
            removeButton.className = 'ml-2 text-gray-500 hover:text-gray-700 focus:outline-none';
            removeButton.textContent = 'x';
            removeButton.onclick = function() {
                removeTag(tag);
            };

            badge.appendChild(removeButton);
            tagContainer.insertBefore(badge, tagInput);
        }

        function removeTag(tag) {
            tags = tags.filter(t => t !== tag);
            updateHiddenTagInput();
            renderTags();
        }

        function updateHiddenTagInput() {
            hiddenTagInput.value = JSON.stringify(tags);
        }

        function renderTags() {
            const badges = tagContainer.querySelectorAll('.inline-flex');
            badges.forEach(badge => badge.remove());
            tags.forEach(tag => addTagBadge(tag));
        }

        if (hiddenTagInput && hiddenTagInput.value) {
                tags = JSON.parse(hiddenTagInput.value);
                renderTags();
        }

        if (draftButton) {
            draftButton.addEventListener('click', function(e) {
                e.preventDefault();
                bodyInput.value = quill.root.innerHTML;
                isPublishedInput.value = '0';
                articleForm.submit();
            });
        }

        if (publishButton) {
            publishButton.addEventListener('click', function(e) {
                e.preventDefault();
                bodyInput.value = quill.root.innerHTML;
                isPublishedInput.value = '1';
                articleForm.submit();
            });
        }
    });
</script>
@endpush
