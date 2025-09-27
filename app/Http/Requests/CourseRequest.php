<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:255',
            'description' => 'required',
            'type' => 'required|string|min:5|max:255',
            'duration' => 'required|string|min:2|max:255',
            'code_course' => ['required', 'string', 'min:5', 'max:100', Rule::unique('courses')->ignore($this->course)],
            'entrepreneur_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título del curso es obligatorio.',
            'title.string' => 'El título del curso debe ser una cadena de texto.',
            'title.min' => 'El título del curso debe tener al menos :min caracteres.',
            'title.max' => 'El título del curso no debe exceder los :max caracteres.',

            'description.required' => 'La descripción del curso es obligatoria.',

            'type.required' => 'El tipo del curso es obligatorio.',
            'type.string' => 'El tipo del curso debe ser una cadena de texto.',
            'type.min' => 'El tipo del curso debe tener al menos :min caracteres.',
            'type.max' => 'El tipo del curso no debe exceder los :max caracteres.',

            'duration.required' => 'La duración del curso es obligatoria.',
            'duration.string' => 'La duración del curso debe ser una cadena de texto.',
            'duration.min' => 'La duración del curso debe tener al menos :min caracteres.',
            'duration.max' => 'La duración del curso no debe exceder los :max caracteres.',

            'code_course.required' => 'El código del curso es obligatorio.',
            'code_course.string' => 'El código del curso debe ser una cadena de texto.',
            'code_course.min' => 'El código del curso debe tener al menos :min caracteres.',
            'code_course.max' => 'El código del curso no debe exceder los :max caracteres.',
            'code_course.unique' => 'El código del curso ya está en uso. Por favor, elige otro código.',

            'entrepreneur_id.required' => 'El username del emprendedor es obligatorio.'
        ];
    }
}
