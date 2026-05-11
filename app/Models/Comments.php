<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comments extends Model
{
    protected $guarded = [];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(Users::class, "user_id", 'id');
    }

    public function reactions(){
        return $this->hasMany(CommentReactions::class,'comment_id', 'id');
    }

    public function replies(){
        return $this->hasMany(CommentReplies::class,'comment_id', 'id');
    }

    public function route(){
        return route('dashboard.comments.show', ['comment' => $this->id]);
    }

    public function userAnnouncementRoute(){
        return route("panel.comments");
    }

    public function announcements()
    {
        return $this->morphMany(Announcements::class, 'subject')->where('user_id', auth()->user()->id);
    }
}
