<?php

namespace App\Listeners;

use App\Events\Dashboard\PlansEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandlePlansEvent
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
    public function handle(PlansEvent $event): void
    {
        //
    }
}
