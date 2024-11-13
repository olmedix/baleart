<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Island;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    public function island()
    {
        return $this->belongsTo(Island::class);
    }

    public function adresses()
    {
        return $this->hasMany(Address::class);
    }
}
