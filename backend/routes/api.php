<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\User\Auth\LoginController;
use App\Http\Controllers\Api\User\Auth\RegisterController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::get('/test', function () {
//    return response()->json(['message' => 'Test route working']);
//});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
//Route::middleware('api')->group(function () {
//});
//Route::get('/user-logout', [UserLoginController::class, 'userLogout']);
//Route::get('/test-auth',  function () {
//    return response()->json(['message' => 'Authenticated successfully']);
//});
Route::middleware('auth:sanctum')->get('/test-auth', function () {
    return response()->json(['message' => 'Authenticated successfully']);
});

//Route::middleware('auth:api')->group(function () {
//    Route::get('/user-logout', [LoginController::class, 'userLogout']);
//});
