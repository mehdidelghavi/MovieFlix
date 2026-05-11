<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actors extends Model
{
    protected $guarded = ['id'];

    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'actor_movie','actor_id','movie_id');
    }
}
