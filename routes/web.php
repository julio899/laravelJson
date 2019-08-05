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

Route::get('lic', 'JsonController@checkLicencia');

Route::post('lic', 'JsonController@checkLicencia')->middleware('aceptcors');

/*
Route::group(['middleware' => 'aceptcors'], function()
{
  	//podemos seguir recibiendo los metodos
	Route::post('lic', 'JsonController@checkLicencia')->middleware('AceptCors');
});

Route::match(['options', 'put'], '/lic', function () {
    // This will work with the middleware shown in the accepted answer
	Route::post('lic', 'JsonController@checkLicencia')->middleware('aceptcors');
})->middleware('aceptcors');
*/