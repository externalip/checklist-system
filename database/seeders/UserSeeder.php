<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        $roleIds = DB::table('roles')->pluck('id')->toArray();
        //get the role roleIds name based on the role
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
                $user = User::create([
                    'employee_id' => $employeeId,
                    'role_id' => Arr::random($roleIds),
                    'username' => $username,
                    'password' => Hash::make('password'), // You may want to change this for security.
                    'active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $role = Role::find($user->role_id);
                if ($role) {
                    $user->assignRole($role->name);
                }
            }
        }
    }
}
