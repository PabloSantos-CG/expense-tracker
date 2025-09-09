<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class UpdateUserRequest extends FormRequest
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
            'name' => ['sometimes', 'filled', 'string', 'max:255'],
            'email' => ['sometimes', 'filled', 'email:rfc,dns', 'unique:users'],
            'password' => [
                'sometimes',
                'filled',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
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
            'name.filled' => 'O nome não pode ser nulo.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',

            'email.filled' => 'O e-mail não pode ser nulo.',
            'email.email' => 'E-mail inválido!',
            'email.unique' => 'E-mail inválido!',

            'password' => 'Senha inválida!'
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (
                    $this->missing('name') &&
                    $this->missing('email') &&
                    $this->missing('password')
                ) {
                    $validator->errors()->add(
                        'empty',
                        'É necessário enviar pelo menos um campo.'
                    );
                }
            }
        ];
    }
}
