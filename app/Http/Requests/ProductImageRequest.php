<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Ajusta esto según tu lógica de permisos (policies/roles).
        return true;
    }

    public function rules(): array
    {
        return [
            // FK al producto
            'product_id'   => ['required', 'exists:products,id'],

            // Soportamos tanto subida individual (file) como múltiple (media_files[])
            // Al menos uno debe estar presente: file o media_files
            'file'         => ['sometimes', 'required_without:media_files', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'media_files'  => ['sometimes', 'required_without:file', 'array'],
            'media_files.*'=> ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],

            // Metadatos opcionales
            'order'        => ['nullable', 'integer', 'min:0'],
            'orders'       => ['nullable', 'array'],
            'orders.*'     => ['nullable', 'integer', 'min:0'],
            'alt'          => ['nullable', 'string', 'max:255'],
            'alts'         => ['nullable', 'array'],
            'alts.*'       => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required'      => 'El producto es obligatorio.',
            'product_id.exists'        => 'El producto seleccionado no existe.',

            'file.required_without'    => 'Debes enviar una imagen o un arreglo de imágenes (media_files).',
            'file.image'               => 'El archivo debe ser una imagen.',
            'file.mimes'               => 'Formatos permitidos: jpeg, png, jpg, gif, webp.',
            'file.max'                 => 'La imagen no debe pesar más de 5 MB.',

            'media_files.required_without' => 'Debes enviar al menos una imagen.',
            'media_files.array'         => 'media_files debe ser un arreglo de archivos.',
            'media_files.*.image'       => 'Cada elemento en media_files debe ser una imagen.',
            'media_files.*.mimes'       => 'Formatos permitidos en media_files: jpeg, png, jpg, gif, webp.',
            'media_files.*.max'         => 'Cada imagen en media_files no debe pesar más de 5 MB.',

            'order.integer'             => 'El order debe ser un número entero.',
            'order.min'                 => 'El order no puede ser negativo.',
            'orders.array'              => 'orders debe ser un arreglo.',
            'orders.*.integer'          => 'Cada order en orders debe ser un número entero.',
            'orders.*.min'              => 'Cada order no puede ser negativo.',

            'alt.string'                => 'El texto alternativo debe ser una cadena.',
            'alt.max'                   => 'El texto alternativo no debe exceder 255 caracteres.',
            'alts.array'                => 'alts debe ser un arreglo.',
            'alts.*.max'                => 'Cada texto alternativo no debe exceder 255 caracteres.',
        ];
    }
}