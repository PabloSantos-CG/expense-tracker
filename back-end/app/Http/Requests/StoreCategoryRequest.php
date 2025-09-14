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
            'title' => ['required', 'string', 'max:255', 'unique:categories'],
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
            'title.required' => 'Title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title cannot be longer than 255 characters.',
            'title.unique' => 'The title already exists.',
            
            'is_global.prohibited' => 'Unauthorized!',
            'is_global.boolean' => 'The attribute must be a boolean.',
        ];
    }
}
