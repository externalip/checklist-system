<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Inertia\Inertia;
use App\Models\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $submissionIDs = array_map('intval', array_map('trim', $input['form_id']));
        $model = Models::create([
            'model_name' => $request->input('model_name')
        ]);
        foreach ($submissionIDs as $id) {
            Tags::create([
                'form_id' => $id,
                'model_id' => $model->id
            ]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Models::findorFail($id);
        $tags = Tags::where('model_id', $model->id)->get();

        $form_ids = [];
        foreach ($tags as $tag) {
            array_push($form_ids, $tag->form_id);
        }
        $forms = DB::table('forms')->whereIn('id', $form_ids)->get();
        return response()->json(['model' => $model, 'forms' => $forms]);
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
    public function TableView()
    {
        $results = DB::table('Models')
            ->leftJoin('Tags', 'Tags.model_id', '=', 'Models.id')
            ->leftJoin('forms', 'Tags.form_id', '=', 'forms.id')
            ->groupBy('models.id', 'Models.model_name')
            ->select('models.id AS model_id', 'Models.model_name', DB::raw("IFNULL(GROUP_CONCAT(forms.form_name SEPARATOR ', '), '') AS checksheet_appearance"))
            ->get();

        return response()->json($results);
    }
}
