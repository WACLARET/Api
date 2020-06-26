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
Route::get('getdata', 'NgaoController@index');

//list specific data
Route::get('getdata/{id}', 'NgaoController@show');

//add new data
Route::post('postdata', 'NgaoController@advanceapplication');

//update data
Route::put('putdata', 'NgaoController@store');

//delete data
Route::delete('deletedata/{id}', 'NgaoController@destroy');

//pay loan
Route::post('payloan', 'PayLoanController@index');

//topup
Route::post('Topup', 'TopUpController@topuploan');

//loanstatus
// Route::post('loanstatus', 'LoanStatusController@store');

Route::get('loanstatus', 'LoanStatusController@loanstatus');

//statement
Route::get('statement', 'LoanStatusController@ministatement');