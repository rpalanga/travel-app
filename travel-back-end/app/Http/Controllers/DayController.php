<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDayRequest;
use App\Http\Requests\UpdateDayRequest;
use App\Models\Day;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           // Recupera tutti i giorni con gli stadi associati
           $days = Day::with('stages')->get();
           return response()->json($days);
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
    public function store(StoreDayRequest $request)
    {
        $validated = $request->validate([
            'holiday_id' => 'required|exists:holidays,id',
            'name' => 'required|string|max:255',
            'img' => 'nullable|string',
            'description' => 'nullable|string',
            'place' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $day = Day::create($validated);
        return response()->json($day, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Day $day)
    {
          // Recupera un singolo giorno con gli stadi associati
          $day->load('stages');
          return response()->json($day);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Day $day)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDayRequest $request, Day $day)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|string',
            'description' => 'nullable|string',
            'place' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $day->update($validated);
        return response()->json($day);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Day $day)
    {
        $day->delete();
        return response()->json(null, 204);
    }
}
