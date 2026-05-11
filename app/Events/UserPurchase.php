<?php

namespace App\Events;

use App\Models\Payments;
use App\Models\Plans;
use App\Models\Users;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserPurchase
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Users $user, public Payments $payment, public Plans $plan)
    {
        //
    }
}
