<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\SceduleController;
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

Route::get('/load-trip',[SceduleController::class,'load']);
Route::get('/load-scedule',[SceduleController::class,'loadSingleScedule']);
