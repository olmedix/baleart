<?php

namespace App\Models;

use App\Models\Zone;
use App\Models\Space;
use App\Models\Municipality;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function space()
    {
        return $this->hasOne(Space::class);
    }
}
