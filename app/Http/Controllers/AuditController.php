<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Audit;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // SELECT * FROM `audits`
        $audits = Audit::all();

        // SELECT DISTINCT `event` FROM `audits` ORDER BY `event`
        $events = Audit::select('event')->distinct()->orderBy('event')->get();

        // SELECT DISTINCT `user_type` FROM `audits` ORDER BY `user_type`
        $users = Audit::select('user_type')->distinct()->orderBy('user_type')->get();

        return Inertia::render('Audit/Index', [
            'audits' => $audits,
            'events' => $events,
            'users' => $users,
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
