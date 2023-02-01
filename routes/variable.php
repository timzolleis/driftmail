<?php

use Illuminate\Support\Facades\Route;
Route::get('/variables', [\App\Http\Controllers\VariableController::class, 'index']);
Route::prefix('variable')->group(function () {
    Route::get('/new', [\App\Http\Controllers\VariableController::class, 'create']);
    Route::get('/{variable}', [\App\Http\Controllers\VariableController::class, 'edit']);
    Route::put('/{variable}', [\App\Http\Controllers\VariableController::class, 'store']);
    Route::delete('/{variable}', [\App\Http\Controllers\VariableController::class, 'delete']);
});
