<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function index()
    {
        $roles = DB::table('roles')
            ->select([
                'roles.id as role_id',
                'roles.name as role_name',
                'roles.description as role_description',
            ])
            ->addSelect(DB::raw('(SELECT GROUP_CONCAT(permissions.name) FROM role_has_permissions
                         JOIN permissions ON role_has_permissions.permission_id = permissions.id
                         WHERE role_has_permissions.role_id = roles.id) as permission_names'))
            ->get();

        $rolesData = [];

        foreach ($roles as $role) {
            $permissions = explode(',', $role->permission_names);

            $rolesData[] = [
                'id' => $role->role_id,
                'name' => $role->role_name,
                'description' => $role->role_description,
                'permissions' => $permissions,
            ];
        }

        return Inertia::render('Users/Roles/Index', [
            'roles' => $rolesData, // Use $rolesData instead of $roles
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'permissions' => 'required|array',
        ]);

        $permissions = $request->input('permissions');

        $permissions = array_map(function ($permission) {
            return $permission['id'];
        }, $permissions);

        if (!$validate) {
            throw ValidationException::withMessages([
                'name' => 'Role name is required',
                'description' => 'Role description is required',
                'permissions' => 'Role permissions are required',
            ]);
        }

        $role = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'guard_name' => 'web',
        ]);
        //sync role permissions access
        $perms = $role->syncPermissions($permissions);

        //log role permissions create
        if($perms){
            activity()
            ->useLog('Permission log')
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->event('created')
            ->withProperties([
                'permissions' => $permissions,
            ])
            ->log('Role permissions given');
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Role created successfully',
        ], 201);
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = DB::table('permissions')->select('id', 'name')->get();

        return Inertia::Render('Users/Roles/Create', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully',
        ], 200);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission_options = DB::table('permissions')->select('id', 'name')->get();
        $permissions = DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select('permissions.id', 'permissions.name')
            ->get();

        return Inertia::Render('Users/Roles/Edit', [
            'role' => $role,
            'permissions' => $permissions,
            'permission_options' => $permission_options,
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'permissions' => 'required|array',
        ]);
        $permissions = $request->input('permissions');
        $permissions = array_map(function ($permission) {
            return $permission['id'];
        }, $permissions);

        $role->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        //sync role permissions access
        $perms = $role->syncPermissions($permissions);

        //log role permissions update
        if($perms){
            activity()
            ->useLog('Permission log')
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->event('updated')
            ->withProperties([
                'permissions' => $permissions,
            ])
            ->log('Role permissions updated');
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Role updated successfully',
        ], 200);
    }
}
