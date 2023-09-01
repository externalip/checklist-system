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
        $query = DB::table('audits')
            ->join('users', 'audits.user_id', '=', 'users.id')
            ->join('employees', 'users.employee_id', '=', 'employees.id')
            ->select(
                'audits.user_id',
                'employees.first_name',
                'employees.last_name',
                'audits.action_date',
                'audits.action_type',
                'audits.action_details'
            )
            ->orderByDesc('audits.action_date');

        // Apply filters if provided in the request
        if ($request->has('user')) {
            $query->where('audits.user_id', $request->user);
        }

        if ($request->has('action')) {
            $query->where('audits.action_type', $request->action);
        }

        if ($request->has('date')) {
            $query->whereBetween('audits.action_date', $request->date);
        }

        $audits = $query->paginate(10);
        //get all users with employee using db::table
        $users = DB::table('users')
            ->join('employees', 'users.employee_id', '=', 'employees.id')
            ->join('audits', 'users.id', '=', 'audits.user_id')
            ->select(
                'users.id',
                'employees.first_name',
                'employees.last_name',
            )
            ->whereNotNull('audits.user_id')
            ->orderBy('employees.first_name')
            ->distinct()
            ->get();
        // dd($users);

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
