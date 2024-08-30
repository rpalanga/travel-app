<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

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

    
}
