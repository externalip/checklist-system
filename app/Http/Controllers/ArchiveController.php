<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ArchiveController extends Controller
{
    public function index()
    {
        // $audits = DB::table('audits')
        //     ->join('users', 'audits.user_id', '=', 'users.id')
        //     ->join('employees', 'users.employee_id', '=', 'employees.id')
        //     ->select(
        //         'audits.user_id',
        //         'employees.first_name',
        //         'employees.last_name',
        //         'audits.action_date',
        //         'audits.action_type',
        //         'audits.action_details',
        //     )
        //     ->orderByDesc('audits.action_date')
        //     ->paginate(10);

        // return Inertia::render('Archives/Index', [
        //     'audits' => $audits,
        // ]);

        $response_fields = DB::table('response_fields')
            ->select('forms.form_name', 'employees.*', 'response_fields.*')
            ->join('forms', 'response_fields.form_id', '=', 'forms.id')
            ->join('users', 'users.id', '=', 'response_fields.submitted_by')
            ->join('employees', 'employees.id', '=', 'users.employee_id')
            ->where('response_fields.status', '=', 'OK')
            ->where('response_fields.form_id', '=', '1')
            ->orderByDesc('response_fields.created_at')
            ->paginate(10);

        $response_fields2 = DB::table('response_fields')
            ->select('forms.form_name', 'employees.*', 'response_fields.*')
            ->join('forms', 'response_fields.form_id', '=', 'forms.id')
            ->join('users', 'users.id', '=', 'response_fields.submitted_by')
            ->join('employees', 'employees.id', '=', 'users.employee_id')
            ->where('response_fields.status', '=', 'OK')
            ->where('response_fields.form_id', '=', '2')
            ->orderByDesc('response_fields.created_at')
            ->paginate(10);

        $response_fields3 = DB::table('response_fields')
            ->select('forms.form_name', 'employees.*', 'response_fields.*')
            ->join('forms', 'response_fields.form_id', '=', 'forms.id')
            ->join('users', 'users.id', '=', 'response_fields.submitted_by')
            ->join('employees', 'employees.id', '=', 'users.employee_id')
            ->where('response_fields.status', '=', 'OK')
            ->where('response_fields.form_id', '=', '3')
            ->orderByDesc('response_fields.created_at')
            ->paginate(10);

        $counts = DB::table('response_fields')
            ->select()
            ->where('status', '=', 'OK')
            ->count();

        $forms = DB::table('forms')
            ->select('form_name')
            ->orderBy('form_name')
            ->get();

        $employees = DB::table('employees')
            ->select()
            ->where('role_id', '=', '1')
            ->get();

        return Inertia::render('Archives/Index', [
            'response_fields' => $response_fields,
            'counts' => $counts,
            'forms' => $forms,
            'employees' => $employees,
            'response_fields2' => $response_fields2,
            'response_fields3' => $response_fields3,

        ]);
    }
}
