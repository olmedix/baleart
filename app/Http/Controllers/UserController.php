<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\GuardarUserRequest;

class UserController extends Controller
{
    public function show()
    {
        $user = User::where('id', auth()->id())->with(['spaces', 'comments', 'comments.images'])->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return new UserResource($user);
    }


    public function getUserForPasswordReset(string $email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json([
            'name' => $user->name,
            'lastName' => $user->lastName,
            'phone' => $user->phone,
            'email' => $user->email,
        ], 200);
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

    public function destroy(string $email)
    {
        $user = User::where('email', $email)->with('comments.images', 'spaces')->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Eliminar comentarios y fotos relacionadas
        if ($user->comments) {
            foreach ($user->comments as $comment) {
                if ($comment->images) {
                    foreach ($comment->images as $image) {
                        $image->delete();
                    }
                }
                $comment->delete();
            }
        }

        // Eliminar relaciones con spaces
        $user->spaces()->delete();

        // Eliminar el usuario
        $user->delete();

        return response()->json(['message' => 'Usuario y sus relaciones eliminados correctamente'], 200);
    }
}
