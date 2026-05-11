<?php

namespace App\Listeners;

use App\Events\UserPassword;
use App\Notifications\UserPasswordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleUserPassword implements ShouldQueue
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
    public function handle(UserPassword $event): void
    {
        $user = $event->user;
        $user->logActivity('user_activity', 'User Password', [
            'messages' => [
                "کاربر {$user->email} اقدام به بازیابی رمز عبور کرد"
            ]
        ]);
        $user->notify(new UserPasswordNotification());
    }
}
