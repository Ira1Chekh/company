<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/test', function () {
    try {
        \Illuminate\Support\Facades\DB::connection()->getPDO();
        echo \Illuminate\Support\Facades\DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::apiResource('projects', ProjectController::class);
});
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);
