<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 6 users
        for ($i = 1; $i < 6; $i++) 
        {
            DB::table('users')->insert([
                'employee_id' => random_int(3, 53),

                // Sample username : `user1`
                'username' => 'user'.$i,

                // Password is `password` for all generated users
                'password' => Hash::make('password'),
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
