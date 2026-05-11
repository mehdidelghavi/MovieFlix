<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subject (){
        return $this->morphTo();
    }

    public function linkFormat(){
        $model = $this->attributes['subject_type'];
        switch ($model){
            case Tickets::class:
                return route('panel.tickets.show', ['ticket' => $this->attributes['subject_id']]);
                break;
        }
    }

    public function titleFormat(){
        $model = $this->attributes['subject_type'];
        switch ($model){
            case Tickets::class:
                return 'تیکت';
                break;
        }
    }
}
