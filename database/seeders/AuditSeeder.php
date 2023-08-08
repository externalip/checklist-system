<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Actions to Audit
        $actions = 
        [
            'Login', 
            'Logout', 
            'Failed Login', 
            'Created Check Sheet',
            'Modified Check Sheet',
            'Deleted Check Sheet',
        ];

        // Run Seeder 50 times
        for ($i = 0; $i < 50; $i++) 
        {
            DB::table('audits')->insert([
                'user_type' => Str::random(10),
                'user_id' => random_int(1, 1),
                'event' => Arr::random($actions),
                'auditable_type' => 'App/Model/Category',
                'auditable_id' => random_int(1, 500),
            ]);
        }
    }
}
