<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /*
            SELECT DISTINCT `action_type`
            FROM `audits`
            ORDER BY `action_type`
        */
        // $events = Audit::select('action_type')
        //     ->distinct()
        //     ->orderBy('action_type')
        //     ->get();

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
        $query = DB::table('activity_log')
            ->leftJoin('users', 'activity_log.causer_id', '=', 'users.id')
            ->leftJoin('employees', 'users.employee_id', '=', 'employees.id')
            ->select('activity_log.*', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) AS causer_name"));

        $events = DB::table('activity_log')
            ->select('event')
            ->distinct()
            ->orderBy('event')
            ->get();
        $users = DB::table('activity_log')
            ->join('users', 'activity_log.causer_id', '=', 'users.id')
            ->join('employees', 'users.employee_id', '=', 'employees.id')
            ->select(
                'users.id',
                'employees.first_name',
                'employees.last_name',
            )
            ->whereNotNull('activity_log.causer_id')
            ->orderBy('employees.first_name')
            ->distinct()
            ->get();
        if ($request->has('user')) {
            $query->where('activity_log.causer_id', $request->user);
        }

        if ($request->has('action')) {
            $query->where('activity_log.event', $request->action);
        }

        if ($request->has('date')) {
            $query->whereBetween('activity_log.created_at', $request->date);
        }
        $audits = $query->paginate(10);

        return Inertia::render('Audit/Index', [
            'audits' => $audits,
            'users' => $users,
            'events' => $events,
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
