<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class SendRequest extends FormRequest
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
            'status' => 'required|string|min:3|max:255',
            'address' => 'required',
            'product_id' => 'required',
            'delivery_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'El estado del envío es obligatorio.',
            'status.string' => 'El estado del envío debe ser una cadena de texto.',
            'status.min' => 'El estado del envío debe tener al menos 3 caracteres.',
            'status.max' => 'El estado del envío no debe exceder los 255 caracteres.',

            'address.required' => 'La dirección del envío es obligatoria.',

            'product_id.required' => 'El nombre del producto es obligatorio.',

            'delivery_id.required' => 'El nombre del delivery es obligatorio.',
        ];
    }
}
