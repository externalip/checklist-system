<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

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

    //Fetch only the data corresponding to user input
    public function limitedChecksheetOptions($query)
    {
        // Retrieve the model names from your database
        $limitedChecksheet = DB::table('forms')
            ->where('form_name', 'LIKE', '%' . $query . '%')
            ->pluck('form_name')
            ->take(5)
            ->toArray();

        // Return the model names as JSON response
        return response()->json([
            'limitedChecksheet' => $limitedChecksheet,
        ]);
    }

    //take only first 5 data from database
    public function checksheetOptions()
    {
        // Retrieve the model names from your database
        $checksheet = DB::table('forms')
            ->pluck('form_name')
            ->take(5)
            ->toArray();

        // Return the model names as JSON response
        return response()->json([
            'checksheet' => $checksheet,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $employee_id = auth()->user()->employee_id;
        $config = $request->only('form_name', 'control_no', 'form_content');
        $form_name = $request->input('form_name');
        Form::create([
            'created_by' => $employee_id,
            'form_name' => $form_name,
            'completed' => 1,
            'form_data' => json_encode($config),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Form added',
        ], 200);
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
        $result = Form::find($id)->delete();

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

    public function Form($id)
    {
        $formdata = Form::findOrFail($id);

        $models = DB::table('models')
            ->join('tags', 'models.id', '=', 'tags.model_id')
            ->where('tags.form_id', $id)
            ->select('models.*')
            ->get();

        return Inertia::render('Forms/Index', [
            'formData' => $formdata,
            'models' => $models,
        ]);
    }

    public function create()
    {
        return Inertia::render('Create-Checklist/Create');
    }
}
