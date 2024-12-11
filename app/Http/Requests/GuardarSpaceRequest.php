<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarSpaceRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:500',
            'score' => 'required|numeric|min:0|max:5',
            'images' => 'nullable|array',
            'images.*' => 'string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'comment' => 'El comentario no puede estar vacío o exceder los 500 caracteres.',
            'score' => 'La puntuación debe ser un número entre 0 y 5.',
            'images.*' => 'La url de la imagen no debe exceder los 100 caracteres.',
        ];
    }
}
