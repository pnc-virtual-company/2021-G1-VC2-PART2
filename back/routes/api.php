<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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

// ===============================User Route =================================
Route::get('users', [UserController::class, 'GetUsers']);
Route::put('users/{id}', [UserController::class, 'UpdateUser']);
Route::delete('users/{id}', [UserController::class, 'DeleteUser']);

Route::post('/signup', [UserController::class, 'Signup']);
Route::post('/signin', [UserController::class, 'Signin']);

// ==================== Route Search User======================================
Route::get('/username/search/{username}', [UserController::class, 'search']);

//===================== Route Student ==============================
Route::get('/students',[StudentController::class,'getStudent']);
Route::post('/students',[StudentController::class,'store']);
Route::put('/students/{id}',[StudentController::class,'updateStudent']);
Route::delete('/students/{id}',[StudentController::class,'delete']);

//Route search student =============================== 
Route::get('/students/search/{firstName}', [StudentController::class, 'search']);
