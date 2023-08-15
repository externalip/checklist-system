<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\Console\Input\Input;

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
                    ->where('response_fields.status', '=', 'Pending')
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
    public function update(Request $request, string $response_id)
    {
        // Get user id
        $user_id = auth()->user()->id;

        // Get user role
        $user_role = DB::table('users')
                ->select('roles.position')
                ->join('employees', 'employees.id', '=', 'users.employee_id')
                ->join('roles', 'roles.id', '=', 'employees.role_id')
                ->where('users.id', '=', $user_id)
                ->get();

        // Update signature status
        DB::table('signatures')
                ->where('response_id', '=', $response_id)
                ->where('required_sign_role', '=', $user_role->first()->position)
                ->update(
                    ['status' => 'OK', 'user_id' => $user_id]
                );

        if($this->isSigned($response_id)) {
            $this->markResponseAsComplete($response_id);
        }

        return redirect()->route('Pending-Reports')->with('success', 'Report signed successfully');
    }

    private function isSigned($response_id): bool
    {
        /*
            Check if response has been signed by QC & Line Lead

            SELECT COUNT(`status`) AS 'progress'
            FROM `signatures`
            WHERE `response_id` = 5
            AND `status` = 'OK';
        */
        $progressCount = DB::table('signatures')
                ->where('response_id', '=', $response_id)
                ->where('status', '=', 'OK')
                ->count();

        // A form requires 2 signatures (QC & Line Leader)
        return ($progressCount == 2) ? true : false;
    }

    private function markResponseAsComplete($response_id) 
    {
        // Update response status
        DB::table('response_fields')
                ->where('id', '=', $response_id)
                ->update(
                    ['status' => 'OK']
                );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
