<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAuthRequest extends FormRequest
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
            'name' => ['required', 'exists:users,name'],
            'email' => ['required', 'email:rfc,dns', 'exists:users,email'],
            'password' => ['required', 'exists:users,password'],
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
            'name.required' => 'A name is required',
            'name.exists' => 'User not found',
            'email.required' => 'A e-mail is required',
            'email.email' => 'Invalid e-mail',
            'email.exists' => 'User not found',
            'password.required' => 'A password is required',
            'password.exists' => 'User not found',
        ];
    }
}
