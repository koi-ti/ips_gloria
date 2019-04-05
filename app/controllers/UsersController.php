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
        $permission = User::getPermission();
        if(@$permission->consulta) {
            $data["users"] = $users = User::where('id', '!=', '1')->paginate();                
            if(Request::ajax())
            {
                $data["links"] = $users->links();
                $data["permission"] = $permission;
                $users = View::make('core/users/users', $data)->render();
                return Response::json(array('html' => $users));
            }

            $data['permission'] = $permission;
            return View::make('core/users/index')->with($data);
        }else{
            return View::make('core.denied');   
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        $permission = User::getPermission();
        if(@$permission->adiciona) {
            $user = new User;
            $roles = Role::lists('nombre', 'id');

            return View::make('core/users/form')->with(['user' => $user, 'roles' => $roles]);
        }else{
            return View::make('core.denied');   
        }
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

            // Medico
            if(Input::has('medico')) {
                $user->medico = true; 
                $user->registro = Input::get('registro');               
            }else{
                $user->medico = false;                
                $user->registro = '';               
            }

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
        $permission = User::getPermission();
        if(@$permission->consulta) {
            $user = User::find($id);
            if (is_null($user)) {
                App::abort(404);   
            } 

            $role = Role::find($user->rol);
            if (!$role instanceof Role) {
                App::abort(404);   
            } 
            return View::make('core/users/show', ['user' => $user, 'role' => $role, 'permission' => $permission]);
        }else{
            return View::make('core.denied');   
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $permission = User::getPermission();
        if(@$permission->modifica) {
            $user = User::find($id);
            if (is_null ($user)) {
                App::abort(404);
            }

            $roles = Role::lists('nombre', 'id');
            return View::make('core/users/form')->with(['user' => $user, 'roles' => $roles]);
        }else{
            return View::make('core.denied');   
        }
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