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
            'comments' => 'required|array',
            'comments.*.comment' => 'required|string|max:500',
            'comments.*.score' => 'required|integer|in:0,1,2,3,4,5',
            'comments.*.images' => 'nullable|array',
            'comments.*.images.*' => 'string|max:100',
        ];
    }


    public function messages(): array
    {
        return [
            'comments.required' => 'Debe proporcionar al menos un comentario.',
            'comments.array' => 'Los comentarios deben enviarse como un arreglo.',
            'comments.*.comment.required' => 'El comentario no puede estar vacío o exceder los 500 caracteres.',
            'comments.*.comment.max' => 'El comentario no puede exceder los 500 caracteres.',
            'comments.*.score.required' => 'La puntuación no puede estar vacía.',
            'comments.*.score.integer' => 'La puntuación debe ser un número entero.',
            'comments.*.score.in' => 'La puntuación debe ser un número entre 0 y 5.',
            'comments.*.images.array' => 'Las imágenes deben ser un arreglo.',
            'comments.*.images.*.string' => 'Cada URL de imagen debe ser una cadena de texto.',
            'comments.*.images.*.max' => 'La URL de la imagen no debe exceder los 100 caracteres.',
        ];
    }

}
