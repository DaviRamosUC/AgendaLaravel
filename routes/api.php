<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/get_contacts', [ContactController::class, 'index']);
Route::post('/registercontact',[ContactController::class, 'store']);
Route::put('/updatecontact/{id}',[ContactController::class, 'update']);
Route::delete('/deletecontact/{id}',[ContactController::class, 'delete']);
Route::get('/email/{id}',[ContactController::class, 'email']);
