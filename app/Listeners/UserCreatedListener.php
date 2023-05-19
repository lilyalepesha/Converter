<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;

class UserCreatedListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event): void
    {
        Mail::to($event->user)->send(new MailNotify($event->user));
    }
}
