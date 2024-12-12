<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
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

    }
    public function logout()
    {

    }
}
