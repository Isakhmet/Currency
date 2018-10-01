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

Route::group(['prefix'=>'v1'], function(){
    Route::get('currencies/{type}','Api\GetCurrency@getAllBanks')->where('type','cash|card|transfer');
    Route::get('exchanges', 'Api\GetCurrency@getExchangeMig');
    Route::get('trends/{code}', 'Api\GetCurrency@getGraphic');
    Route::get('natBank', 'Api\GetCurrency@getNationalBankCurrency');
});


