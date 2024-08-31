<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class HolidayController extends Controller
{
    public function index(){

        $holidays = Holiday::with('days.stages')->get();

        return response()->json([
            'success' => true,
            'results' => $holidays
        ]);
    }
    public function show($id){

        $holidays = Holiday::select('holidays.*')
        ->where('id', '=', $id)
        ->with('days.stages')->get();
        
        return response()->json([
            'success' => true,
            'results' => $holidays
        ]);
    }

    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Add other fields as per your table schema
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $holiday = Holiday::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Holiday created successfully',
            'results' => $holiday
        ], 201);
    }

    public function destroy($id)
    {
        $holiday = Holiday::find($id);

        if (!$holiday) {
            return response()->json([
                'success' => false,
                'message' => 'Holiday not found'
            ], 404);
        }

        $holiday->delete();

        return response()->json([
            'success' => true,
            'message' => 'Holiday deleted successfully'
        ], 200);
    }

    
}
