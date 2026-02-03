<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
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
            'product_id' => [
                'required',
                'integer',
                Rule::exists('products', 'id')
                    ->where('active', 1),
            ],
            'first_name' => ['required', 'string', 'max:50', 'regex:/^[\p{L}\h\'\-]+$/u'],
            'last_name'  => ['required', 'string', 'max:50', 'regex:/^[\p{L}\h\'\-]+$/u'],
            'email'      => ['required', 'email', 'max:255'],
            'player_id'   => ['required', 'string', 'max:100'],
            'platform'   => ['required', 'string', 'in:Steam,Epic,Microsoft'],
            'nickname'   => ['nullable', 'string', 'max:25'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.exists' => 'O produto informado não existe ou não está ativo.',
            'first_name.regex' => 'O nome deve conter apenas letras, espaços, apóstrofos ou hífens.',
            'last_name.regex'  => 'O sobrenome deve conter apenas letras, espaços, apóstrofos ou hífens.',
        ];
    }
}
