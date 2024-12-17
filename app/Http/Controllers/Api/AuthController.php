<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GuardarAuthRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(GuardarAuthRequest $request)
    {
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
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sesión finalizada correctamente',
        ]);
    }
}
