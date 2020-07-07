<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-all-user', 'TaskController@getAllData');

Route::get('/get-specific-user/{city}/{state}', 'TaskController@getSpecificData');

Route::get('/get-all-city', 'TaskController@getAllCity');

Route::get('/get-all-state', 'TaskController@getAllState');