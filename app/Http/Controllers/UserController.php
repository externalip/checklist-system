<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('employee.role')->paginate(10); // Change 10 to your desired number of items per page

        return Inertia::render('ManagePersonnel/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles = Role::all();

        return Inertia::render('ManagePersonnel/Create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'role_id' => ['required', 'integer', Rule::in(Role::pluck('id'))], // Validate role_id against existing roles
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'contact' => ['required', 'integer', 'digits:10'],
            'shift' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee = Employee::create([
            'role_id' => $input['role_id'], // Associate the role_id with the user
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'gender' => $input['gender'],
            'date_of_birth' => $input['date_of_birth'],
            'contact' => $input['contact'],
            'shift' => $input['shift'],

        ]);

        User::create([
            'employee_id' => $employee->id,
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
        ]);

        return response()->json(['message' => 'User Added', 'status' => 'success']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $user->load('employee');
        $roles = Role::all();

        return Inertia::render('ManagePersonnel/Edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'username' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'contact' => ['required', 'integer', 'digits:10'],
            'shift' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $employee = Employee::findOrFail($user->employee_id);
        $employee->update([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'gender' => $input['gender'],
            'date_of_birth' => $input['date_of_birth'],
            'contact' => $input['contact'],
            'shift' => $input['shift'],
            'role_id' => $input['role_id'],
        ]);

        $user->update([
            'username' => $input['username'],
        ]);

        return redirect()->route('users', ['id' => $user->id])->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $employee = Employee::findOrFail($user->employee_id);
        $user->delete();
        $employee->delete();
        return Redirect::back()->with('success', 'User deleted successfully');
    }
    public function showRegistrationForm()
    {
        $roles = Role::all();
        return Inertia::render('Auth/Register', [
            'roles' => $roles,
        ]);
    }
    public function show5SForm()
    {
        // Get all models
        $models = DB::table('models')
                    ->select('model_name')
                    ->get();

        // Send list of models to url
        return Inertia::render('5S-Checklist/index', [
            'models' => $models
        ]);
    }
}
