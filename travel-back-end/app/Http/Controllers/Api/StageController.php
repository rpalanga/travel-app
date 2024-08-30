<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index(){

        $stages = Stage::all();

        return response()->json([
            'success' => true,
            'results' => $stages
        ]);
    }

    public function show($id){

        $stages = Stage::find($id);
        
        return response()->json([
            'success' => true,
            'results' => $stages
        ]);
    }

}
