<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieList extends Model
{
    protected $table = 'lists';

    protected $fillable = [
        'title', 'slug', 'description', 'type', 'algorithm'
    ];

    protected $casts = [
        'algorithm' => 'array',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'list_movie', 'list_id', 'movie_id');
    }
}
