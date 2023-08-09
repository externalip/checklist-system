<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //
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
        return Inertia::render('5S-Checklist/index');
    }
}
