<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SectorController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('government', RegionController::class);
    Route::apiResource('government/{government_id}/areas', AreaController::class);
    Route::apiResource('government/{government_id}/areas/{area_id}/sectors', SectorController::class);
    Route::get('getPredictions',[PredictController::class, 'getPredictions']);
});


Route::post('register', [registerController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [LogoutController::class, 'logout']);
