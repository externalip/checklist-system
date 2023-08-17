<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class FormGeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Create-Checklist/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = $this->getUserId();
        $config = $request->only('form_name', 'form_content');

        DB::table('forms')
            ->insert([
                'created_by' => $userId,
                'form_name' => $request->input('form_name'),
                'completed' => 1,
                'form_data' => json_encode($config),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
    }

    public function getUserId()
    {
        // Return session user id
        return auth()->user()->id;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
}
