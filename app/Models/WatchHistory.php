<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchHistory extends Model
{
    protected $guarded = ['id'];

    public $table = 'watch_histories';

    public function movie(){
        return $this->belongsTo(Movies::class, 'movie_id', 'id');
    }
}
