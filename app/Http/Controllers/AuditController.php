<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Audit;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
            SELECT DISTINCT `action_type`
            FROM `audits`
            ORDER BY `action_type`
        */
        $events = Audit::select('action_type')
            ->distinct()
            ->orderBy('action_type')
            ->get();

        /*
            SELECT
                audits.user_id,
                employees.first_name,
                employees.last_name,
                audits.action_date,
                audits.action_type,
                audits.action_details,
            FROM audits
            JOIN users
              ON audits.user_id = users.id
            JOIN employees
              ON users.employee_id = employees.id;
        */
        $audits = DB::table('audits')
            ->join('users', 'audits.user_id', '=', 'users.id')
            ->join('employees', 'users.employee_id', '=', 'employees.id')
            ->select(
                'audits.user_id',
                'employees.first_name',
                'employees.last_name',
                'audits.action_date',
                'audits.action_type',
                'audits.action_details',
            )
            ->orderByDesc('audits.action_date')
            ->paginate(10);

        return Inertia::render('Audit/Index', [
            'audits' => $audits,
            'events' => $events
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
