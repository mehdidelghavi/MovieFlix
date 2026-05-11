<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Subescriptions extends Model
{
    protected $guarded = ['id'];
    public $table = 'subescriptions';

    public function plan(){
        return $this->belongsTo(Plans::class, 'plan_id', 'id');
    }

    public function user(){
        return $this->belongsTo(Users::class);
    }

    public function payment(){
        return $this->hasOne(Payments::class, 'subescription_id', 'id');
    }

    public function statusFormat(){
        if ($this->attributes['expireDate'] > Carbon::now()){
           return "<span class='badge bg-label-success'>فعال</span>";
        } else {
            return "<span class='badge bg-label-danger'>غیر فعال</span>";
        }
    }
}
