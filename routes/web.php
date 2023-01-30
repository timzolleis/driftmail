<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->middleware('auth');

Route::prefix('project')->group(function () {
    Route::get('/new', [\App\Http\Controllers\ProjectController::class, 'create']);
    Route::post('/new', [\App\Http\Controllers\ProjectController::class, 'handleCreate']);

    Route::get('/{id}/edit', [\App\Http\Controllers\ProjectController::class, 'edit']);
    Route::put('/{id}/edit', [\App\Http\Controllers\ProjectController::class, 'handleEdit']);
    Route::delete('/{id}/edit', [\App\Http\Controllers\ProjectController::class, 'delete']);

})->middleware('auth');

Route::prefix('variable')->group(function () {
    Route::get('/new', [\App\Http\Controllers\VariableController::class, 'create']);
    Route::post('/new', [\App\Http\Controllers\VariableController::class, 'store']);

    Route::get('/{id}', [\App\Http\Controllers\VariableController::class, 'edit']);
    Route::put('/{id}', [\App\Http\Controllers\VariableController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\VariableController::class, 'delete']);


})->middleware('auth');

Route::prefix('template')->group(function () {
    Route::get('/new', [\App\Http\Controllers\TemplateController::class, 'create']);
    Route::post('/new', [\App\Http\Controllers\TemplateController::class, 'store']);

    Route::get('/{template}', [\App\Http\Controllers\TemplateController::class, 'edit']);
    Route::put('/{template}', [\App\Http\Controllers\TemplateController::class, 'update']);
    Route::delete('/{template}', [\App\Http\Controllers\TemplateController::class, 'delete']);

})->middleware('auth');


Route::get('/login', [\App\Http\Controllers\authentication\NetlifyAuthenticationController::class, 'index']);
Route::post('/login', [\App\Http\Controllers\authentication\NetlifyAuthenticationController::class, 'redirectToNetlify']);
Route::get('/callback', [\App\Http\Controllers\authentication\NetlifyAuthenticationController::class, 'callBack']);


Route::prefix('oauth')->group(function () {
    Route::get('/login', [\App\Http\Controllers\authentication\AuthenticationController::class, 'authorize']);
    Route::get('/callback', [\App\Http\Controllers\authentication\AuthenticationController::class, 'callback']);
});

