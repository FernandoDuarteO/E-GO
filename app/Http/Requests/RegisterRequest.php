<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'password' => 'required|string|min:5|max:255',
            'role' => 'required|string|min:5|max:255',
            'client_id' => 'required',
            'administrator_id' => 'required',
            'entrepreneur_id' => 'required'
        ];
    }

    public function messages(){
        return[
            'username.required' => 'El nombre de usuario es requerido.',
            'username.string' => 'El nombre de usuario debe contener solo caracteres.',
            'username.min' => 'El nombre de usuario tiene un minimo de 5.',
            'username.max' => 'El nombre de usuario tiene un máximo de 255.',

            'password.required' => 'La contraseña es requerida.',
            'password.string' => 'La contraseña debe contener solo caracteres.',
            'password.min' => 'La contraseña tiene un minimo de 5.',
            'password.max' => 'La contraseña tiene un máximo de 255.',

            'role.required' => 'El rol es requerido.',
            'role.string' => 'El rol debe contener solo caracteres.',
            'role.min' => 'El rol tiene un minimo de 5.',
            'role.max' => 'El rol tiene un máximo de 255.',

            'client_id.required' => 'El username del cliente es requerido.',

            'administrator_id.required' => 'El username del administrador es requerido.',

            'entrepreneur_id.required' => 'El username del emprendedor es requerido.'
        ];
    }
}
