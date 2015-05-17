<?php

class AuthController extends BaseController {

	/**
	 * Muestra el formulario para login.
	 */
	public function showLogin()
	{
		if (Auth::check())
		{
		    return Redirect::to('/');
		}
		return View::make('login');
	}


	/**
	 * Valida los datos del usuario.
	 */
	public function postLogin()
	{
		$userdata = array(
            'email' => Input::get('email'),
            'password'=> Input::get('password'),
            'activo' => True
        );
        if(Auth::attempt($userdata, Input::get('remember-me', 0)))
        {
        	return Redirect::to('/');
        }
        return Redirect::to('login')
					->with('mensaje_error', 'Tus datos son incorrectos')
				    ->withInput();
	}


	/**
	 * Muestra el formulario de login mostrando un mensaje de que cerro sesión.
	 */
	public function logOut()
	{
		Auth::logout();
		Session::flush();
		return Redirect::to('login')
					->with('mensaje_error', 'Tu sesión ha sido cerrada.');
	}

}