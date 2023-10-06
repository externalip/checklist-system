<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ArchiveController extends Controller
{
    public function index()
    {

        //get pending reports for all checksheets
        $response_fields = DB::table('response_fields')
            ->select(
                'forms.form_name',
                'forms.form_data',
                'forms.id',
                'employees.first_name',
                'employees.last_name',
                'employees.shift',
                'response_fields.*',
                'line_leader_signature.user_id AS line_leader_user_id',
                'qc_signature.user_id AS qc_user_id',
                'line_leader_employee.first_name AS line_leader_first_name',
                'qc_employee.first_name AS qc_first_name',
                'line_leader_employee.last_name AS line_leader_last_name',
                'qc_employee.last_name AS qc_last_name',
                'employees.id AS operator_employee_id'

            )
            ->join('forms', 'response_fields.form_id', '=', 'forms.id')
            ->join('users', 'users.id', '=', 'response_fields.submitted_by')
            ->join('employees', 'employees.id', '=', 'users.employee_id')
            ->leftJoin('signatures AS line_leader_signature', function ($join) {
                $join->on('line_leader_signature.response_id', '=', 'response_fields.id')
                    ->where('line_leader_signature.required_sign_role', '=', 'Line Leader');
            })
            ->leftJoin('signatures AS qc_signature', function ($join) {
                $join->on('qc_signature.response_id', '=', 'response_fields.id')
                    ->where('qc_signature.required_sign_role', '=', 'Quality Control');
            })
            ->leftJoin('users AS line_leader_user', 'line_leader_user.id', '=', 'line_leader_signature.user_id')
            ->leftJoin('users AS qc_user', 'qc_user.id', '=', 'qc_signature.user_id')
            ->leftJoin('employees AS line_leader_employee', 'line_leader_employee.id', '=', 'line_leader_user.employee_id')
            ->leftJoin('employees AS qc_employee', 'qc_employee.id', '=', 'qc_user.employee_id')
            ->whereIn('response_fields.status', ['OK', 'Rejected'])
            ->orderByDesc('response_fields.created_at')
            ->paginate(10);

        $counts = DB::table('response_fields')
            ->select()
            ->where('status', '=', 'OK')
            ->count();

        $forms = DB::table('forms')
            ->select('form_name', 'id')
            ->orderBy('form_name')
            ->get();

        $formdata = DB::table('forms')
            ->select(
                'forms.*',
            )

            ->get();

        $employees = DB::table('users')
            ->select(
                'users.*',
                'employees.first_name',
                'employees.last_name'
            )
            ->join('employees', 'employees.id', '=', 'users.employee_id')
            ->where('role_id', '=', '1')
            ->get();

        return Inertia::render('Archives/Index', [
            'data' => $response_fields,
            'counts' => $counts,
            'forms' => $forms,
            'employees' => $employees,
            'formdata' => $formdata,
        ]);
    }

    /*
    Employee Autocomplete
    */

    //Fetch only the data corresponding to user input
    public function limitedEmployeeOptions($query)
    {
        // Retrieve the model names from your database
        $employees = DB::table('users')
            ->select(
                db::raw("users.*, concat(employees.last_name, ', ', employees.first_name) AS name")
            )
            ->join(
                'employees', 
                'employees.id', 
                '=', 
                'users.employee_id'
            )
            ->where(
                'role_id', 
                '=', 
                '1'
            )
            ->where(
                db::raw("concat(employees.last_name, ', ', employees.first_name)"), 
                'LIKE', 
                '%'.$query.'%'
            )
            ->take(5)
            ->get();

        // Return the model names as JSON response
        return response()->json([
            'employees' => $employees,
        ]);
    }

    //take only first 5 data from database
    public function employeeOptions()
    {
        // Retrieve the model names from your database
        $employees = DB::table('users')
        ->select(
            db::raw("users.*, concat(employees.last_name, ', ', employees.first_name) AS name")
        )
        ->join(
            'employees', 
            'employees.id', 
            '=', 
            'users.employee_id'
        )
        ->where(
            'role_id', 
            '=', 
            '1'
        )
        ->take(5)
        ->get();

        // Return the model names as JSON response
        return response()->json([
            'employees' => $employees,
        ]);
    }

    /*
    Check Sheet Autocomplete
    */

    //Fetch only the data corresponding to user input
    public function limitedChecksheetOptions($query)
    {
        // Retrieve the model names from your database
        $checksheets = DB::table('forms')
        ->select('form_name', 'id')
        ->where(
            'form_name', 
            'LIKE', 
            '%'.$query.'%'
        )
        ->orderBy('form_name')
        ->take(5)
        ->get();

        // Return the model names as JSON response
        return response()->json([
            'checksheets' => $checksheets,
        ]);
    }

    //take only first 5 data from database
    public function checksheetOptions()
    {
        // Retrieve the model names from your database
        $checksheets = DB::table('forms')
        ->select('form_name', 'id')
        ->orderBy('form_name')
        ->take(5)
        ->get();

        // Return the model names as JSON response
        return response()->json([
            'checksheets' => $checksheets,
        ]);
    }
}
