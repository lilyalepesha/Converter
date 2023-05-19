<?php

namespace App\Providers;

use App\Events\DownloadFileEven;
use App\Events\DownloadFileEvent;
use App\Events\UserCreatedEvent;
use App\Listeners\DownloadFileListener;
use App\Listeners\UserCreatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
      /*  Registered::class => [
            SendEmailVerificationNotification::class,
        ],*/
        UserCreatedEvent::class => [
            UserCreatedListener::class,
        ],
        DownloadFileEvent::class => [
          DownloadFileListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
