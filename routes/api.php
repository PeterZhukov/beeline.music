<?php

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

Route::prefix('v1')->group(function() {
    Route::get('images/{id}', '\\'.\App\Http\Controllers\Api\V1\ApiController::class.'@getImage')
        ->middleware(\App\Http\Middleware\RateLimit::class)
        ->where('id', '[0-9]+');
    Route::get('stats/{id}', '\\'.\App\Http\Controllers\Api\V1\ApiController::class.'@getStats')
        ->where('id', '[0-9]+');
});
