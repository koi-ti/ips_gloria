<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login', 'AuthController@showLogin');
Route::post('login', 'AuthController@postLogin');

Route::group(array('before' => 'auth'), function()
{	
	Route::get('/', function() { return View::make('core/index'); });
	Route::get('logout', 'AuthController@logOut');

	Route::resource('usuarios', 'UsersController');	
	Route::resource('ordenes', 'OrdersController');	
	Route::resource('ciudades', 'CitiesController');	

	Route::resource('clientes', 'CustomersController');	
	Route::group(array('prefix' => 'clientes'), function()	
	{	
		Route::post('buscar', 'CustomersController@search');
		Route::post('direcciones', 'CustomersController@searchAddresses');
	});
});