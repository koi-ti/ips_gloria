<?php

class UsersController extends \BaseController {

    /**
     * Instantiate a new UsersController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => ['post','put']));
        $this->beforeFilter('auth');
    }

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        $data["users"] = $users = User::where('id', '!=', '1')->paginate();                
        if(Request::ajax())
        {
            $data["links"] = $users->links();
            $users = View::make('core/users/users', $data)->render();
            return Response::json(array('html' => $users));
        }
        return View::make('core/users/index')->with($data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        $user = new User;
        return View::make('core/users/form')->with('user', $user);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        $user = new User;
        $data = Input::all();        
        if ($user->isValid($data))
        {
            $user->fill($data);
            $user->save();
            return Redirect::route('usuarios.index');
        }else{
            return Redirect::route('usuarios.create')->withInput()->withErrors($user->errors);
        }      
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id) { 
        $user = User::find($id);
        if (is_null($user)) {
            App::abort(404);   
        } 
        return View::make('core/users/show', array('user' => $user));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $user = User::find($id);
        if (is_null ($user)) {
            App::abort(404);
        }
        return View::make('core/users/form')->with('user', $user);      
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $user = User::find($id);
        if (is_null ($user)) {
            App::abort(404);
        }        
        $data = Input::all();
        if ($user->validAndSave($data)){
            return Redirect::route('usuarios.show', array($user->id));        
        }else{
            return Redirect::route('usuarios.edit', $user->id)->withInput()->withErrors($user->errors);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        $user = User::find($id);        
        if (is_null ($user)) {
            App::abort(404);
        }
        $user->delete();
        return Redirect::route('usuarios.index');
    }

    public function search()
    {
        $name = Input::get('name');
        $users = User::where('name','like',"%$name%")->get();
        return Response::json($users);
    }
}