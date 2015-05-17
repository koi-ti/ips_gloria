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
		$data['roles'] = $roles = Role::getData();
		if(Request::ajax())
        {
            $data["links"] = $roles->links();
            $roles = View::make('core.roles.roles', $data)->render();
            return Response::json(array('html' => $roles));
        }
        return View::make('core.roles.index')->with($data);	
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$role = new Role;
        return View::make('core.roles.form')->with('role', $role);		
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
		$role = Role::find($id);
		if(!$role instanceof Role) {
			App::abort(404);	
		}
        return View::make('core.roles.show')->with('role', $role);		
    }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = Role::find($id);
		if(!$role instanceof Role) {
			App::abort(404);	
		}
        return View::make('core.roles.form')->with('role', $role);		
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


}
