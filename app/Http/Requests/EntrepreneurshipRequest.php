<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EntrepreneurshipRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'description' => 'required',
            'address' => 'required|string|min:3|max:255',
            'type' => 'required|string|min:3|max:100',
            'telephone' => ['required','string','min:8',Rule::unique('entrepreneurships')->ignore($this->entrepreneurship)],
            'email' => ['required','string','min:3','max:255',Rule::unique('entrepreneurships')->ignore($this->entrepreneurship)],
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:20480',

            'entrepreneur_id' => 'required',
            'client_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del emprendimiento es obligatorio.',
            'name.string' => 'El nombre del emprendimiento debe ser una cadena de texto.',
            'name.min' => 'El nombre del emprendimiento debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre del emprendimiento no debe exceder los 255 caracteres.',

            'description.required' => 'La descripción del emprendimiento es obligatoria.',

            'address.required' => 'La dirección del emprendimiento es obligatoria.',
            'address.string' => 'La dirección del emprendimiento debe ser una cadena de texto.',
            'address.min' => 'La dirección del emprendimiento debe tener al menos 3 caracteres.',
            'address.max' => 'La dirección del emprendimiento no debe exceder los 255 caracteres.',

            'type.required' => 'El tipo del emprendimiento es obligatorio.',
            'type.string' => 'El tipo del emprendimiento debe ser una cadena de texto.',
            'type.min' => 'El tipo del emprendimiento debe tener al menos 3 caracteres.',
            'type.max' => 'El tipo del emprendimiento no debe exceder los 100 caracteres.',

            'telephone.required' => 'El teléfono del emprendimiento es obligatorio.',
            'telephone.string' => 'El teléfono del emprendimiento debe ser una cadena de texto.',
            'telephone.min' => 'El teléfono del emprendimiento debe tener al menos 8 caracteres.',
            'telephone.unique' => 'El teléfono del emprendimiento ya está en uso.',

            'email.required' => 'El correo electrónico del emprendimiento es obligatorio.',
            'email.string' => 'El correo electrónico del emprendimiento debe ser una cadena de texto.',
            'email.min' => 'El correo electrónico del emprendimiento debe tener al menos 3 caracteres.',
            'email.max' => 'El correo electrónico del emprendimiento no debe exceder los 255 caracteres.',
            'email.unique' => 'El correo electrónico del emprendimiento ya está en uso.',

            'media_file.file' => 'El archivo de medios debe ser un archivo válido.',
            'media_file.mimes' => 'El archivo de medios debe ser una imagen (jpg, jpeg, png, gif) o un video (mp4, mov, avi).',
            'media_file.max' => 'El archivo de medios no debe exceder los 20MB.',

            'entrepreneur_id.required' => 'El nombre del emprendedor es obligatorio.',

            'client_id.required' => 'El nombre del cliente es obligatorio.',
        ];
    }
}
