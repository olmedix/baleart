<?php

namespace App\Models;

use App\Models\SpaceUser;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function spaceUser()
    {
        return $this->belongsTo(SpaceUser::class);
    }
}
