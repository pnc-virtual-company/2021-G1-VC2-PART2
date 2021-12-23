<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscipleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/disciples',[DiscipleController::class,'index']);
Route::post('disciples',[DiscipleController::class,'store']);
Route::put('/disciples/{id}',[DiscipleController::class,'Update']);
Route::delete('/disciples/{id}',[DiscipleController::class,'delete']);