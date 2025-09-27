<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChatRequest extends FormRequest
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
            'messages' => 'required',
            'entrepreneur_id' => 'required',
            'client_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'messages.required' => 'El campo mensaje es obligatorio.',

            'entrepreneur_id.required' => 'El username del emprendedor es obligatorio.',

            'client_id.required' => 'El username del cliente es obligatorio.'
        ];
    }
}
