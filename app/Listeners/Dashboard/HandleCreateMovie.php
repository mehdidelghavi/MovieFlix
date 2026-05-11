<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\CreateMovie;
use App\Jobs\SendNewsletterEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleCreateMovie
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
    public function handle(CreateMovie $event): void
    {
        dispatch(new SendNewsletterEmail($event->data));
    }
}
