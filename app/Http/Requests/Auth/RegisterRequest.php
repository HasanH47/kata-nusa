<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:authors'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama harus kurang dari 255 karakter',
            'username.required' => 'Username wajib diisi',
            'username.string' => 'Username harus berupa string',
            'username.max' => 'Username harus kurang dari 255 karakter',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email harus kurang dari 255 karakter',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Kata sandi wajib diisi',
            'password.string' => 'Kata sandi harus berupa string',
            'password.min' => 'Kata sandi harus minimal 8 karakter',
            'password.max' => 'Kata sandi harus kurang dari 20 karakter',
            'password.regex' =>
                'Kata sandi harus mengandung setidaknya satu huruf besar, satu huruf kecil, dan satu angka',
            'password.confirmed' => 'Kata sandi tidak cocok',
        ];
    }
}
