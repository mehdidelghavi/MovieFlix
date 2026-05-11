<?php

namespace App\Listeners;

use App\Events\UserPurchase;
use App\Notifications\UserPurchaseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleUserPurchase implements ShouldQueue
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
    public function handle(UserPurchase $event): void
    {
        $user = $event->user;
        $user->logActivity('user_activity', 'User Purchase', [
            'messages' => [
                "کاربر {$user->email} اقدام به خرید اشتراک کرد"
            ]
        ]);
        $user->notify(new UserPurchaseNotification($event->payment, $event->plan));
    }
}
