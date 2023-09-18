<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
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
            ->select('activity_log.*', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) AS causer_name"))
            ->orderBy('activity_log.created_at', 'desc');

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

    public function viewDataProperties($auditId)
    {
        // Fetch the audit by ID (replace 'Audit' with your actual model name)
        $audit = DB::table('activity_log')
            ->where('id', $auditId)
            ->first();

        // Get the audit properties as text
        $propertiesText = $audit->properties;

        // Define the file name with the audit ID
        $fileName = "audit_properties_{$auditId}.txt";

        // Create a response with the properties as a downloadable TXT file
        $response = Response::make($propertiesText);
        $response->header('Content-Disposition', "attachment; filename={$fileName}");

        // dd($propertiesText);
        return $response;
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
