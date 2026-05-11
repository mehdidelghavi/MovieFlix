<?php

namespace App\Events;

use App\Models\Movies;
use App\Models\Users;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserReaction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Users $user, public $reaction, public $movie)
    {
        //
    }
}
