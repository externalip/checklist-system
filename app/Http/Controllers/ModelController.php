<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Models;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('Models')
            ->leftJoin('Tags', 'Tags.model_id', '=', 'Models.id')
            ->leftJoin('forms', 'Tags.form_id', '=', 'forms.id')
            ->groupBy('models.id', 'Models.model_name')
            ->select('models.id AS model_id', 'Models.model_name', DB::raw("IFNULL(GROUP_CONCAT(forms.form_name SEPARATOR ', '), '') AS checksheet_appearance"));

        $modelNameFilter = $request->input('modelName');
        if ($modelNameFilter) {
            $query->where('Models.model_name', 'LIKE', '%'.$modelNameFilter.'%');
        }
        $selectedCheckSheets = $request->input('SelectedCheckSheet');
        if ($selectedCheckSheets) {
            $selectedCheckSheetsArray = explode(',', $selectedCheckSheets);
            $query->whereExists(function ($subquery) use ($selectedCheckSheetsArray) {
                $subquery->select(DB::raw(1))
                    ->from('Tags AS t')
                    ->whereRaw('t.model_id = Models.id')
                    ->whereIn('t.form_id', $selectedCheckSheetsArray)
                    ->groupBy('t.model_id')
                    ->havingRaw('COUNT(DISTINCT t.form_id) = ?', [count($selectedCheckSheetsArray)]);
            });
        }

        $models = $query->paginate(10);

        return Inertia::render('Models/Index', [
            'models' => $models,
            'Forms' => Form::all(),
        ]);
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
        $validate = $request->validate([
            'model_name' => ['required', 'string', 'unique:models'],
        ]);
        if (! $validate) {
            return response()->json(['message' => 'Model Name is required']);
        }

        $model = Models::create([
            'model_name' => $request->input('model_name'),
        ]);
        if ($submissionIDs) {
            $tags = [];
            foreach ($submissionIDs as $id) {
                $tags[] = [
                    'form_id' => $id,
                    'model_id' => $model->id,
                ];
            }
            Tags::insert($tags);
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

        // $forms = DB::table('forms')->whereIn('id', $form_ids)->get();
        return response()->json(['model' => $model, 'form_ids' => $form_ids]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = Models::findOrFail($id);
        $input = $request->all();
        $submissionIDs = array_map('intval', array_map('trim', $input['form_id']));
        $model->update([
            'model_name' => $request->input('model_name'),
        ]);
        Tags::where('model_id', $model->id)->delete();
        if ($submissionIDs) {
            $tags = [];
            foreach ($submissionIDs as $id) {
                $tags[] = [
                    'form_id' => $id,
                    'model_id' => $model->id,
                ];
            }
            Tags::insert($tags);
        }

        return response()->json(['message' => 'Model Updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ids = $request->input('id') ? [$request->input('id')] : $request->input('ids');
        $tags = Tags::whereIn('model_id', $ids);
        $models = Models::whereIn('id', $ids);

        if ($models->delete() && $tags->delete()) {
            return response()->json(['message' => 'Model Deleted']);
        }
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

    /*
    Model name Autocomplete
    */

    //Fetch only the data corresponding to user input
    public function limitedModelNameOptions($query)
    {
        // Retrieve the model names from your database
        $limitedModelNames = DB::table('Models')
            ->where('model_name', 'LIKE', '%'.$query.'%')
            ->pluck('model_name')
            ->take(5)
            ->toArray();

        // Return the model names as JSON response
        return response()->json([
            'limitedModelNames' => $limitedModelNames,
        ]);
    }

    //take only first 5 data from database
    public function modelNameOptions()
    {
        // Retrieve the model names from your database
        $modelNames = DB::table('Models')
            ->pluck('model_name')
            ->take(5)
            ->toArray();

        // Return the model names as JSON response
        return response()->json([
            'modelNames' => $modelNames,
        ]);
    }
}
