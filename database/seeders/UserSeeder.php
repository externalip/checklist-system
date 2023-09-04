<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
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
            $employeeId = $i; // Use the current loop counter as the employee ID
            $username = 'user'.$i;

            // Check if a user with the generated employee ID and username already exists
            $existingUser = DB::table('users')
                ->where('employee_id', $employeeId)
                ->where('username', $username)
                ->first();

            if (! $existingUser) {
                // Insert a new user record with matching employee ID and username
                DB::table('users')->insert([
                    'employee_id' => $employeeId,
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
