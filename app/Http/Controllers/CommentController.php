<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(int $userId) {
        $comments = Comment::where('user_id', $userId)->get();
    
        if ($comments->isEmpty()) {
            return response()->json(['message' => 'Comentarios no encontrados'], 404);
        }
    
        $result = $comments->map(function($comment) {
            return [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'space' => $comment->space->name,
                'user' => $comment->user_id,
                'created_at' => $comment->created_at,
                'updated_at' => $comment->updated_at
            ];
        });
    
        return response()->json($result, 200);
    }
    
}
