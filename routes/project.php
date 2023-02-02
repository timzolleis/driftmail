<?php

use Illuminate\Support\Facades\Route;

//TODO: Change /new to / and implement in Frontend
Route::post('/new', [\App\Http\Controllers\ProjectController::class, 'store']);
Route::get('/{project}', [\App\Http\Controllers\ProjectController::class, 'index']);
Route::put('/{project}', [\App\Http\Controllers\ProjectController::class, 'update']);
Route::delete('/{project}', [\App\Http\Controllers\ProjectController::class, 'delete']);
