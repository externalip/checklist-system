<?php

namespace App\Listeners;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

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
        // Get User ID
        $userId = $event->user->id;
        // Get Employee ID
        $employeeId = $event->user->employee_id;
        // Get Username
        $username = $event->user->username;
        // Get Login Datetime
        $login_datetime = Carbon::now();

        // Get Employee first & last name from account
        $result = DB::table('users')
                    ->join('employees', 'users.id', '=', 'employees.id')
                    ->select('employees.first_name', 'employees.last_name')
                    ->where('users.id', '=', $userId)
                    ->get();

        // [WIP] Insert log into `audits` table
        DB::table('audits')->insert([
            'user_id' => $userId,
            'action_type' => 'Login',
            'action_date' => Carbon::now()
        ]);
    }
}
