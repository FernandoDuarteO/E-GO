<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
            'username' => 'required|string|min:5|max:255',
            'password' => 'required|string|min:8|max:255',

            'register_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'El nombre de usuario es requerido.',
            'username.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'username.min' => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'username.max' => 'El nombre de usuario no debe exceder los 255 caracteres.',

            'password.required' => 'La contraseña es requerida.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no debe exceder los 255 caracteres.',

            'register_id.required' => 'El rol del usuario es requerido.',
        ];
    }
}
