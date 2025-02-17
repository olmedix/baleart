<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\GuardarViewCommentRequest;


class ViewCommentController extends Controller
{

    public function index(Request $request)
    {
        $query = Comment::with('space', 'images', 'user');

        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        $comments = $query->orderByDesc('comments.id')->paginate(5);

        return view('comment.index', ['comments' => $comments]);
    }


    public function show(Comment $comment)
    {
        return view('comment.show', ['comment' => $comment]);
    }
    public function edit(Comment $comment)
    {
        return view('comment.edit', ['comment' => $comment]);
    }


    public function update(GuardarViewCommentRequest $request, Comment $comment)
    {
        // Validamos los datos recibidos (ya lo hace GuardarViewCommentRequest)
        $validated = $request->validated();

        // Actualizamos el comentario
        $comment->update([
            'comment' => $validated['comment'],
            'score' => $validated['score'],
            'status' => $validated['status']
        ]);

        return back()->with('status', 'Comentario actualizado correctamente');
    }

    public function destroy(Comment $comment)
    {
        $images = Image::where('comment_id', $comment->id)->get();
        foreach ($images as $image) {
            $image->delete();
        }

        $comment->delete();
        return back()->with('status', 'Comentario eliminado correctamente');
    }
}
