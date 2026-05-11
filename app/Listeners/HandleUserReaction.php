<?php

namespace App\Listeners;

use App\Events\UserReaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleUserReaction implements ShouldQueue
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
    public function handle(UserReaction $event): void
    {
        $user = $event->user;
        $reaction = "پسندید";
        if ($event->reaction == 0){
            $reaction = "نپسندید";
        }
        $movie = $event->movie;
        $user->logActivity('user_activity', 'User Reaction', [
            'messages' => [
                "کاربر {$user->email} فیلم / سریال {$movie} را {$reaction}"
            ]
        ]);
    }
}
