<?php

class CompanyController extends \BaseController {

    /**
     * Instantiate a new CompanyController instance.
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
		$permission = Company::getPermission();
        if(@$permission->consulta) {
			$data['companys'] = $companys = Company::getData();
			if(Request::ajax())
	        {
	            $data["links"] = $companys->links();
	            $data["permission"] = $permission;
	            $companys = View::make('core.companys.companys', $data)->render();
	            return Response::json(array('html' => $companys));
	        }

            $data['permission'] = $permission;
	        return View::make('core.companys.index')->with($data);	
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
		$permission = Company::getPermission();
        if(@$permission->adiciona) {
			$company = new Company;

	        return View::make('core.companys.form')->with(['company' => $company]);
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
		    $company = new Company;
	      	
	      	if ($company->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$company->fill($data);	        				        			
	        		$company->save();

					DB::commit();
					return Response::json(array('success' => true, 'company' => $company));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $company->errors;
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
		$permission = Company::getPermission();
        if(@$permission->consulta) {
			$company = Company::find($id);
			if(!$company instanceof Company) {
				App::abort(404);	
			}

	        return View::make('core.companys.show')->with(['company' => $company, 'permission' => $permission]);
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
		$permission = Company::getPermission();
        if(@$permission->modifica) {
			$company = Company::find($id);
			if(!$company instanceof Company) {
				App::abort(404);	
			}	

	        return View::make('core.companys.form')->with(['company' => $company]);
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
			$company = Company::find($id);
			if(!$company instanceof Company) {
				App::abort(404);	
			}     
	        $data = Input::all();
	      	if ($company->isValid($data)){      		        	
	       		DB::beginTransaction();	
	        	try{
	        		$company->fill($data);	        				        			
	        		$company->save();
					DB::commit();
					return Response::json(array('success' => true, 'company' => $company));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
	        }
  			$data['errors'] = $company->errors;
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
