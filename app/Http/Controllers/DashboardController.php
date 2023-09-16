<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $forms = DB::table('forms')
            ->select('forms.id', 'forms.form_name')
            ->selectRaw('COUNT(response_fields.status) AS pending_count')
            ->leftJoin('response_fields', function ($join) {
                $join->on('forms.id', '=', 'response_fields.form_id')
                    ->where('response_fields.status', '=', 'pending');
            })
            ->groupBy('forms.id', 'forms.form_name')
            ->get();

        // $audits = DB::table('audits')
        //     ->select(
        //         'audits.user_id',
        //         'employees.first_name',
        //         'employees.last_name',
        //         'audits.action_date',
        //         'audits.action_type',
        //         'audits.action_details'
        //     )
        //     ->join('users', 'audits.user_id', '=', 'users.id')
        //     ->join('employees', 'users.employee_id', '=', 'employees.id')
        //     ->orderBy('audits.action_date', 'desc')
        //     ->limit(10)
        //     ->get();


        $users = DB::table('users')
            ->select(
                'users.id'
            )
            ->where('active', '=', '1')
            ->count();

        $models = DB::table('models')
            ->select(
                'models.id'
            )
            ->count();

        $checksheets = DB::table('forms')
            ->select(
                'forms.id'
            )
            ->count();

        $archives = DB::table('response_fields')
            ->select(
                'response_fields.id'
            )
            ->where('status', '!=', 'pending')
            ->count();

        return Inertia::render('Dashboard', [
            'forms' => $forms,
            // 'audits' => $audits,
            'users' => $users,
            'models' => $models,
            'checksheets' => $checksheets,
            'archives' => $archives,

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
