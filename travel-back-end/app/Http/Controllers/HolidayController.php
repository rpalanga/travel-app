<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Models\Holiday;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $holidays = Holiday::with('days.stages')->get();
        return response()->json($holidays);
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
    public function store(StoreHolidayRequest $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'nullable|string',
            'description' => 'nullable|string',
            // Altre validazioni se necessarie
        ]);

        $holiday = Holiday::create($request->all());
        return response()->json($holiday, 201);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Holiday $holiday)
    {
        $holiday->load('days.stages');
        return response()->json($holiday);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Holiday $holiday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHolidayRequest $request, Holiday $holiday)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'nullable|string',
            'description' => 'nullable|string',
            
        ]);

        $holiday->update($request->all());
        return response()->json($holiday);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return response()->json(null, 204);
    }
}
