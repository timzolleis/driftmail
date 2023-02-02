<?php

use Illuminate\Support\Facades\Route;

Route::get('/templates', [\App\Http\Controllers\TemplateController::class, 'index'])->middleware('auth');
Route::prefix('template')->group(function () {
    Route::get('/', [\App\Http\Controllers\TemplateController::class, 'create']);
    Route::get('/{template}', [\App\Http\Controllers\TemplateController::class, 'edit']);
    Route::put('/{template}', [\App\Http\Controllers\TemplateController::class, 'store']);
    Route::delete('/{template}', [\App\Http\Controllers\TemplateController::class, 'delete']);
});
