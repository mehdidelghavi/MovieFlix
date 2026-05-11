<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequirementFiles extends Model
{
    protected $guarded = ['id'];

    public function requirement(){
        return $this->belongsTo(Requirements::class, 'requirement_id', 'id');
    }
}
