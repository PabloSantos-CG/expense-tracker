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
            'avatar.required' => 'Image is required.',
            'avatar.image' => 'Invalid image!',
            'avatar.mimes' => 'Invalid file extension!',
            'avatar.max' => 'The image must be at most 2MB.',
        ];
    }
}
