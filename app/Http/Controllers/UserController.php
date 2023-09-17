<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('employee', 'role');
        if ($request->filled('accountStatus')) {
            $accountStatusArray = explode(',', $request->input('accountStatus'));

            $query->where(function ($query) use ($accountStatusArray) {
                if (in_array('1', $accountStatusArray)) {
                    $query->orWhere('active', true);
                }
                if (in_array('0', $accountStatusArray)) {
                    $query->orWhere('active', false);
                }
            });
        }

        if ($request->filled('username')) {
            $searchUsername = $request->input('username');
            $query->where('username', 'like', '%' . $searchUsername . '%');
        }

        // searchName (First Name, Last Name) filter
        if ($request->filled('name')) {
            $searchName = $request->input('name');
            $query->whereHas('employee', function ($q) use ($searchName) {
                $q->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', '%' . $searchName . '%');
            });
        }
        if ($request->filled('role')) {
            $selectedRoles = $request->input('role');
            if (is_string($selectedRoles)) {
                $selectedRoles = explode(',', $selectedRoles);
            }

            $query->whereHas('role', function ($q) use ($selectedRoles) {
                $q->whereIn('role_id', $selectedRoles);
            });
        }
        $users = $query->orderBy('id', 'ASC')->paginate(10)->withQueryString();
        $users->appends(request()->query());

        return Inertia::render('Users/Index', [
            'users' => $users,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles = Role::all();

        return Inertia::render('Users/Create', [
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
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/', 'size:11'],
            'shift' => ['required', 'string', 'max:255'],
        ], [
            'contact.regex' => 'The phone number format is incorrect. Please use a valid Philippine phone number format.',
            'contact.size' => 'The phone number must be exactly 11 digits long.',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);
        }

        $employee = Employee::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'gender' => $input['gender'],
            'date_of_birth' => $input['date_of_birth'],
            'contact' => $input['contact'],
            'shift' => $input['shift'],

        ]);

        $user = User::create([
            'employee_id' => $employee->id,
            'role_id' => $input['role_id'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
            'active' => 1,
        ]);

        $user->assignRole($input['role_id']);
        return response()->json(['status' => 'success'], 200);
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

        return Inertia::render('Users/Edit', [
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
            'active' => ['required'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/', 'size:11'],
            'shift' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'integer'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ], [
            'contact.regex' => 'The phone number format is incorrect. Please use a valid Philippine phone number format.',
            'contact.size' => 'The phone number must be exactly 11 digits long.',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);
        }

        $employee = Employee::findOrFail($user->employee_id);
        $employee->update([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'gender' => $input['gender'],
            'date_of_birth' => $input['date_of_birth'],
            'contact' => $input['contact'],
            'shift' => $input['shift'],
        ]);

        $user->update([
            'username' => $input['username'],
            'active' => $input['active'],
            'role_id' => $input['role_id'],
        ]);

        $user->syncRoles($input['role_id']);

        if (!empty($input['password'])) {
            $user->update([
                'password' => Hash::make($input['password']),
            ]);
        }

        return response()->json(['message' => 'User Updated', 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->forceFill([
            'active' => 0,
        ])->save();

        return response()->json(['message' => 'User Deleted', 'status' => 'success']);
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
        $models = DB::table('tags')
            ->join('models', 'tags.model_id', '=', 'models.id')
            ->join('forms', 'tags.form_id', '=', 'forms.id')
            ->select('models.model_name', 'forms.form_name', 'tags.*')
            ->get();

        // Send list of models to url
        return Inertia::render('5S-Checklist/Index', [
            'models' => $models,
        ]);
    }

    public function showPTouchForm()
    {
        // Get all models
        $models = DB::table('models')
            ->select('model_name')
            ->get();

        // Send list of models to url
        return Inertia::render('PTouch-Solder/Index', [
            'models' => $models,
        ]);
    }

    public function showICTForm()
    {
        // Get all models
        $models = DB::table('models')
            ->select('model_name')
            ->get();

        // Send list of models to url
        return Inertia::render('PTouch-ICT/Index', [
            'models' => $models,
        ]);
    }

    public function showForm($id)
    {
        $path = 'Forms/form' . $id;

        return Inertia::render($path);
    }

    public function showUserManual()
    {
        return Inertia::render('UserManual/Index');
    }

    public function showChecksheetManager()
    {
        return Inertia::render('ChecksheetManager/Index');
    }

    public function showAmendment()
    {
        return Inertia::render('Create-Checklist/Amendment/Index');
    }

    public function showPendingApproval()
    {
        return Inertia::render('Create-Checklist/ChecklistApproval/Index');
    }
}
