<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstName = [
            'Adam', 'Alex', 'Aaron', 'Ben',
            'Carl', 'Dan', 'David', 'Edward',
            'Fred', 'Frank', 'George', 'Hal',
            'Hank', 'Ike', 'John', 'Jack',
            'Joe', 'Larry', 'Monte', 'Matthew',
            'Mark', 'Nathan', 'Otto', 'Paul',
            'Peter', 'Roger', 'Roger', 'Steve',
            'Thomas', 'Tim', 'Ty', 'Victor',
            'Walter',
        ];

        $lastName = [
            'Anderson', 'Ashwoon', 'Aikin', 'Bateman',
            'Bongard', 'Bowers', 'Boyd', 'Cannon',
            'Cast', 'Deitz', 'Dewalt', 'Ebner',
            'Frick', 'Hancock', 'Haworth', 'Hesch',
            'Hoffman', 'Kassing', 'Knutson', 'Lawless',
            'Lawicki', 'Mccord', 'McCormack', 'Miller',
            'Myers', 'Nugent', 'Ortiz', 'Orwig',
            'Ory', 'Paiser', 'Pak', 'Pettigrew',
            'Quinn', 'Quizoz', 'Ramachandran', 'Resnick',
            'Sagar', 'Schickowski', 'Schiebel', 'Sellon',
            'Severson', 'Shaffer', 'Solberg', 'Soloman',
            'Sonderling', 'Soukup', 'Soulis', 'Stahl',
            'Sweeney', 'Tandy', 'Trebil', 'Trusela',
            'Trussel', 'Turco', 'Uddin', 'Uflan',
            'Ulrich', 'Upson', 'Vader', 'Vail',
            'Valente', 'Van Zandt', 'Vanderpoel',
            'Ventotla', 'Vogal', 'Wagle', 'Wagner',
            'Wakefield', 'Weinstein', 'Weiss', 'Woo',
            'Yang', 'Yates', 'Yocum', 'Zeaser',
            'Zeller', 'Ziegler', 'Bauer', 'Baxster',
            'Casal', 'Cataldi', 'Caswell', 'Celedon',
            'Chambers', 'Chapman', 'Christensen', 'Darnell',
            'Davidson', 'Davis', 'DeLorenzo', 'Dinkins',
            'Doran', 'Dugelman', 'Dugan', 'Duffman',
            'Eastman', 'Ferro', 'Ferry', 'Fletcher',
            'Fietzer', 'Hylan', 'Hydinger', 'Illingsworth',
            'Ingram', 'Irwin', 'Jagtap', 'Jenson',
            'Johnson', 'Johnsen', 'Jones', 'Jurgenson',
            'Kalleg', 'Kaskel', 'Keller', 'Leisinger',
            'LePage', 'Lewis', 'Linde', 'Lulloff',
            'Maki', 'Martin', 'McGinnis', 'Mills',
            'Moody', 'Moore', 'Napier', 'Nelson',
            'Norquist', 'Nuttle', 'Olson', 'Ostrander',
            'Reamer', 'Reardon', 'Reyes', 'Rice',
            'Ripka', 'Roberts', 'Rogers', 'Root',
            'Sandstrom', 'Sawyer', 'Schlicht',
            'Schmitt', 'Schwager', 'Schutz', 'Schuster',
            'Tapia', 'Thompson', 'Tiernan', 'Tisler',
        ];

        $gender = [
            'Male',
            'Female',
            'Others',
        ];

        $shift = [
            '1st',
            '2nd',
            '3rd',
        ];

        $roleIds = DB::table('roles')->pluck('id')->toArray();

        // Run Seeder 50 times
        for ($i = 0; $i < 50; $i++) {
            Employee::create([
                // 'role_id' => Arr::random($roleIds),
                'first_name' => Arr::random($firstName),
                'last_name' => Arr::random($lastName),
                'gender' => Arr::random($gender),
                'date_of_birth' => Carbon::now(),
                'contact' => '0'.random_int(9000000000, 9999999999),
                'shift' => Arr::random($shift),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            // $role = Role::find($employee->role_id);
            // if ($role) {
            //     $employee->assignRole($role->name);
            // }
        }
    }
}
