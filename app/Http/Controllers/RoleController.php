<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return response()->json($roles);
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

        if (!$role) {
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
}
