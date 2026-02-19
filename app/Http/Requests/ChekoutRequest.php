<?php

namespace App\Http\Requests;

use App\Enums\ShippingPlatform;
use App\Rules\FullNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChekoutRequest extends FormRequest
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
            'product_slug' => ['required', 'string', 'exists:products,slug'],
            'name' => ['required', 'string', new FullNameRule],
            'email' => ['required', 'email'],
            'player_id' => ['required', 'string'],
            'platform' => ['required', 'min:5', 'max:75', Rule::in(ShippingPlatform::values())],
            'terms' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Informe seu nome completo.',
            'name.min' => 'O nome deve ter pelo menos 5 caracteres.',
            'name.max' => 'O nome deve ter no máximo 75 caracteres.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'player_id.required' => 'O player id e obrigatório',
            'platform.required' => 'Selecione uma plataforma.',
            'platform.in' => 'Plataforma inválida.',
            'terms.accepted' => 'Você deve aceitar os termos e condições.',
        ];
    }
}
