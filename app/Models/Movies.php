<?php

namespace App\Models;

use App\Contracts\CommentableLink;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Movies extends Model implements CommentableLink
{
    protected $guarded = ['id'];

    protected $casts = [
        'title' => 'array',
        'director' => 'array'
    ];



    public function getCommentLink($limit = 20): string
    {
        return "<a href='". route('index.movie', ['slug' => $this->slug]) ."'>
                    ". Str::limit($this->title[0], $limit) ."
                </a>";
    }

    public function actors(){
        return $this->belongsToMany(Actors::class,'actor_movie', 'movie_id', 'actor_id');
    }

    public function seasons(){
        return $this->hasMany(Seasons::class, 'movie_id', 'id');
    }

    public function episodes(){
        return $this->hasMany(Episodes::class, 'movie_id', 'id');
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function genres(){
        return $this->belongsToMany(Genres::class,'genre_movie', 'movie_id', 'genre_id');
    }

    public function collection(){
        return $this->hasOne(Collections::class,'id', 'collection_id');
    }

    public function lists(){
        return $this->belongsToMany(MovieList::class,'list_movie', 'movie_id', 'list_id');
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

    public function reactions()
    {
        return $this->hasMany(MovieReaction::class, 'movie_id', 'id');
    }

    public function getFormattedDurationAttribute()
    {
        $hours = intdiv($this->time, 60);
        $minutes = $this->time % 60;
        if ($minutes == 0){
            return $hours . ' ساعت ';
        } elseif($hours == 0) {
            return $minutes . ' دقیقه';
            
        } else {
            return $hours . ' ساعت ' . $minutes . ' دقیقه';
        }
    }
}
