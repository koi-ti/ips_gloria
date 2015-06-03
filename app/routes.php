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
	Route::resource('roles', 'RolesController');	
	Route::resource('ordenes', 'OrdersController');	
	Route::resource('ciudades', 'CitiesController');	
	Route::resource('tecnicos', 'RepairmanController');	

	Route::group(array('prefix' => 'clientes'), function()	
	{	
		Route::get('buscar', 'CustomersController@search');
		Route::get('filtrar', 'CustomersController@filtrar');
		Route::get('direcciones', 'CustomersController@searchAddresses');
	});
	Route::resource('clientes', 'CustomersController');	

	Route::group(array('prefix' => 'util'), function()	
	{	
		Route::resource('cart', 'SessionCartController');

		Route::group(array('prefix' => 'permisos'), function()	
		{	
			Route::get('nivel1', 'RolesController@nivel1');	
			Route::post('cambiar', 'RolesController@change');	
		});
	});

	Route::group(array('prefix' => 'reportes'), function()	
	{	
		Route::post('ordenes', 'ReportsController@ordenes');	
		Route::post('ordenessinvisitas', 'ReportsController@ordenessinvisitas');	
		Route::post('ordenesabiertas', 'ReportsController@ordenesabiertas');	
	});
	Route::resource('reportes', 'ReportsController', ['only' => ['index']]);
});