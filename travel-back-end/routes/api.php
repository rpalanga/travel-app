<?php

use App\Http\Controllers\Api\StageController;
use App\Http\Controllers\Api\DayController;
use App\Http\Controllers\Api\HolidayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('holidays', HolidayController::class);
// Route::apiResource('days', DayController::class);
// Route::apiResource('stages', StageController::class);

Route::get('/holidays', [HolidayController::class, 'index']);
Route::get('/holidays/{id}', [HolidayController::class, 'show']);
Route::get('/days', [DayController::class, 'index']);
Route::get('/days/{id}', [DayController::class, 'show']);
Route::get('/stages', [StageController::class, 'index']);
Route::get('/stages/{id}', [StageController::class, 'show']);

// Route::get('/stages', [HolidayController::class, 'index']);

