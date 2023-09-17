<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Form;

class CheckSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get forms
        $query = DB::table('forms')
            ->select('forms.*', DB::raw('CONCAT(employees.first_name, " ", employees.last_name) as created_by_name'))
            ->leftJoin('employees', 'forms.created_by', '=', 'employees.id');

        // Search by name
        if ($request->has('name') && $request->name) {
            $name = $request->input('name');
            $query->where('forms.form_name', 'like', "%$name%");
        }

        $forms = $query->paginate(10);

        return Inertia::render('Create-Checklist/Edit/Edit', [
            'forms' => $forms,
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
    public function show(Request $request)
    {
        return Inertia::render('Create-Checklist/Create', [
            'forms' => $request,
        ]);
    }

    public function edit(string $id)
    {
        $form = DB::table('forms')->where('id', $id)->first();

        return Inertia::render('Create-Checklist/Edit/Editor', [
            'config' => $form,
            'form_id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $form_generator = new FormGeneratorController();

        $form_id = $request->input('form_id');
        $form_config = $request->input('new_config');
        $form_name = $form_config['form_name'];

        // DB::table('forms')
        //     ->where('id', $form_id)
        //     ->update([
        //         'form_data' => $form_config,
        //         'form_name' => $form_name,
        //         'updated_at' => Carbon::now(),
        //     ]);
        Form::find($form_id)->update([
            'form_data' => $form_config,
            'form_name' => $form_name,
            'updated_at' => Carbon::now(),
        ]);
        $form_generator->generateForm($form_id, $form_name, $form_config);

        // if ($result) {
        //     return response()->json([
        //         'message' => 'Form updated successfully',
        //         'status' => 'success',
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'message' => 'Form update failed',
        //         'status' => 'error',
        //     ], 400);
        // }

        return response()->json([
            'message' => 'Form updated successfully',
            'status' => 'success',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');

        Storage::disk('form_path')->delete('form' . $id . '.vue');
        $result = DB::table('forms')
            ->where('id', $id)
            ->delete();

        if ($result) {
            return response()->json([
                'message' => 'Form deleted successfully',
                'status' => 'success',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Form deletion failed',
                'status' => 'error',
            ], 400);
        }
    }
}
