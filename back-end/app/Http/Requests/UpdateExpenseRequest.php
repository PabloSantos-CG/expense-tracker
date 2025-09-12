<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateExpenseRequest extends FormRequest
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
            'value' => ['sometimes', 'filled', 'numeric', 'min:0'],
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

            'value.filled' => 'O valor não pode ser nulo.',
            'value.numeric' => 'O valor deve ser um tipo numérico válido.',
            'value.min' => 'O valor não pode ser um número negativo.',
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
                    $this->missing('value')
                ) {
                    $validator->errors()->add(
                        'empty',
                        'necessário informar pelo menos um atributo.'
                    );
                }
            }
        ];
    }
}
