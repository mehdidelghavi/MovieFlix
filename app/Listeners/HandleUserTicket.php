<?php

namespace App\Listeners;

use App\Events\UserTicket;
use App\Jobs\CreateAnnouncment;
use App\Models\TicketReply;
use App\Models\Tickets;
use App\Models\Users;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleUserTicket implements ShouldQueue
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
    public function handle(UserTicket $event): void
    {
        $user = $event->user;
        $subject = $event->subject;
        $adminIDS = Users::select('id')->whereHas('roles', function ($query){
            $query->whereHas('permissions', function ($query2){
                $query2->where('name', 'comments.view')->orWhere('name', 'comment.update');
            });
        })->pluck('id')->toArray();
        if ($subject instanceof Tickets){
            dispatch(new CreateAnnouncment($adminIDS, $subject->id, Tickets::class, "کاربر {$user->email} تیکت / پاسخ جدید ثبت کرد"));
        } else {
            dispatch(new CreateAnnouncment($adminIDS, $subject->id, TicketReply::class, "کاربر {$user->email} تیکت / پاسخ جدید ثبت کرد"));
        }
        $user->logActivity('user_activity', 'User Ticket', [
            'messages' => [
                "کاربر {$user->email} تیکت / پاسخ جدید با شماره {$event->ticketNumber} ثبت کرد"
            ]
        ]);
    }
}
