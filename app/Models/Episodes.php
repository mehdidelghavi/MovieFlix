<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
    protected $guarded = ['id'];

    public function qualities(){
        return $this->hasMany(Qualities::class, 'episode_id', 'id');
    }

    public function season(){
        return $this->hasOne(Seasons::class, 'id', 'season_id');
    }

    public function movie(){
        return $this->hasOne(Movies::class,'id', 'movie_id');
    }
}
