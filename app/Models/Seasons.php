<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{
    protected $guarded = ['id'];

    protected $table = "seasons";
    
    public function episodes(){
        return $this->hasMany(Episodes::class, 'season_id', 'id');
    }
}
