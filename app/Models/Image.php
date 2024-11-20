<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    use HasFactory;

}
