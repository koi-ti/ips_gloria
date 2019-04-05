<?php

class CustomersController extends \BaseController {

    /**
     * Instantiate a new CustomersController instance.
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
		$permission = Customer::getPermission();
        if(@$permission->consulta) {
			$data['customers'] = $customers = Customer::getData();
			if(Request::ajax())
	        {
	            $data["links"] = $customers->links();
	            $data["permission"] = $permission;
	            $customers = View::make('core.customers.customers', $data)->render();
	            return Response::json(array('html' => $customers));
	        }

            $data['permission'] = $permission;
	        return View::make('core.customers.index')->with($data);	
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
		$permission = Customer::getPermission();
        if(@$permission->adiciona) {
			$customer = new Customer;
	        $cities = City::lists('nombre', 'codigo');

	        return View::make('core.customers.form')->with(['customer' => $customer, 'cities' => $cities]);
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
		    $customer = new Customer;
	      	
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
		$permission = Customer::getPermission();
        if(@$permission->consulta) {
			$customer = Customer::find($id);
			if(!$customer instanceof Customer) {
				App::abort(404);	
			}
			$city = City::find($customer->ciudad);

	        return View::make('core.customers.show')->with(['customer' => $customer, 'city' => $city, 'permission' => $permission]);
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
		$permission = Customer::getPermission();
        if(@$permission->modifica) {
			$customer = Customer::find($id);
			if(!$customer instanceof Customer) {
				App::abort(404);	
			}
	        $cities = City::lists('nombre', 'codigo');
			
	        return View::make('core.customers.form')->with(['customer' => $customer, 'cities' => $cities]);
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
			$customer = Customer::find($id);
			if(!$customer instanceof Customer) {
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
		        $customers = Customer::getData();
			    $html = View::make('core/customers/search', ['customers' => $customers])->render();
	        }    
	      	return Response::json(array('html' => $html));	
		}
        App::abort(404);      
    }

	/**
	 * Filtar resource.
	 *
	 * @return Response
	 */
	public function search()
    {
		$customer = Customer::where('cedula','=', Input::get('cedula'))->first();
		if($customer instanceof Customer) {			
			$customer->imagen = $customer->imagen ? URL::asset($customer->imagen) : URL::asset('images/default-avatar.png');
			return Response::json(array('success' => true, 'customer' => $customer));
		}
		return Response::json(array('success' => false));        
    }

	/**
	 * Store img customer.
	 *
	 * @return Response
	 */
	public function file()
	{
		$customer = Customer::find(Input::get('id'));
		if(!$customer instanceof Customer) {
			App::abort(404);	
		}

		if (Input::hasFile('imagen')) {
			$file = Input::file('imagen');
			if(strpos($file->getClientMimeType(),'image') !== FALSE) {
				$upload_name = '/img/'.str_random().'.jpg';
				
				$img = Image::make($file->getPathName());
				// now you are able to resize the instance
				$img->resize(100, 100);
				$img->save((public_path().$upload_name), 100);
				
				$customer->imagen = $upload_name;
				$customer->save();
			}
		}
        return Redirect::route('pacientes.show', array($customer->id));
	}
}
