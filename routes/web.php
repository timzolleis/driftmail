<?php

use App\Models\entities\MailConfig;
use App\Models\ProjectConfiguration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
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

Route::prefix('project')->as('project:')->middleware('auth')->group(
    base_path('routes/project.php')
);

Route::prefix('project/{project}')->as('project:variable')->middleware('auth')->group(
    [
        base_path('routes/variable.php'),
        base_path('routes/template.php')
    ]
);


Route::get('/login', [\App\Http\Controllers\authentication\AuthenticationController::class, 'index']);
Route::get('/logout', [\App\Http\Controllers\authentication\AuthenticationController::class, 'logout']);


Route::prefix('oauth')->group(function () {
    Route::get('/login', [\App\Http\Controllers\authentication\AuthenticationController::class, 'authorize']);
    Route::get('/callback', [\App\Http\Controllers\authentication\AuthenticationController::class, 'callback']);
});

