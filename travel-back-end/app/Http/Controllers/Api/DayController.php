<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;



class DayController extends Controller
{

    public function index()
    {
        $days = Day::with('stages')->get(); // Adjusted relationship to 'stages' within Day

        return response()->json([
            'success' => true,
            'results' => $days
        ]);
    }

    public function show($id)
    {
        $day = Day::select('days.*')
            ->where('id', '=', $id)
            ->with('stages')->get(); // Adjusted relationship to 'stages' within Day

        return response()->json([
            'success' => true,
            'results' => $day
        ]);
    }

    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:255',
            'img' => 'nullable',
            'description' => 'nullable|string',
            'place' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $day = Day::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Day created successfully',
            'results' => $day
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Trova il giorno corrispondente all'ID
        $day = Day::find($id);

        // Controlla se il giorno esiste
        if (!$day) {
            return response()->json([
                'success' => false,
                'message' => 'Day not found'
            ], 404);
        }

        // Valida i dati della richiesta
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:255',
            'img' => 'nullable',
            'description' => 'nullable|string',
            'place' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        // Se la validazione fallisce, restituisce un errore
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Aggiorna il giorno con i dati validati
        $day->update($request->all());

        // Restituisce una risposta JSON di successo
        return response()->json([
            'success' => true,
            'message' => 'Day updated successfully',
            'results' => $day
        ], 200);
    }

    public function destroy($id)
    {
        $day = Day::find($id);

        if (!$day) {
            return response()->json([
                'success' => false,
                'message' => 'Day not found'
            ], 404);
        }

        $day->delete();

        return response()->json([
            'success' => true,
            'message' => 'Day deleted successfully'
        ], 200);
    }


}
