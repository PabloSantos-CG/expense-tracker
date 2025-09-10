<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'is_global' => [
                Auth::user()->is_admin ? 'boolean' : 'prohibited'
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'O título não pode ser nulo.',
            'title.string' => 'O título deve ser uma string.',
            'title.max' => 'O título não pode ser maior do que 255 caracteres.',
            'is_global.prohibited' => 'Unauthorized!',
            'is_global.boolean' => 'O atributo deve ser um booleano.'
        ];
    }
}
