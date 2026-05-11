<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

    public function replies(){
        return $this->hasMany(TicketReply::class,'ticket_id', 'id');
    }

    public function departmanFormat(){
        switch ($this->attributes['departman']){
            case 'support-departman':
                return "<span class='badge bg-label-primary'>پشتیبانی</span>";
                break;
            case 'contact-departman':
                return "<span class='badge bg-label-primary'>ارتباط با ما</span>";
                break;
            case 'ads-departman"':
                return "<span class='badge bg-label-primary'>رزرو تبلیغات</span>";
                break;
        }
    }

    public function announcements()
    {
        return $this->morphMany(Announcements::class, 'subject')->where('user_id', auth()->user()->id);
    }

    public function route(){
        return route('dashboard.tickets.show', ['ticket' => $this->id]);
    }

    public function userAnnouncementRoute(){
        return route('panel.tickets.show', ['ticket' => $this->id]);
    }
}
