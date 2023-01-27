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

Route::prefix('project')->group(function (){
    Route::get('/new', [\App\Http\Controllers\ProjectController::class, 'create']);
});


Route::get('/login', [\App\Http\Controllers\authentication\NetlifyAuthenticationController::class, 'index']);
Route::post('/login', [\App\Http\Controllers\authentication\NetlifyAuthenticationController::class, 'redirectToNetlify']);
Route::get('/callback', [\App\Http\Controllers\authentication\NetlifyAuthenticationController::class, 'callBack']);
