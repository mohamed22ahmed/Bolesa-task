<?php

use App\Http\Controllers\Api\TableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/loading-data/{table}', [TableController::class, 'index']);
Route::post('/filtering-data', [TableController::class, 'filteringData']);
