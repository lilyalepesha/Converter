<?php

namespace Events;

use App\Events\UserCreatedEvent;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UserCreatedEventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_created_event_dispatched()
    {
        Event::fake();
        $user = $this->createUser();

        Event::dispatch(new UserCreatedEvent($user));

        Event::assertDispatched(UserCreatedEvent::class, function ($event) use ($user) {
            return $event->user = $user;
        });
    }

    public function test_user_created_event_not_dispatched()
    {
        Event::fake();
        $user = $this->createUser();

        Event::assertNotDispatched(UserCreatedEvent::class, function ($event) use ($user) {
            return $event->user = $user;
        });
    }
}
