<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'type' => 'required|string|min:5|max:255',
            'description' => 'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'El Tipo de categoría es obligatorio.',
            'type.string' => 'El Tipo de categoría debe ser una cadena de texto.',
            'type.min' => 'El Tipo de categoría debe tener al menos 5 caracteres.',
            'type.max' => 'El Tipo de categoría no debe exceder de 255 caracteres.',

            'description.nullable' => 'La descripción es opcional.',
        ];
    }
}
