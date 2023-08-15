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

        // Get pending responses for 5S check sheet
        /*
            SELECT 
                forms.form_name, 
                employees.first_name, 
                response_fields.*
            FROM `response_fields`
            JOIN `forms`
              ON response_fields.form_id = forms.id
            JOIN `users`
              ON users.id = response_fields.submitted_by
            JOIN `employees`
              ON employees.id = users.employee_id
            WHERE response_fields.form_id = 1;
        */
        $responses = DB::table('response_fields')
                    ->select('forms.form_name', 'employees.first_name', 'response_fields.*')
                    ->join('forms', 'response_fields.form_id', '=', 'forms.id')
                    ->join('users', 'users.id', '=', 'response_fields.submitted_by')
                    ->join('employees', 'employees.id', '=', 'users.employee_id')
                    ->where('response_fields.form_id', '=', 1)
                    ->get();

        // Get signature status per response
        $signature_status = DB::table('signatures')
                    ->select('response_id', 'required_sign_role', 'status')
                    ->get();

        // Get pending reports count for 5s
        $counts = DB::table('response_fields')
                    ->select()
                    ->where('status', '=', 'pending')
                    ->where('form_id', '=', '1')
                    ->count();

        return Inertia::render('Pending-Reports/Index', [
            'forms' => $forms,
            'data' => $responses,
            'signatures' => $signature_status,
            'counts' => $counts
        ]);
    }

    public function getSignatureStatus($response_no) {
        $signature_status = DB::table('signatures')
                    ->select('response_id', 'required_sign_role', 'status')
                    ->get();
        
        return $signature_status;
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
