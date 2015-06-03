<?php

class RolesController extends \BaseController {

    /**
     * Instantiate a new RolesController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => ['post','put', 'remove']));
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $permission = Role::getPermission();
        if(@$permission->consulta) {
			$data['roles'] = $roles = Role::getData();
			if(Request::ajax())
	        {
	            $data["links"] = $roles->links();
	            $roles = View::make('core.roles.roles', $data)->render();
	            return Response::json(array('html' => $roles));
	        }
            $data['permission'] = $permission;
	        return View::make('core.roles.index')->with($data);	
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
		$permission = Role::getPermission();
        if(@$permission->adiciona) {
			$role = new Role;
	        return View::make('core.roles.form')->with('role', $role);		
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
		if(Request::ajax()) {
  			$data = Input::all();
		    $role = new Role;
	      	
	      	if ($role->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$role->fill($data);	        				        			
	        		$role->save();
					DB::commit();
					return Response::json(array('success' => true, 'role' => $role));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $role->errors;
        	$errors = View::make('errors', $data)->render();
    		return Response::json(array('success' => false, 'errors' => $errors));
  		}
        App::abort(404);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$permission = Role::getPermission();
        if(@$permission->consulta) {
			$role = Role::find($id);
			if(!$role instanceof Role) {
				App::abort(404);	
			}

			$parents = Module::whereRaw('nivel1 != 0')->whereRaw('nivel2 = 0')->orderBy('nivel1','asc')->get();
			$htmlparents = View::make('core.roles.permits.parents', ['parents' => $parents, 'role' => $role->id])->render();
	        return View::make('core.roles.show')->with(['role' => $role, 'htmlparents' => $htmlparents, 'permission' => $permission]);		
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
		$permission = Role::getPermission();
        if(@$permission->modifica) {
			$role = Role::find($id);
			if(!$role instanceof Role) {
				App::abort(404);	
			}
	        return View::make('core.roles.form')->with('role', $role);		
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
		if(Request::ajax()) {
			$role = Role::find($id);
			if(!$role instanceof Role) {
				App::abort(404);	
			}       
	        $data = Input::all();
	      	if ($role->isValid($data)){      		        	
	       		DB::beginTransaction();	
	        	try{
	        		$role->fill($data);	        				        			
	        		$role->save();
					DB::commit();
					return Response::json(array('success' => true, 'role' => $role));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
	        }
  			$data['errors'] = $role->errors;
        	$errors = View::make('errors', $data)->render();
    		return Response::json(array('success' => false, 'errors' => $errors));
		}
        App::abort(404);	
    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Display nivel1.
	 *
	 * @return Response
	 */
	public function nivel1()
	{
		if(Request::ajax()) 
		{
			$childrens = Module::where('nivel1', Input::get('module'))->whereRaw('nivel2 = 0')->whereRaw('nivel3 = 0')->orderBy('nivel2','asc')->get();
			$htmlchildrens = View::make('core.roles.permits.childrens_one', ['childrens' => $childrens, 'role' => Input::get('role')])->render();
    		return Response::json(array('success' => true, 'html' => $htmlchildrens));
		}
        App::abort(404);
	}


	/**
	 * Store permission.
	 *
	 * @return Response
	 */
	public function change()
	{
		if(Request::ajax()) 
		{
			$permits = Permission::where('modulo', Input::get('module'))->where('rol', Input::get('role'))->first();
			if($permits instanceof Permission) {
				switch (Input::get('permission')) {
					case 'consulta':
						$permits->consulta = $permits->consulta ? false : true;
						break;
					case 'adiciona':
						$permits->adiciona = $permits->adiciona ? false : true;
						break;
					case 'modifica':
						$permits->modifica = $permits->modifica ? false : true;
						break;
					case 'borra':
						$permits->borra = $permits->borra ? false : true;
						break;
					case 'otrouno':
						$permits->otrouno = $permits->otrouno ? false : true;
						break;
					case 'otrodos':
						$permits->otrodos = $permits->otrodos ? false : true;
						break;
					default:
						break;
				}
			}else{
				$permits = new Permission;
				$permits->modulo = Input::get('module');
				$permits->rol = Input::get('role');
				switch (Input::get('permission')) {
					case 'consulta':
						$permits->consulta = true;
						break;
					case 'adiciona':
						$permits->adiciona = true;
						break;
					case 'modifica':
						$permits->modifica = true;
						break;
					case 'borra':
						$permits->borra = true;
						break;
					case 'otrouno':
						$permits->otrouno = true;
						break;
					case 'otrodos':
						$permits->otrodos = true;
						break;
					default:
						break;
				}	
			}
			$permits->save();
			return Response::json(array('success' => true));
		}
        App::abort(404);
	}
}
