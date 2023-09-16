<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LogSuccessfulLogin
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
    public function handle(Login $event): void
    {
        // // Get User ID
        // $userId = $event->user->id;
        // // Get Login Datetime
        // $login_datetime = Carbon::now();

        // // Insert log into `audits` table
        // DB::table('audits')->insert([
        //     'user_id' => $userId,
        //     'action_type' => 'Login',
        //     'action_details' => 'Logged in',
        //     'action_date' => $login_datetime,
        // ]);
    }
}
