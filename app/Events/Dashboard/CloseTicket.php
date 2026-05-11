<?php

namespace App\Events\Dashboard;

use App\Models\Tickets;
use App\Models\Users;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CloseTicket
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Users $user, public Tickets $ticket, public $admin)
    {
        //
    }

}
