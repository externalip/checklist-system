<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // check if put or patch
        if ($request->isMethod('put')) {
            // update user
            $user = User::find($id);
            $user->employee_id = $request->input('employee_id');
            $user->username = $request->input('username');
            $user->save();
            return response()->json(['message' => 'User Updated', 'status' => 'success']);
        } else {
            // update user
            $user = User::find($id);
            $user->employee_id = $request->input('employee_id');
            $user->username = $request->input('username');
            $user->save();
            // return redirect('/accountmanager')->with('success', 'User Updated');
            return response()->json(['message' => 'User Updated', 'status' => 'success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function AccountManager()
    {
        $users = User::with('employee.role')->paginate(10); // Change 10 to your desired number of items per page

        //return it as json
        // return response()->json($users);
        return Inertia::render('AccountManager/index', [
            'users' => $users,
        ]);
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
    //get the user information
    public function getUserInfo($id)
    {
        $user = User::find($id);
        $user->load('employee.role');
        return response()->json($user);
    }
}
