<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/insert-city', 'InsertController@insertCityData');

Route::get('/insert-state', 'InsertController@insertStateData');

Route::get('/insert-user', 'InsertController@insertUserData');

Route::get('/test-state', 'TaskController@testState');

Route::get('/test-city', 'TaskController@testCity');

Route::any('recharge-response/{accountId}/{txid}/{optxid}/{transtype}', 'TaskController@rechargeResponse');

Route::get('recharge-request', 'TaskController@rechargeRequest');