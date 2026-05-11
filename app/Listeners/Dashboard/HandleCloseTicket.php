<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\CloseTicket;
use App\Models\Announcements;
use App\Models\Tickets;
use App\Notifications\AdminTicketCloseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleCloseTicket
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
    public function handle(CloseTicket $event): void
    {
        $user = $event->user;
        $admin = $event->admin;
        $user->logActivity('admin_activity', 'Admin Ticket', [
            'messages' => [
                "تیکت شما با شماره {$event->ticket->ticket_number} بسته شد"
            ]
        ], $admin);
        $createAnnouncement = Announcements::create([
            'user_id' => $user->id,
            'subject_id' => $event->ticket->id,
            'subject_type' => Tickets::class,
            'message' => "تیکت شما با شماره {$event->ticket->ticket_number} بسته شد"
        ]);
        $user->notify(new AdminTicketCloseNotification($event->ticket->ticket_number));
    }
}
