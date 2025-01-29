<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'remember' => $this->boolean('remember'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'remember' => [
                'nullable'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Kata sandi wajib diisi',
            'password.string' => 'Kata sandi harus berupa string',
            'password.min' => 'Kata sandi harus minimal 8 karakter',
            'password.max' => 'Kata sandi harus kurang dari 20 karakter',
            'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf besar, satu huruf kecil, dan satu angka',
            'remember.boolean' => 'Remember me harus berupa boolean',
        ];
    }
}
