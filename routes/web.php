<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/transacciones','transaccionController@get');

Route::get('/verifyEstatus','transaccionController@verifyEstatusTransactionsGet');

Route::post('/verifyEstatus','transaccionController@verifyEstatusTransactionsPost');

Route::post('/','transaccionController@crearTransaccion');

Route::post('/getBankList','transaccionController@getListBanks');

Route::get('/getBankList','transaccionController@getListBanks');


