<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrendingRequest extends FormRequest
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
            'period' => ['nullable', 'in:daily,weekly,monthly,yearly'],
        ];
    }

    public function messages(): array
    {
        return [
            'period.in' => 'Periode harus harian, mingguan, bulanan, atau tahunan.',
        ];
    }
}
