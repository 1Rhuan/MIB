<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PixPaymentRequest extends FormRequest
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
            'item_id'    => 'required|integer|exists:items,id',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255',
            'steam_id'   => 'required|string|max:50',
            'nickname'   => 'nullable|string|max:50',
        ];

    }
}
