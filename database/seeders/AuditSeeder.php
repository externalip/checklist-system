<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $numberOfRecords = 20;

        $possibleActionTypes = ['Create', 'Update', 'Delete', 'Login'];

        $userIds = User::pluck('id')->toArray();

        for ($i = 1; $i <= $numberOfRecords; $i++) {
            $action = Arr::random($possibleActionTypes);
            DB::table('audits')->insert([
                'user_id' => $userIds[array_rand($userIds)],
                'action_type' => $action,
                'action_details' => $this->generateActionDetails($action),
                'old_values' => json_encode(['field1' => 'old_value']),
                'new_values' => json_encode(['field1' => 'new_value']),
                'action_date' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }

    private function generateActionDetails($actionType)
    {
        switch ($actionType) {
            case 'Create':
                return 'Created a new record';
            case 'Update':
                return 'Updated an existing record';
            case 'Delete':
                return 'Deleted a record';
            case 'Login':
                return 'Logged in';
                // Add more cases for other action types if needed
            default:
                return 'Performed an action';
        }
    }
}
