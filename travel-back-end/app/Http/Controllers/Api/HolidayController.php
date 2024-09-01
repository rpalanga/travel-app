<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class HolidayController extends Controller
{
    public function index()
    {

        $holidays = Holiday::with('days.stages')->get();

        return response()->json([
            'success' => true,
            'results' => $holidays
        ]);
    }
    public function show($id)
    {

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
            'title' => 'required|string|max:255',
            'img' => 'nullable',
            'description' => 'nullable|string',
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
    public function update(Request $request, $id)
    {
        // Trova la festività corrispondente all'ID
        $holiday = Holiday::find($id);

        // Controlla se la festività esiste
        if (!$holiday) {
            return response()->json([
                'success' => false,
                'message' => 'Holiday not found'
            ], 404);
        }

        // Valida i dati della richiesta
        $validator = FacadesValidator::make($request->all(), [
            'title' => 'required|string|max:255',
            'img' => 'nullable',
            'description' => 'nullable|string',
        ]);

        // Se la validazione fallisce, restituisce un errore
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Aggiorna la festività con i dati validati
        $holiday->update($request->all());

        // Restituisce una risposta JSON di successo
        return response()->json([
            'success' => true,
            'message' => 'Holiday updated successfully',
            'results' => $holiday
        ], 200);
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
