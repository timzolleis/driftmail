<?php

use Illuminate\Support\Facades\Route;

Route::post('/new', [\App\Http\Controllers\ProjectController::class, 'handleCreate']);
Route::get('/{project}', [\App\Http\Controllers\ProjectController::class, 'index']);
Route::put('/{project}', [\App\Http\Controllers\ProjectController::class, 'handleEdit']);
Route::delete('/{project}', [\App\Http\Controllers\ProjectController::class, 'delete']);
