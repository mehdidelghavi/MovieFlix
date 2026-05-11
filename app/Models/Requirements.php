<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirements extends Model
{
    protected $guarded = ['id'];

    public function files(){
        return $this->hasMany(RequirementFiles::class, 'requirement_id', 'id');
    }
}
