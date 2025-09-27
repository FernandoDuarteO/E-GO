<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:255',
            'quantity' => 'required|string|min:1|max:255',
            'description' => 'required',
            'price' => 'required',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.string' => 'El nombre del producto debe ser una cadena de texto.',
            'name.min' => 'El nombre del producto debe tener al menos 5 caracteres.',
            'name.max' => 'El nombre del producto no debe exceder de 255 caracteres.',

            'quantity.required' => 'La cantidad del producto es obligatoria.',
            'quantity.string' => 'La cantidad del producto debe ser una cadena de texto.',
            'quantity.min' => 'La cantidad del producto debe tener al menos 1 carácter.',
            'quantity.max' => 'La cantidad del producto no debe exceder de 255 caracteres.',

            'description.required' => 'La descripción del producto es obligatoria.',

            'price.required' => 'El precio del producto es obligatorio.',

            'media_file.file' => 'El archivo debe ser un archivo válido.',
            'media_file.mimes' => 'El archivo debe ser una imagen de tipo: jpg, jpeg, png, gif.',
            'media_file.max' => 'El archivo no debe exceder de :max kilobytes.',

            'entrepreneurship_id.required' => 'El emprendimiento es obligatorio.',

            'category_id.required' => 'La categoría es obligatoria.',
        ];
    }
}
