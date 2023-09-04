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
        // Retrieve all employee IDs from the employees table
        $employeeIds = DB::table('employees')->pluck('id')->toArray();

        // Loop to create 50 user records
        for ($i = 1; $i <= 50; $i++) { // Use <= 50 to create 50 records
            $username = 'user' . $i;

            // Check if a user with the generated username already exists
            $existingUser = DB::table('users')->where('username', $username)->first();

            if (!$existingUser) {
                // Assign the user ID to match the employee ID
                $userId = $employeeIds[$i - 1]; // Subtract 1 to match the index

                // Insert a new user record with the matching IDs
                DB::table('users')->insert([
                    'id' => $userId,
                    'employee_id' => $userId,
                    'username' => $username,
                    'password' => Hash::make('password'), // You may want to change this for security.
                    'active' => Arr::random([true, false]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
