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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//list data in ussd
Route::get('ussddata', 'NgaoController@index');

//list specific data
Route::get('ussddata/{id}', 'NgaoController@show');

//add new data
Route::post('ussddata', 'NgaoController@store');

//update data
Route::put('ussddata', 'NgaoController@store');

//delete data
Route::delete('ussddata/{id}', 'NgaoController@destroy');
