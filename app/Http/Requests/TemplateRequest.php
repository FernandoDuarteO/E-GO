<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TemplateRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'type' => 'required|string|min:3|max:255',
            'format' => 'required|string|min:3|max:255',
            'template_code' => ['required','string','min:3|max:255',Rule::unique('templates')->ignore($this->template)],
            'entrepreneur_id' => 'required',
        ];
    }


    public function messages(){
        return[
            'title.required' => 'El título de la plantilla es requerido.',
            'title.string' => 'El título de la plantilla debe contener solo caracteres.',
            'title.min' => 'El título de la plantilla tiene un minimo de 3.',
            'title.max' => 'El título de la plantilla tiene un máximo de 255.',

            'type.required' => 'El tipo de la plantilla es requerido.',
            'type.string' => 'El tipo de la plantilla debe contener solo caracteres.',
            'type.min' => 'El tipo de la plantilla tiene un minimo de 3.',
            'type.max' => 'El tipo de la plantilla tiene un máximo de 255.',

            'format.required' => 'El formato de la plantilla es requerido.',
            'format.string' => 'El formato de la plantilla debe contener solo caracteres.',
            'format.min' => 'El formato de la plantilla tiene un minimo de 3.',
            'format.max' => 'El formato de la plantilla tiene un máximo de 255.',

            'template_code.required' => 'El código de la plantilla es requerido.',
            'template_code.string' => 'El código de la plantilla debe contener solo caracteres.',
            'template_code.unique' => 'El código de la plantilla ya está registrado.',
            'template_code.min' => 'El código de la plantilla tiene un minimo de 3.',
            'template_code.max' => 'El código de la plantilla tiene un máximo de 255.',

            'entrepreneur_id.required' => 'El emprendedor es requerido.',
        ];
    }
}
