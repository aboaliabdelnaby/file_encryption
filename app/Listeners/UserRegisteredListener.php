<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserRegisteredListener
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
    public function handle(UserRegisteredEvent $event): void
    {
        $user = $event->user;
        dispatch(new SendWelcomeEmailJob($user->toarray()));

    }
}
