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
            'score' => 'required|integer|in:0,1,2,3,4,5',
            'images' => 'nullable|array',
            'images.*' => 'string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'comment.required' => 'El comentario no puede estar vacío o exceder los 500 caracteres.',
            'comment.max' => 'El comentario no puede exceder los 500 caracteres.',
            'score.required' => 'La puntuación no puede estar vacía.',
            'score.numeric' => 'La puntuación debe ser un número.',
            'score.in' => 'La puntuación debe ser un número entre 0 y 5.',
            'images.*.max' => 'La url de la imagen no debe exceder los 100 caracteres.',
        ];
    }
}
