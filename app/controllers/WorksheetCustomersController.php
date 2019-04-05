<?php

class WorksheetCustomersController extends \BaseController {

    /**
     * Instantiate a new WorksheetCustomersController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', ['except' => ['index', 'create', 'show', 'edit']]);
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$permission = WorksheetCustomer::getPermission();
        if(@$permission->consulta) {
			$data['customers'] = $customers = WorksheetCustomer::getData();
			if(Request::ajax()) {
	            $data["links"] = $customers->links();
	            $data["permission"] = $permission;
	            $customers = View::make('core.worksheet.customers.customers', $data)->render();
	            return Response::json(['html' => $customers]);
	        }

            $data['permission'] = $permission;
	        return View::make('core.worksheet.customers.index')->with($data);	
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
		$permission = WorksheetCustomer::getPermission();
        if(@$permission->adiciona) {
			$customer = new WorksheetCustomer;

	        return View::make('core.worksheet.customers.form')->with(['customer' => $customer]);
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
		    $customer = new WorksheetCustomer;
	      	
	      	if ($customer->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$customer->fill($data);	        				        			
	        		$customer->save();

					DB::commit();
					return Response::json(array('success' => true, 'customer' => $customer));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $customer->errors;
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
		$permission = WorksheetCustomer::getPermission();
        if(@$permission->consulta) {
			$customer = WorksheetCustomer::find($id);
			if(!$customer instanceof WorksheetCustomer) {
				App::abort(404);	
			}

	        return View::make('core.worksheet.customers.show')->with(['customer' => $customer, 'permission' => $permission]);
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
		$permission = WorksheetCustomer::getPermission();
        if(@$permission->modifica) {
			$customer = WorksheetCustomer::find($id);
			if(!$customer instanceof WorksheetCustomer) {
				App::abort(404);	
			}
			
	        return View::make('core.worksheet.customers.form')->with(['customer' => $customer]);
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
			$customer = WorksheetCustomer::find($id);
			if(!$customer instanceof WorksheetCustomer) {
				App::abort(404);	
			}       
	        $data = Input::all();
	      	if ($customer->isValid($data)){      		        	
	       		DB::beginTransaction();	
	        	try{
	        		$customer->fill($data);	        				        			
	        		$customer->save();
					DB::commit();
					return Response::json(array('success' => true, 'customer' => $customer));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
	        }
  			$data['errors'] = $customer->errors;
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
	 * Search resource.
	 *
	 * @return Response
	 */
	public function filtrar()
    {
    	if(Request::ajax()) {
    		$html = '';
    		if(Input::has('cedula') || Input::has('nombre')){
		        $customers = WorksheetCustomer::getData();
			    $html = View::make('core.worksheet.customers.search', ['customers' => $customers])->render();
	        }    
	      	return Response::json(array('html' => $html));	
		}
        App::abort(404);      
    }
}
