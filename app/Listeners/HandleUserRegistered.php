<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\WelcomeNotification;
use App\Services\Contracts\ActivityServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleUserRegistered implements ShouldQueue
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
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;
        // Set User Roles And Permissions
        $user->givePermissionTo("panel.login");
        // Send Welcome Email
        $user->notify(new WelcomeNotification());
        // Create Log
        $user->logActivity('user_activity', 'User Register', [
            'messages' => [
                "کاربر جدید {$user->name} {$user->family} با ایمیل {$user->email} ثبت نام کرد"
            ]
        ]);
    }
}
