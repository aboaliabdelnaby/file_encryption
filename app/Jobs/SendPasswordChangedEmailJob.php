<?php

namespace App\Jobs;

use App\Notifications\PasswordChangedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendPasswordChangedEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(readonly array $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::route('mail', $this->user['email'])
            ->notify(new PasswordChangedNotification( user: $this->user));
    }
}
