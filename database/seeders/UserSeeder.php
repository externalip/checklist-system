<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeIds = DB::table('employees')->pluck('id')->toArray();

        for ($i = 1; $i < 50; $i++) {
            $username = 'user'.$i;

            $existingUser = DB::table('users')->where('username', $username)->first();

            if (! $existingUser) {
                do {
                    $randomEmployeeId = $employeeIds[array_rand($employeeIds)];
                } while (DB::table('users')->where('employee_id', $randomEmployeeId)->exists());

                DB::table('users')->insert([
                    'employee_id' => $randomEmployeeId,
                    'username' => $username,
                    'password' => Hash::make('password'),
                    'active' => Arr::random([true, false]),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
