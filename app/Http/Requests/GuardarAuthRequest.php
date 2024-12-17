<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarAuthRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:users',
            'phone' => 'required|string|max:100',
            'password' => 'required|string|min:8|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            // Mensajes personalizados 
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 100 caracteres.',
            'lastName.required' => 'El apellido es obligatorio.',
            'lastName.max' => 'El apellido no puede tener más de 100 caracteres.',
            'email.max' => 'El correo electrónico no puede tener más de 100 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.max' => 'El teléfono no puede tener más de 100 caracteres.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 100 caracteres.',
        ];
    }
}
