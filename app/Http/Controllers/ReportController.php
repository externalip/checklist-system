<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Termwind\render;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get existing check sheet forms
        $forms = DB::table('forms')
                ->select('form_name')
                ->orderBy('form_name')
                ->get();

        // Get responses for 5S check sheet
        $responses = DB::table('response_fields')
                    ->select()
                    ->where('form_id', '=', '1')
                    ->get();

        // Get pending reports count for 5s
        $counts = DB::table('response_fields')
                    ->select()
                    ->where('status', '=', 'pending')
                    ->where('form_id', '=', '1')
                    ->count();

        // dd($responses);

        return Inertia::render('Pending-Reports/Index', [
            'forms' => $forms,
            'data' => $responses,
            'counts' => $counts
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
