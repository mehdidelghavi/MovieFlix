<?php

namespace App\Events\Dashboard;

use App\Models\Tickets;
use App\Models\Users;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AnswerTicket
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public $user, public Tickets $ticket, public Users $admin, public $text)
    {
        //
    }

}
