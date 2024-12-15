<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:users',
            'phone' => 'required|string|max:100',
            'password' => 'required|string|min:8|max:100',
        ], [
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'email_verified_at' => now(),
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => Role::where('name', 'visitant')->first()->id,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Usuario no autorizado',
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login ha sido un éxito',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);

    }
    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout ha sido un éxito'
        ]);
    }

    public function protectedRoute()
    {
        return response()->json([
            'message' => 'Aquesta és una ruta protegida per API Key',
            'user' => Auth::user(), // Si deseas incluir información del usuario autenticado
        ]);
    }

}
