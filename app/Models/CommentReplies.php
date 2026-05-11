<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentReplies extends Model
{
    protected $guarded = ['id'];

    public $table = "comment_replies";

    public function user(){
        return $this->belongsTo(Users::class, "user_id", 'id');
    }

    public function comment(){
        return $this->belongsTo(Comments::class, 'comment_id', 'id');
    }

    public function route(){
        return route('dashboard.comments.show', ['comment' => $this->comment->id]);
    }

    public function userAnnouncementRoute(){
        return route("panel.comments");
    }

    public function announcements()
    {
        return $this->morphMany(Announcements::class, 'subject')->where('user_id', auth()->user()->id);
    }
}
