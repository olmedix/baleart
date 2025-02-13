<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\GuardarAuthRequest;

class ViewUserController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->query('orderBy', 'created_at'); // Por defecto, 'created_at'

        $users = User::query()->orderBy($orderBy, 'desc')->paginate(10);

        return view('user.index', ['users' => $users, 'orderBy' => $orderBy]);
    }

    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }


    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(GuardarAuthRequest $request, User $user)
    {
        $validate = $request->validated();

        $user->update([
            'name' => $validate['name'],
            'lastName' => $validate['lastName'],
            'email' => $validate['email'],
            'phone' => $validate['phone']
        ]);

        return back();
    }


    //Solo se puede eliminar usuarios con rol == visitant
    public function destroy(User $user)
    {
        $comments = Comment::where('user_id', $user->id)->get();
        foreach ($comments as $comment) {
            // Eliminar imágenes asociadas al comentario
            $images = Image::where('comment_id', $comment->id)->get();
            foreach ($images as $image) {
                $image->delete();
            }
            $comment->delete();
        }

        $user->delete();
        return back();
    }
}
