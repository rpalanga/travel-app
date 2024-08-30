<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Day;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function index(){

        $days = Day::with('stages')->get();

        return response()->json([
            'success' => true,
            'results' => $days
        ]);
    }
    public function show($id){

        $days = Day::select('days.*')
        ->where('id', '=', $id)
        ->with('stages')->get();
        
        return response()->json([
            'success' => true,
            'results' => $days
        ]);
    }


}
