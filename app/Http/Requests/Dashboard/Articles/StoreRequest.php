<?php

namespace App\Http\Requests\Dashboard\Articles;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:100'
            ],
            'summary' => [
                'required',
                'string',
                'max:255'
            ],
            'thumbnail' => [
                'required',
                'image',
                'mimes:png,jpg,jpeg',
                'max:6024'
            ],
            'body' => [
                'required',
                'string'
            ],
            'tags' => [
                'required',
                'array'
            ],
            'tags.*' => [
                'required',
                'string',
                'max:255'
            ],
            'is_published' => [
                'required',
                'boolean'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi',
            'title.string' => 'Judul harus berupa string',
            'title.max' => 'Judul maksimal 255 karakter',
            'summary.required' => 'Ringkasan harus diisi',
            'summary.string' => 'Ringkasan harus berupa string',
            'summary.max' => 'Ringkasan maksimal 255 karakter',
            'thumbnail.required' => 'Gambar harus diisi',
            'thumbnail.image' => 'Gambar harus berupa gambar',
            'thumbnail.mimes' => 'Gambar harus berupa gambar dengan format png, jpg, atau jpeg',
            'thumbnail.max' => 'Gambar maksimal 6 MB',
            'body.required' => 'Konten harus diisi',
            'body.string' => 'Konten harus berupa string',
            'body.max' => 'Konten maksimal 255 karakter',
            'tags.required' => 'Tag harus diisi',
            'tags.array' => 'Tag harus berupa array',
            'tags.*.required' => 'Tag harus diisi',
            'tags.*.string' => 'Tag harus berupa string',
            'tags.*.max' => 'Tag maksimal 255 karakter',
            'is_published.required' => 'Published harus diisi',
            'is_published.boolean' => 'Published harus berupa boolean',
        ];
    }
}
