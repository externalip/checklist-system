<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Operator');
    }
    public function index()
    {
        $permissions = DB::table('role_has_permissions')
        ->select([
            'role_has_permissions.permission_id',
            'permissions.name as permission_name',
            'role_has_permissions.role_id',
            'roles.name as role_name',
            'roles.description as role_description'
        ])
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
            ->get();

        $roles = [];

        foreach ($permissions->groupBy('role_id') as $role_id => $role) {
            $roles[] = [
                'id' => $role_id,
                'name' => $role->first()->role_name,
                'description' => $role->first()->role_description,
                'permissions' => $role->pluck('permission_name')->toArray()
            ];
        }

        return Inertia::Render('Users/Roles/Index', [
                'roles' => $roles
            ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'position' => 'required|string|max:255|unique:roles',
                'description' => 'required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors(),
            ], 422);
        }

        $role = Role::create([
            'position' => $validatedData['position'],
            'description' => $validatedData['description'],
        ]);

        if (! $role) {
            return response()->json([
                'status' => 'error',
                'message' => 'Role not created',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Role created successfully',
            'data' => $role,
        ], 201);
    }
    public function create(){
        $roles = Role::all();
        $permissions = DB::table('permissions')->get();
        return Inertia::Render('Users/Roles/Create', [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }
    public function edit($id){
        $role = Role::find($id);
        $permissions = DB::table('role_has_permissions')
        ->where('role_id', $id)
        ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->select('permissions.id', 'permissions.name')
        ->get();


        return Inertia::Render('Users/Roles/Edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }
}
