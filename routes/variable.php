<?php

use Illuminate\Support\Facades\Route;

Route::prefix('variables')->group(function () {
    Route::get('/add', [\App\Http\Controllers\VariableController::class, "index"]);
    Route::get('/{variable?}', [\App\Http\Controllers\VariableController::class, 'index']);
    Route::post('/new', [\App\Http\Controllers\VariableController::class, 'store']);
    Route::put('/{variable}', [\App\Http\Controllers\VariableController::class, 'update']);
    Route::delete('/{variable}', [\App\Http\Controllers\VariableController::class, 'delete']);
    Route::get('/search', [\App\Http\Controllers\VariableController::class, "search"]);
});
