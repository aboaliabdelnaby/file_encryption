<?php

namespace App\Listeners;

use App\Jobs\SendPasswordChangedEmailJob;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PasswordChangedListener
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
    public function handle(PasswordReset $event): void
    {
        //
        $user = $event->user;
        dispatch(new SendPasswordChangedEmailJob($user->toarray()));

    }
}
