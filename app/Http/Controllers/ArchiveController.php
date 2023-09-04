<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            ->select(
                'forms.form_name',
                'employees.first_name',
                'employees.last_name',
                'response_fields.*',
                'line_leader_signature.user_id AS line_leader_user_id',
                'qc_signature.user_id AS qc_user_id',
                'line_leader_employee.first_name AS line_leader_first_name',
                'qc_employee.first_name AS qc_first_name',
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
            ->where('response_fields.status', '=', 'OK')
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
        ]);
    }
}
