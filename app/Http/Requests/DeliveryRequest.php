<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryRequest extends FormRequest
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
            'type' => 'required|string|min:5|max:255',
            'email' => ['required','string','min:5','max:255',Rule::unique('deliveries')->ignore($this->delivery)],
            'telephone' => ['required','string','min:8',Rule::unique('deliveries')->ignore($this->delivery)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del delivery es obligatorio.',
            'name.string' => 'El nombre del delivery debe ser una cadena de texto.',
            'name.min' => 'El nombre del delivery debe tener al menos 5 caracteres.',
            'name.max' => 'El nombre del delivery no debe exceder de 255 caracteres.',

            'type.required' => 'El tipo de delivery es obligatorio.',
            'type.string' => 'El tipo de delivery debe ser una cadena de texto.',
            'type.min' => 'El tipo de delivery debe tener al menos 5 caracteres.',
            'type.max' => 'El tipo de delivery no debe exceder de 255 caracteres.',

            'email.required' => 'El correo electrónico del delivery es obligatorio.',
            'email.string' => 'El correo electrónico del delivery debe ser una cadena de texto.',
            'email.min' => 'El correo electrónico del delivery debe tener al menos 5 caracteres.',
            'email.max' => 'El correo electrónico del delivery no debe exceder de 255 caracteres.',
            'email.unique' => 'El correo electrónico del delivery ya está en uso.',

            'telephone.required' => 'El teléfono del delivery es obligatorio.',
            'telephone.string' => 'El teléfono del delivery debe ser una cadena de texto.',
            'telephone.min' => 'El teléfono del delivery debe tener al menos 8 caracteres.',
            'telephone.unique' => 'El teléfono del delivery ya está en uso.',
        ];
    }
}
