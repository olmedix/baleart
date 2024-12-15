<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\GuardarUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function update(GuardarUserRequest $request, string $value)
    {

        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $value)->first();
        } else {
            $user = User::find($value);
        }

        // Verificar si el usuario existe
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Filtrar solo los campos proporcionados en la petición
        $data = $request->only([
            'name',
            'lastName',
            'email',
            'phone',
            'password'
        ]);

        // Si se envía una nueva contraseña, hashearla
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Actualizar solo los campos proporcionados
        $user->update($data);

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $email)
    {
        //
    }
}
