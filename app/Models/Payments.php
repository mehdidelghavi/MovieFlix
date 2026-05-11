<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $guarded = ['id'];
    public $table = "payments";

    public function plan(){
        return $this->belongsTo(Plans::class, 'plan_id', 'id');
    }

        public function subscription(){
        return $this->belongsTo(Subescriptions::class, 'subescription_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function getFormattedStatusAttribute(){
        switch($this->status){
            case 0:
                return "<span class='badge bg-label-primary'>در انتظار درگاه</span>";
                break;
            case 1:
                return "<span class='badge bg-label-warning'>در انتظار پرداخت</span>";
                break;
            case 2:
                return "<span class='badge bg-label-success'>پرداخت شده</span>";
                break;
            case 3:
                return "<span class='badge bg-label-danger'>پرداخت ناموفق</span>";
                break;
        }
    }
}
