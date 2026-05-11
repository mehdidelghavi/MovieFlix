<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\CreateArticle;
use App\Jobs\SendNewsletterEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleCreateArticle
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
    public function handle(CreateArticle $event): void
    {
        dispatch(new SendNewsletterEmail($event->data));
    }
}
