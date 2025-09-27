<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EntrepreneurRequest extends FormRequest
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
            'identification_card' => ['required','string','min:16',Rule::unique('entrepreneurs')->ignore($this->entrepreneur)],
            'telephone' => ['required','string','min:8',Rule::unique('entrepreneurs')->ignore($this->entrepreneur)],
            'email' => ['required','string','min:5','max:255',Rule::unique('entrepreneurs')->ignore($this->entrepreneur)],
            'country' => 'required|string|min:5|max:255',
            'nationality' => 'required|string|min:5|max:255',
            'municipality' => 'required|string|min:5|max:255',
            'department' => 'required|string|min:5|max:255',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ];
    }

    public function messages(){
        return[
            'name.required' => 'El nombre del emprendedor es requerido.',
            'name.string' => 'El nombre del emprendedor debe contener solo caracteres.',
            'name.min' => 'El nombre del emprendedor tiene un minimo de 5.',
            'name.max' => 'El nombre del emprendedor tiene un máximo de 255.',

            'age.required' => 'La edad del emprendedor es requerida.',
            'age.string' => 'La edad del emprendedor debe ser una cadena de texto.',
            'age.min' => 'La edad del emprendedor debe tener un mínimo de 2 caracteres.',
            'age.max' => 'La edad del emprendedor debe tener un máximo de 3 caracteres.',

            'sex.required' => 'El sexo del emprendedor es requerido.',

            'identification_card.required' => 'La cédula del emprendedor es requerida.',
            'identification_card.string' => 'La cédula del emprendedor debe ser una cadena de texto.',
            'identification_card.unique' => 'La cédula del emprendedor ya está registrada.',
            'identification_card.min' => 'La cédula del emprendedor debe tener un mínimo de 16 caracteres.',

            'telephone.required' => 'El teléfono del emprendedor es requerido.',
            'telephone.string' => 'El teléfono del emprendedor debe ser una cadena de texto.',
            'telephone.unique' => 'El teléfono del emprendedor ya está registrado.',
            'telephone.min' => 'El teléfono del emprendedor debe tener un mínimo de 8 caracteres.',

            'email.required' => 'El correo electrónico del emprendedor es requerido.',
            'email.string' => 'El correo electrónico del emprendedor debe ser una cadena de texto.',
            'email.unique' => 'El correo electrónico del emprendedor ya está registrado.',
            'email.min' => 'El correo electrónico del emprendedor debe tener un mínimo de 5 caracteres.',
            'email.max' => 'El correo electrónico del emprendedor debe tener un máximo de 255 caracteres.',

            'country.required' => 'El país del emprendedor es requerido.',
            'country.string' => 'El país del emprendedor debe ser una cadena de texto.',
            'country.min' => 'El país del emprendedor debe tener un mínimo de 5 caracteres.',
            'country.max' => 'El país del emprendedor debe tener un máximo de 255 caracteres.',

            'nationality.required' => 'La nacionalidad del emprendedor es requerida.',
            'nationality.string' => 'La nacionalidad del emprendedor debe ser una cadena de texto.',
            'nationality.min' => 'La nacionalidad del emprendedor debe tener un mínimo de 5 caracteres.',
            'nationality.max' => 'La nacionalidad del emprendedor debe tener un máximo de 255 caracteres.',

            'municipality.required' => 'La municipalidad del emprendedor es requerida.',
            'municipality.string' => 'La municipalidad del emprendedor debe ser una cadena de texto.',
            'municipality.min' => 'La municipalidad del emprendedor debe tener un mínimo de 5 caracteres.',
            'municipality.max' => 'La municipalidad del emprendedor debe tener un máximo de 255 caracteres.',

            'department.required' => 'El departamento del emprendedor es requerido.',
            'department.string' => 'El departamento del emprendedor debe ser una cadena de texto.',
            'department.min' => 'El departamento del emprendedor debe tener un mínimo de 5 caracteres.',
            'department.max' => 'El departamento del emprendedor debe tener un máximo de 255 caracteres.',
            
            'media_file.nullable' => 'El archivo es opcional.',
            'media_file.file' => 'El archivo debe ser un archivo válido.',
            'media_file.mimes' => 'El archivo debe ser de tipo: jpg, jpeg, png, pdf.',
            'media_file.max' => 'El archivo no debe ser mayor a 2MB.',
        ];
    }
}
