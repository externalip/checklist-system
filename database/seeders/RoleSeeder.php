<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $position = [
            'Operator',
            'Line Leader',
            'Quality Control', // Add more if necessary for sample
        ];

        for ($i = 0; $i < 3; $i++) {
            DB::table('roles')->insert([
                'position' => $position[$i],
                'description' => Str::random(10),
            ]);
        }
    }
}
