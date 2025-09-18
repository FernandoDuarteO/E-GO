<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'age' => 'required|string|min:2|max:3',
            'sex' => 'required',
            'identification_card' => ['required','string','min:16',Rule::unique('clients')->ignore($this->client)],
            'telephone' => ['required','string','min:8',Rule::unique('clients')->ignore($this->client)],
            'email' => ['required','string','min:5','max:255',Rule::unique('clients')->ignore($this->client)],
            'country' => 'required|string|min:5|max:255',
            'nationality' => 'required|string|min:5|max:255',
            'municipality' => 'required|string|min:5|max:255',
            'department' => 'required|string|min:5|max:255',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ];
    }

    public function messages(){
        return[
            'name.required' => 'El nombre del cliente es requerido.',
            'name.string' => 'El nombre del cliente debe contener solo caracteres.',
            'name.min' => 'El nombre del cliente tiene un minimo de 5.',
            'name.max' => 'El nombre del cliente tiene un máximo de 255.',

            'age.required' => 'La edad del cliente es requerida.',
            'age.string' => 'La edad del cliente debe ser una cadena de texto.',
            'age.min' => 'La edad del cliente debe tener un mínimo de 2 caracteres.',
            'age.max' => 'La edad del cliente debe tener un máximo de 3 caracteres.',

            'sex.required' => 'El sexo del cliente es requerido.',

            'identification_card.required' => 'La cédula del cliente es requerida.',
            'identification_card.string' => 'La cédula del cliente debe ser una cadena de texto.',
            'identification_card.unique' => 'La cédula del cliente ya está registrada.',
            'identification_card.min' => 'La cédula del cliente debe tener un mínimo de 16 caracteres.',

            'telephone.required' => 'El teléfono del cliente es requerido.',
            'telephone.string' => 'El teléfono del cliente debe ser una cadena de texto.',
            'telephone.unique' => 'El teléfono del cliente ya está registrado.',
            'telephone.min' => 'El teléfono del cliente debe tener un mínimo de 8 caracteres.',

            'email.required' => 'El correo electrónico del cliente es requerido.',
            'email.string' => 'El correo electrónico del cliente debe ser una cadena de texto.',
            'email.unique' => 'El correo electrónico del cliente ya está registrado.',
            'email.min' => 'El correo electrónico del cliente debe tener un mínimo de 5 caracteres.',
            'email.max' => 'El correo electrónico del cliente debe tener un máximo de 255 caracteres.',

            'country.required' => 'El país del cliente es requerido.',
            'country.string' => 'El país del cliente debe ser una cadena de texto.',
            'country.min' => 'El país del cliente debe tener un mínimo de 5 caracteres.',
            'country.max' => 'El país del cliente debe tener un máximo de 255 caracteres.',

            'nationality.required' => 'La nacionalidad del cliente es requerida.',
            'nationality.string' => 'La nacionalidad del cliente debe ser una cadena de texto.',
            'nationality.min' => 'La nacionalidad del cliente debe tener un mínimo de 5 caracteres.',
            'nationality.max' => 'La nacionalidad del cliente debe tener un máximo de 255 caracteres.',

            'municipality.required' => 'La municipalidad del cliente es requerida.',
            'municipality.string' => 'La municipalidad del cliente debe ser una cadena de texto.',
            'municipality.min' => 'La municipalidad del cliente debe tener un mínimo de 5 caracteres.',
            'municipality.max' => 'La municipalidad del cliente debe tener un máximo de 255 caracteres.',

            'department.required' => 'El departamento del cliente es requerido.',
            'department.string' => 'El departamento del cliente debe ser una cadena de texto.',
            'department.min' => 'El departamento del cliente debe tener un mínimo de 5 caracteres.',
            'department.max' => 'El departamento del cliente debe tener un máximo de 255 caracteres.',
            
            'media_file.nullable' => 'El archivo es opcional.',
            'media_file.file' => 'El archivo debe ser un archivo válido.',
            'media_file.mimes' => 'El archivo debe ser de tipo: jpg, jpeg, png, pdf.',
            'media_file.max' => 'El archivo no debe ser mayor a 2MB.',
        ];
    }
}
