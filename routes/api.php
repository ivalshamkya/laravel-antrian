<?php

use App\Http\Controllers\AntrianController;
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

Route::put('/antrian/edit', [AntrianController::class, 'update']);
Route::put('/antrian/reset', [AntrianController::class, 'resetAntrian']);
Route::put('/antrian/increase', [AntrianController::class, 'increase']);
Route::put('/antrian/decrease', [AntrianController::class, 'decrease']);
Route::delete('/antrian/{id}', [AntrianController::class, 'destroy']);
