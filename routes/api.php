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

Route::get('/lines', 'AppController@getLines');
Route::get('/lines/{line}/stops', 'AppController@getStops');
Route::get('/table/{line}/{stop}', 'AppController@getTable');
