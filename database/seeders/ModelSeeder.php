<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modelNames = [
            '[D01WKJ001] D460 MAIN PCB ASSY',
            '[D01WKJ002] D460 MAIN PCB ASSY',
            '[D01WHW001] D410 MAIN PCB ASSY',
            '[B55L219] POWER PCB ASSY 1880',
        ];

        // Generate sample data
        for ($i = 0; $i < count($modelNames); $i++) {
            DB::table('models')->insert([
                'model_name' => $modelNames[$i],
            ]);
        }
    }
}
