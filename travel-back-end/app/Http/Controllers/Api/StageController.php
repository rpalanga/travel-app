<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StageController extends Controller
{

    public function index()
    {
        $stages = Stage::with('day')->get(); // Modifica la relazione se necessario

        return response()->json([
            'success' => true,
            'results' => $stages
        ]);
    }

    public function show($id)
    {
        $stage = Stage::select('stages.*')
            ->where('id', '=', $id)
            ->with('day') // Modifica la relazione se necessario
            ->get();

        return response()->json([
            'success' => true,
            'results' => $stage
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'img' => 'nullable',
            'description' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $stage = Stage::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Stage created successfully',
            'results' => $stage
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $stage = Stage::find($id);

        if (!$stage) {
            return response()->json([
                'success' => false,
                'message' => 'Stage not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'img' => 'nullable',
            'description' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $stage->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Stage updated successfully',
            'results' => $stage
        ], 200);
    }

    public function destroy($id)
    {
        $stage = Stage::find($id);

        if (!$stage) {
            return response()->json([
                'success' => false,
                'message' => 'Stage not found'
            ], 404);
        }

        $stage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Stage deleted successfully'
        ], 200);
    }

}
