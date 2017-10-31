<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'qrcode'], function () use ($router) {
	Route::get('/', 'QrcodeController@index');
	Route::get('/', 'QrcodeController@index');
    Route::get('importExport', 'QrcodeController@importExport');
	Route::get('downloadExcel/{type}', 'QrcodeController@downloadExcel');
	Route::post('importExcel', 'QrcodeController@importExcel');
});