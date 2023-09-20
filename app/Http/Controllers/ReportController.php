<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get existing check sheet forms
        $forms = DB::table('forms')
            ->select('form_name', 'id')
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
            ->select('forms.form_name', 'forms.form_data', 'employees.first_name', 'employees.last_name', 'response_fields.*', 'employees.shift')
            ->join('forms', 'response_fields.form_id', '=', 'forms.id')
            ->join('users', 'users.id', '=', 'response_fields.submitted_by')
            ->join('employees', 'employees.id', '=', 'users.employee_id')
            ->where('response_fields.status', '=', 'Pending')
            ->get();

        $formtable = DB::table('forms')
            ->select('form_data')
            ->get();

        // Get signature status per response
        $signature_status = DB::table('signatures')
            ->select('response_id', 'required_sign_role', 'status')
            ->get();

        $counts = DB::table('response_fields')
            ->select('forms.form_name', 'response_fields.*')
            ->join('forms', 'response_fields.form_id', '=', 'forms.id')
            ->where('status', '=', 'pending')
            ->count();

        $formcount = DB::table('forms')
            ->select('forms.id', 'forms.form_name')
            ->selectRaw('COUNT(response_fields.status) AS pending_count')
            ->leftJoin('response_fields', function ($join) {
                $join->on('forms.id', '=', 'response_fields.form_id')
                    ->where('response_fields.status', '=', 'pending');
            })
            ->groupBy('forms.id', 'forms.form_name')
            ->get();

        return Inertia::render('Pending-Reports/Index', [
            'forms' => $forms,
            'formcount' => $formcount,
            'data' => $responses,
            'signatures' => $signature_status,
            'counts' => $counts,
            'config' => $formtable,
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
    public function update(string $status, string $response_id)
    {
        // Get user id
        $user_id = $this->getUserId();

        // Get user role
        $user_role = $this->getUserRole($user_id);

        $signature = Signature::where('response_id', $response_id)
            ->where('required_sign_role', $user_role)
            ->first();

        if ($status == 'Rejected') {
            // Update signature status as 'Rejected'
            $signature->update([
                'status' => 'Rejected',
                'user_id' => $user_id,
            ]);
        } else {
            // Update signature status as 'OK'
            $signature->update([
                'status' => 'OK',
                'user_id' => $user_id,
            ]);
        }

        // Check if response is rejected by at least one signee
        if ($this->isRejected($response_id)) {
            $this->markResponseStatus($response_id, 'Rejected');
        }

        // Check if response got all signatures
        if ($this->isComplete($response_id)) {
            // Set response status as 'OK'
            $this->markResponseStatus($response_id, 'OK');
        }

        return response()->json([
            'message' => 'Signature status updated successfully!',
            'status' => 'success',
        ]);
    }

    public function getUserId()
    {
        // Return session user id
        return auth()->user()->id;
    }

    public function getUserRole($user_id)
    {
        // Return user role
        return DB::table('users')
            ->select('roles.name')
            ->join('employees', 'employees.id', '=', 'users.employee_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.id', '=', $user_id)
            ->get()
            ->first()
            ->name;
    }

    private function isComplete($response_id): bool
    {
        /*
            Check if response has been signed by QC & Line Lead

            SELECT COUNT(`status`) AS 'progress'
            FROM `signatures`
            WHERE `response_id` = id_no
            AND `status` = 'OK';
        */
        $progressCount = Signature::where('response_id', $response_id)
            ->where('status', 'Ok')
            ->count();

        // A form requires 2 signatures (QC & Line Leader)
        return ($progressCount == 2) ? true : false;
    }

    private function isRejected($response_id): bool
    {
        /*
            Check if response has been rejected by either QC or Line Lead

            SELECT COUNT(`status`) AS 'progress'
            FROM `signatures`
            WHERE `response_id` = id_no
            AND `status` = 'Rejected';
        */
        // $progressCount = DB::table('signatures')
        //     ->where('response_id', '=', $response_id)
        //     ->where('status', '=', 'Rejected')
        //     ->count();

        $progressCount = Signature::where('response_id', $response_id)
            ->where('status', 'Rejected')
            ->count();

        // If a response is rejected by either QC or Line Lead
        return ($progressCount >= 1) ? true : false;
    }

    private function markResponseStatus($response_id, $status)
    {
        // Update response status
        DB::table('response_fields')
            ->where('id', '=', $response_id)
            ->update(
                ['status' => $status]
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
