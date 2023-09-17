<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;
use App\Models\Response_field;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Validator;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store premade checksheet response.
     */
    public function store(Request $request)
    {
        $attributeLabels = [
            'fieldAnswers.Materials' => 'Materials',
            'fieldAnswers.Lot Number' => 'Lot Number',
            'fieldAnswers.Kit Number' => 'Kit Number',
            'fieldAnswers.Model Name' => 'Model Name',
            'fieldAnswers.Working Area' => 'Working Area',
            'fieldAnswers.Type of Checking' => 'Type of Checking',
            'fieldAnswers.Production Checksheet' => 'Production Checksheet',
            'fieldAnswers.Tools/Jigs Instrument' => 'Tools/Jigs Instrument',
            'fieldAnswers.Procedures/OPL/Work Instructions' => 'Procedures/OPL/Work Instructions',

        ];

        $validator = Validator::make($request->all(), [
            'fieldAnswers.Materials' => 'required',
            'fieldAnswers.Lot Number' => 'required',
            'fieldAnswers.Kit Number' => 'required',
            'fieldAnswers.Model Name' => 'required',
            'fieldAnswers.Working Area' => 'required',
            'fieldAnswers.Type of Checking' => 'required',
            'fieldAnswers.Production Checksheet' => 'required',
            'fieldAnswers.Tools/Jigs Instrument' => 'required',
            'fieldAnswers.Procedures/OPL/Work Instructions' => 'required',
        ]);

        $validator->setAttributeNames($attributeLabels);

        $validator->setCustomMessages([
            'required' => ':attribute field is required.',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error',  'errors' => $validator->errors()]);
        }

        // Save response to database
        $this->storeResponse($request);

        // Return success response
        return response()->json(['status' => 'success']);
    }

    /**
     * Store generated checksheet's response.
     */
    public function storeResponse(Request $request)
    {
        $submittedBy = auth()->user()->id;
        $formId = $request->input('form_id');
        $response = $request->only('fieldAnswers');
        $responseNo = $this->generateUniqueResponseNo();

        // Insert data into the response_fields table using DB::table
        $response = Response_field::create([
            'response_no' => $responseNo,
            'form_id' => $formId,
            'submitted_by' => $submittedBy,
            'response' => json_encode($response), // Store answer in field_value column
            'status' => 'pending',
        ]);

        // Assign required signatures for the submitted data
        $this->requireSign($response->id);
    }

    private function requireSign($row_id)
    {
        // List of required signatures
        $signatory_role = [
            'Quality Control',
            'Line Leader',
        ];

        // Insert n rows of required signatures
        for ($index = 0; $index < count($signatory_role); $index++) {
            Signature::create([
                'response_id' => $row_id,
                'required_sign_role' => $signatory_role[$index],
                'status' => 'Pending',
            ]);
        }
    }

    private function generateUniqueResponseNo()
    {
        // Implement your logic to generate a unique response number here
        // This can be based on timestamps, UUIDs, or any other method you prefer

        $timestamp = now()->format('ymdHis');
        $userId = auth()->user()->id;

        $responseNo = $timestamp . '-' . $userId;

        return $responseNo;
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
