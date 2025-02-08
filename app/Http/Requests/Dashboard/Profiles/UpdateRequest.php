<?php

namespace App\Http\Requests\Dashboard\Profiles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
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
            'name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'username' => [
                'nullable',
                'string',
                'max:255',
                'unique:authors,username,' . Auth::user()->author->id,
            ],
            'bio' => [
                'nullable',
                'string',
                'max:255',
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg',
                'max:6024',
            ],
            'address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'website' => [
                'nullable',
                'url',
                'max:255',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:users,email,' . Auth::id(),
            ],
            'old_password' => [
                'nullable',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed'
            ],
        ];
    }
}
