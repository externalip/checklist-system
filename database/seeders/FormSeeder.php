<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = [
            '5S Start-Up Check Sheet',
            'P-Touch Soldering',
            'P-Touch ICT',
            'FFC',
            'SMT',
        ];

        for ($i = 0; $i < 5; $i++) {
            DB::table('forms')->insert([
                'form_name' => $forms[$i],
                'completed' => random_int(0, 1),
                'created_by' => $i + 1,
                'form_data' => json_encode(['field1' => 'field_validation']),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
