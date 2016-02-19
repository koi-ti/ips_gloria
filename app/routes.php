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
	Route::resource('ciudades', 'CitiesController');	
	Route::resource('empresas', 'CompanyController');	

	Route::group(array('prefix' => 'pacientes'), function()	
	{	
		Route::get('buscar', 'CustomersController@search');
		Route::get('filtrar', 'CustomersController@filtrar');
		Route::post('file', ['as' => 'pacientes.file', 'uses' => 'CustomersController@file']);	
	});
	Route::resource('pacientes', 'CustomersController');	

	Route::group(array('prefix' => 'certificados'), function()	
	{
		Route::get('reporte/{id}', ['as' => 'certificados.reporte', 'uses' => 'CertificatesController@reporte']);	
	});
	Route::resource('certificados', 'CertificatesController');	

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
		Route::post('acumulados', 'ReportesController@acumulados');
		Route::post('acumuladosxls', 'ReportesController@acumuladosxls');
	});
	Route::resource('reportes', 'ReportesController', ['only' => ['index']]);

	Route::group(['prefix' => 'planilla'], function()
	{	
		Route::resource('pacientes', 'WorksheetCustomersController');	
		Route::resource('servicios', 'WorksheetServicesController');	
		Route::resource('examen', 'WorksheetExamController');	
		Route::resource('gastos', 'WorksheetExpenseController');
		Route::resource('planillas', 'WorksheetController');	
	});

});