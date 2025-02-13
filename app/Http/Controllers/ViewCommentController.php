<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;


class ViewCommentController extends Controller
{

    public function index()
    {
        $comments = Comment::with('space', 'images')
            ->orderByDesc('comments.id')
            ->paginate(5);

        return view('comment.index', ['comments' => $comments]);
    }

    public function show(Comment $comment)
    {
        return view('comment.show', ['comment' => $comment]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }




    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
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
