<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
