<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'role_id' => ['required', 'integer'],
            'username' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'contact' => ['required', 'string', 'max:255'],
            'shift' => ['required', 'string', 'max:255'],
            // Add any other validation rules for employee details if required.
        ])->validate();

        // Create the employee entry in the employee table
        $employee = Employee::create([
            'role_id' => $input['role_id'], // Associate the role_id with the user
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'gender' => $input['gender'],
            'date_of_birth' => $input['date_of_birth'],
            'contact' => $input['contact'],
            'shift' => $input['shift'],
            // Add other fields specific to employee details if required.
        ]);

        return User::create([
            'employee_id' => $employee->id, // Associate the employee_id with the user
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
            // Add any other custom fields specific to users if required.
        ]);
    }
}
