<?php

use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ===============================User Route =================================
Route::get('username', [UserController::class, 'GetUsers']);
Route::put('username/{id}', [UserController::class, 'UpdateUser']);
Route::delete('username/{id}', [UserController::class, 'DeleteUser']);

Route::post('/signup', [UserController::class, 'Signup']);
Route::post('/signin', [UserController::class, 'Signin']);

// ==============================Private route===============================
// Route::group(['middleware' => ['auth:sanctum']], function() {
//     Route::post('/students', [StudentController::class, 'store']);
//     Route::put('/students/{id}', [StudentController::class, 'update']);
//     Route::delete('/students/{id}', [StudentController::class, 'destroy']);

//     Route::post('/signout', [UserController::class, 'signout']);
// });
