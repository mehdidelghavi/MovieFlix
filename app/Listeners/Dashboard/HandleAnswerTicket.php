<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\AnswerTicket;
use App\Jobs\CreateAnnouncment;
use App\Mail\ContactMail;
use App\Models\Announcements;
use App\Models\Tickets;
use App\Models\Users;
use App\Notifications\AdminTicketAnswerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class HandleAnswerTicket implements ShouldQueue
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
    public function handle(AnswerTicket $event): void
    {
        $user = $event->user;
        $admin = $event->admin;
        if ($user instanceof Users){
            $user->logActivity('admin_activity', 'Admin Ticket',[
                'messages' => [
                    "ادمین {$admin->name} {$admin->family} به تیکت با شماره {$event->ticket->ticket_number} پاسخ داد"
                ]
            ], $admin);
            dispatch(new CreateAnnouncment($user->id, $event->ticket->id, Tickets::class, "ادمین {$admin->name} {$admin->family} به تیکت با شماره {$event->ticket->ticket_number} پاسخ داد"));
            $user->notify(new AdminTicketAnswerNotification($event->ticket->ticket_number));
        } else {
            Mail::to($user)->send(new ContactMail(['email' => $user, 'content' => $event->text]));
        }
        
    }
}
