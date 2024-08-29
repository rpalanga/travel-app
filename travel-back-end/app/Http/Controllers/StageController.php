<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStageRequest;
use App\Http\Requests\UpdateStageRequest;
use App\Models\Stage;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           // Recupera tutti gli stages
           $stages = Stage::all();
           return response()->json($stages);
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
    public function store(StoreStageRequest $request)
    {
        $validated = $request->validate([
            'day_id' => 'required|exists:days,id',
            'name' => 'required|string|max:255',
            'img' => 'nullable|string',
            'description' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        $stage = Stage::create($validated);
        return response()->json($stage, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stage $stage)
    {
           // Recupera un singolo stage
           return response()->json($stage);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStageRequest $request, Stage $stage)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|string',
            'description' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        $stage->update($validated);
        return response()->json($stage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
    {
        $stage->delete();
        return response()->json(null, 204);
    }
}
