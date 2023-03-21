<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ServiceController;
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


Route::get('apartments/sponsorized', [ApartmentController::class, 'sponsorApartment']);
Route::get('apartments/research', [ApartmentController::class, 'researchApartment']);
Route::get('apartments/index', [ApartmentController::class, 'index']);
Route::get('apartments/show/{apartment}', [ApartmentController::class, 'show']);
Route::get("services/index",[ServiceController::class,"index"]);
Route::post("message/create",[MessageController::class,"store"]);
