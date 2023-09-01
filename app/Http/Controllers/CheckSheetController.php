<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CheckSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get All Forms
        $forms = DB::table('forms')->select()->get();

        // Send Data to Check Sheet Manager
        return Inertia::render('Create-Checklist/Edit/Edit', [
            'forms' => $forms,
        ]);
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
    public function show(Request $request)
    {
        return Inertia::render('Create-Checklist/Create', [
            'forms' => $request,
        ]);
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
}
