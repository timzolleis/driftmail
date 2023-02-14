<?php

use Illuminate\Support\Facades\Route;

Route::prefix('settings')->group(function () {
    Route::get('/', [\App\Http\Controllers\SettingsController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\SettingsController::class, 'storeOrCreate']);
    Route::get('/export', [\App\Http\Controllers\SettingsController::class, 'export']);
});
