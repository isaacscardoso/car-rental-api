<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// controllers
use App\Http\Controllers\RentalController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarBrandController;

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

Route::apiResource('locacoes', RentalController::class);
Route::apiResource('clientes', CustomerController::class);
Route::apiResource('carros', CarController::class);
Route::apiResource('carros-modelos', CarModelController::class);
Route::apiResource('carros-marcas', CarBrandController::class);
