<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Attempting;

class LogAuthenticationAttempt
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
    public function handle(Attempting $event): void
    {
        //
    }
}
