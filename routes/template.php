<?php

use Illuminate\Support\Facades\Route;

Route::get('/templates', [\App\Http\Controllers\TemplateController::class, 'index'])->middleware('auth');
Route::post('/templates', [\App\Http\Controllers\TemplateController::class, 'store'])->middleware('auth');
Route::prefix('templates')->group(function () {
    Route::get('/', [\App\Http\Controllers\TemplateController::class, "index"]);
    Route::post('/new', [\App\Http\Controllers\TemplateController::class, 'store']);
    Route::get('/{template?}', [\App\Http\Controllers\TemplateController::class, 'index']);
    Route::put('/{template}', [\App\Http\Controllers\TemplateController::class, 'update']);
    Route::delete('/{template}', [\App\Http\Controllers\TemplateController::class, 'delete']);
});
