<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $guarded = ['id'];

    public function payments(){
        return $this->hasMany(Payments::class, 'plan_id', 'id');
    }
}
