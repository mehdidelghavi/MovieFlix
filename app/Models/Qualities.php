<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualities extends Model
{
    protected $guarded = ['id'];

    public function episode(){
        return $this->hasOne(Episodes::class, "id", "episode_id");
    }
}
