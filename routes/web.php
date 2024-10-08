<?php

use App\Http\Controllers\Api\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/loading-data/{table}', [TableController::class, 'index']);
Route::post('/table/filter', [TableController::class, 'filter']);
