<?php

use App\Http\Controllers\Api\v1\AnimalController;
use App\Http\Controllers\Api\v1\AnimalKindController;
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

Route::group(['namespace' => 'Api\v1', /* 'prefix' => 'v1' */], function () {
    Route::get('animal_kinds', [AnimalKindController::class, 'index']);

    Route::group(['prefix' => 'animals'], function () {
        Route::get('/', [AnimalController::class, 'index']);
        Route::get('{name}', [AnimalController::class, 'show']);
        Route::post('/', [AnimalController::class, 'store']);
        Route::post('/age', [AnimalController::class, 'age']);
    });
});
