<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    protected $guarded = ['id'];
    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'genre_movie','genre_id','movie_id');
    }
}
