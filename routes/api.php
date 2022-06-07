<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

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
Route::middleware('auth:sanctum')->get('/role', function (Request $request) {
    return request()->user()->roles()->get();
});
Route::middleware('auth:sanctum')->get('/all-roles', function (Request $request) {
    return Role::all(columns: ["id", "name"]);
});

//Route::get('api/users/{id}/payments/', 'PaymentController@showByUserId');

Route::apiResource('payments', PaymentController::class)->middleware("auth:sanctum");
Route::apiResource('users', UserController::class)->middleware("auth:sanctum");
