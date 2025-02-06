<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use App\Models\Comment;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $fillable = [
        'name',
        'regNumber',
        'observation_CA',
        'observation_ES',
        'observation_EN',
        'email',
        'phone',
        'website',
        'access_types',
        'totalScore',
        'countScore',
        'address_id',
        'space_types_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function spaceType()
    {
        return $this->belongsTo(SpaceType::class);
    }

    public function modalities()
    {
        return $this->belongsToMany(Modality::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
