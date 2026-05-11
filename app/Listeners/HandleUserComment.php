<?php

namespace App\Listeners;

use App\Events\UserComment;
use App\Jobs\CreateAnnouncment;
use App\Models\CommentReplies;
use App\Models\Comments;
use App\Models\Users;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleUserComment implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserComment $event): void
    {
        $user = $event->user;
        $title = $event->title;
        $subject = $event->subject;
        if ($event->model == "movie"){
            $title = $title[1];
        }
        $adminIDS = Users::select('id')->whereHas('roles', function ($query){
            $query->whereHas('permissions', function ($query2){
                $query2->where('name', 'comments.view')->orWhere('name', 'comment.update');
            });
        })->pluck('id')->toArray();
        if ($event->model == "reply"){
            $user->logActivity('user_activity', 'User Comment', [
                'messages' => [
                    "کاربر {$user->email} به نظری پاسخ داد در {$title}"
                ]
            ]);
            dispatch(new CreateAnnouncment($adminIDS, $subject->id, CommentReplies::class, "{$user->email} پاسخ جدید برای نظر ثبت کرد"));
            dispatch(new CreateAnnouncment($subject->user->id, $subject->id, Comments::class, "{$user->email} به نظر شما پاسخ داد"));
        } else {
            $user->logActivity('user_activity', 'User Comment', [
                'messages' => [
                    "کاربر {$user->email} برای {$title} نظر جدیدی ثبت کرد"
                ]
            ]);
            dispatch(new CreateAnnouncment($adminIDS, $subject->id, Comments::class, "{$user->email} نظر جدید ثبت کرد"));
        }
    }
}
