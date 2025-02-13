<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarViewCommentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comment' => 'required|max:5000',
            'score' => 'required|integer|in:0,1,2,3,4,5',
            'status' => 'required|in:y,n'
        ];
    }

    public function messages(): array
    {
        return [
            'comment.required' => 'El comentario es obligatorio.',
            'comment.max' => 'El comentario no puede tener más de 5000 caracteres.',
            'score.required' => 'La puntuación es obligatoria.',
            'score.integer' => 'La puntuación debe ser un número entero.',
            'score.in' => 'La puntuación debe estar entre 0 y 5.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado debe ser "y" o "n".'
        ];
    }

}
