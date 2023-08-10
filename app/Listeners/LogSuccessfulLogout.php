<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LogSuccessfulLogout
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
    public function handle(Logout $event): void
    {
        // Get User ID
        $userId = $event->user->id;
        // Get Logout Datetime
        $logout_datetime = Carbon::now();

        // Insert log into `audits` table
        DB::table('audits')->insert([
            'user_id' => $userId,
            'action_type' => 'Logout',
            'action_details' => 'Logged out',
            'action_date' => $logout_datetime
        ]);
    }
}
