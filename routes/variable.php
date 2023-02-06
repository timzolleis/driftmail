<?php

use Illuminate\Support\Facades\Route;
Route::get('/variables', [\App\Http\Controllers\VariableController::class, 'index']);
Route::prefix('variable')->group(function () {
    Route::post('/new', [\App\Http\Controllers\VariableController::class, 'store']);
    Route::put('/{variable}', [\App\Http\Controllers\VariableController::class, 'update']);
    Route::delete('/{variable}', [\App\Http\Controllers\VariableController::class, 'delete']);
});
