<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdministratorRequest extends FormRequest
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
            'identification_card' => ['required','string','min:16',Rule::unique('administrators')->ignore($this->administrator)],
            'telephone' => ['required','string','min:8',Rule::unique('administrators')->ignore($this->administrator)],
            'email' => ['required','string','min:5','max:255',Rule::unique('administrators')->ignore($this->administrator)],
            'country' => 'required|string|min:5|max:255',
            'nationality' => 'required|string|min:5|max:255',
            'municipality' => 'required|string|min:5|max:255',
            'department' => 'required|string|min:5|max:255'
        ];
    }

    public function messages(){
        return[
            'name.required' => 'El nombre del administrador es requerido.',
            'name.string' => 'El nombre del administrador debe contener solo caracteres.',
            'name.min' => 'El nombre del administrador tiene un minimo de 5.',
            'name.max' => 'El nombre del administrador tiene un máximo de 255.',

            'age.required' => 'La edad del administrador es requerida.',
            'age.string' => 'La edad del administrador debe ser una cadena de texto.',
            'age.min' => 'La edad del administrador debe tener un mínimo de 2 caracteres.',
            'age.max' => 'La edad del administrador debe tener un máximo de 3 caracteres.',

            'sex.required' => 'El sexo del administrador es requerido.',

            'identification_card.required' => 'La cédula del administrador es requerida.',
            'identification_card.string' => 'La cédula del administrador debe ser una cadena de texto.',
            'identification_card.unique' => 'La cédula del administrador ya está registrada.',
            'identification_card.min' => 'La cédula del administrador debe tener un mínimo de 16 caracteres.',

            'telephone.required' => 'El teléfono del administrador es requerido.',
            'telephone.string' => 'El teléfono del administrador debe ser una cadena de texto.',
            'telephone.unique' => 'El teléfono del administrador ya está registrado.',
            'telephone.min' => 'El teléfono del administrador debe tener un mínimo de 8 caracteres.',

            'email.required' => 'El correo electrónico del administrador es requerido.',
            'email.string' => 'El correo electrónico del administrador debe ser una cadena de texto.',
            'email.unique' => 'El correo electrónico del administrador ya está registrado.',
            'email.min' => 'El correo electrónico del administrador debe tener un mínimo de 5 caracteres.',
            'email.max' => 'El correo electrónico del administrador debe tener un máximo de 255 caracteres.',

            'country.required' => 'El país del administrador es requerido.',
            'country.string' => 'El país del administrador debe ser una cadena de texto.',
            'country.min' => 'El país del administrador debe tener un mínimo de 5 caracteres.',
            'country.max' => 'El país del administrador debe tener un máximo de 255 caracteres.',

            'nationality.required' => 'La nacionalidad del administrador es requerida.',
            'nationality.string' => 'La nacionalidad del administrador debe ser una cadena de texto.',
            'nationality.min' => 'La nacionalidad del administrador debe tener un mínimo de 5 caracteres.',
            'nationality.max' => 'La nacionalidad del administrador debe tener un máximo de 255 caracteres.',

            'municipality.required' => 'La municipalidad del administrador es requerida.',
            'municipality.string' => 'La municipalidad del administrador debe ser una cadena de texto.',
            'municipality.min' => 'La municipalidad del administrador debe tener un mínimo de 5 caracteres.',
            'municipality.max' => 'La municipalidad del administrador debe tener un máximo de 255 caracteres.',

            'department.required' => 'El departamento del administrador es requerido.',
            'department.string' => 'El departamento del administrador debe ser una cadena de texto.',
            'department.min' => 'El departamento del administrador debe tener un mínimo de 5 caracteres.',
            'department.max' => 'El departamento del administrador debe tener un máximo de 255 caracteres.',
        ];
    }
}