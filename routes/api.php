<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('mail')->group(function () {
    Route::post('/send', [\App\Http\Controllers\api\MailController::class, 'send'])->middleware('auth.api');
    Route::get('/test', [\App\Http\Controllers\api\MailController::class, 'send'])->middleware('auth.api');
    Route::get('/status/{id}', [\App\Http\Controllers\api\MailController::class, 'getStatus']);
});


