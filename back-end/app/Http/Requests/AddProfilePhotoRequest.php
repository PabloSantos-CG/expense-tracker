<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProfilePhotoRequest extends FormRequest
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
            'avatar' => ['required', 'image', 'mimes:png,jpg', 'max:2048'],
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
            'avatar.required' => 'Imagem obrigatória.',
            'avatar.image' => 'Imagem inválida!',
            'avatar.mimes' => 'Extensão inválida!',
            'avatar.image' => 'A imagem deve ter no máximo 2mb.',
        ];
    }
}
