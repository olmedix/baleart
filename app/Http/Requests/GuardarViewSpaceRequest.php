<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarViewSpaceRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'regNumber' => 'required|string|max:10',
            'observation_CA' => 'required|string|max:5000',
            'observation_ES' => 'required|string|max:5000',
            'observation_EN' => 'required|string|max:5000',
            'email' => 'required|string|email|max:100',
            'phone' => 'required|string|max:100',
            'website' => 'required|string|max:100',
            'services' => 'array|exists:services,id',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'regNumber.required' => 'El número de registro es obligatorio.',
            'observation_CA.required' => 'La observación en catalán es obligatoria.',
            'observation_ES.required' => 'La observación en español es obligatoria.',
            'observation_EN.required' => 'La observación en inglés es obligatoria.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'website.required' => 'La URL del sitio web es obligatoria.',
        ];
    }

}
