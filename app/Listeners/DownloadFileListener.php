<?php

namespace App\Listeners;

use App\Events\DownloadFileEvent;
use App\Mail\DownloadFileNotify;
use Illuminate\Support\Facades\Mail;

class DownloadFileListener
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
     * @param object $event
     * @return void
     */
    public function handle(DownloadFileEvent $event): void
    {
        Mail::to($event->user)->send(new DownloadFileNotify($event->user));
    }
}
