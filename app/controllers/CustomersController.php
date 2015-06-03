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

	        // Elimino datos carrito de session
	        Session::forget(Customer::$key_cart_address);
	        return View::make('core.customers.form')->with(['customer' => $customer, 'cities' => $cities, 'html_address' => '']);
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

	        		// Insertar direcciones cliente
			        $addresses = Session::get(Customer::$key_cart_address);
			   		if(count($addresses) !=0 && $addresses != NULL)
			   		{
				        foreach ($addresses as $address) {				        	
			 		       	$address = (object) $address;
				        	$customer_address = new CustomerAddress();
				        	$customer_address->cliente = $customer->id;
				        	$customer_address->activo = true;
				        	$customer_address->nombre = $address->add_nombre;
				        	$customer_address->persona = $address->add_persona;
				        	$customer_address->direccion = $address->add_direccion;
				        	$customer_address->activo = $address->add_activo;
				        	$customer_address->ciudad = $address->add_ciudad;
				        	$customer_address->telefono = $address->add_telefono;
				        	$customer_address->save();
						}
					}
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
			if(!$city instanceof City) {
				App::abort(404);	
			}

	       $addresses = CustomerAddress::select('cliente_direccion.*', 'ciudad.nombre as ciudad_nombre')
	        	->join('ciudad', 'cliente_direccion.ciudad', '=', 'ciudad.codigo')
	        	->where('cliente', '=', $customer->id)->get();

	        return View::make('core.customers.show')->with(['customer' => $customer, 'city' => $city, 'addresses' => $addresses, 'permission' => $permission]);
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
			
	        // Elimino datos carrito de session
	        Session::forget(Customer::$key_cart_address);
	        $addresses = CustomerAddress::select('cliente_direccion.*', 'ciudad.nombre as ciudad_nombre')
	        	->join('ciudad', 'cliente_direccion.ciudad', '=', 'ciudad.codigo')
	        	->where('cliente', '=', $customer->id)->get();
			foreach ($addresses as $address) {
	        	$item = array();
	        	$item['_key'] = Customer::$key_cart_address;
	        	$item['_template'] = Customer::$template_cart_address;
	        	$item['_layer'] = Customer::$layer_cart_address;	
				$item['add_id'] = $address->id;
				$item['add_nombre'] = $address->nombre;
				$item['add_persona'] = $address->persona;
				$item['add_direccion'] = $address->direccion;
				$item['add_ciudad'] = $address->ciudad;
				$item['add_ciudad_nombre'] = $address->ciudad_nombre;	
				$item['add_activo'] = $address->activo;
				$item['add_telefono'] = $address->telefono;
	        	SessionCart::addItem($item);
	        }

			$html_address = SessionCart::show(Customer::$key_cart_address, Customer::$template_cart_address);

	        return View::make('core.customers.form')->with(['customer' => $customer, 'cities' => $cities, 'html_address' => $html_address]);
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

	        		// Actualizar direcciones cliente
			        $addresses = Session::get(Customer::$key_cart_address);
			        if(count($addresses) !=0 && $addresses != NULL)
			   		{
					    foreach ($addresses as $address) {				        	
			 		       	$address = (object) $address;
			 		       	$customer_address = CustomerAddress::find($address->add_id);
			 		      	if(isset($address->_delete) != 'delete') 
			 		      	{
				 		      	if(!$customer_address instanceof CustomerAddress){
						        	$customer_address = new CustomerAddress();
						        	$customer_address->cliente = $customer->id;
						        	$customer_address->activo = true;
						        	$customer_address->nombre = $address->add_nombre;
						        	$customer_address->persona = $address->add_persona;
						        	$customer_address->direccion = $address->add_direccion;
						        	$customer_address->activo = $address->add_activo;
						        	$customer_address->ciudad = $address->add_ciudad;
						        	$customer_address->telefono = $address->add_telefono;
						        	$customer_address->save();
			    	    		}
			    	    	}else{
			    	    		if($customer_address instanceof CustomerAddress) {
			    	    			$customer_address->delete();
			    	    		}		
			    	    	}
						}
					}
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
    		if(Input::has('nit') || Input::has('nombre')){
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
        $nit = Input::get('nit');
		$customer = Customer::where('nit','=', $nit)->first();
		if($customer instanceof Customer){			
			return Response::json(array('success' => true, 'customer' => $customer));
		}
		return Response::json(array('success' => false));        
    }

	/**
	 * Search addresses resource.
	 *
	 * @return Response
	 */
	public function searchAddresses()
    {
        $cliente = Input::get('cliente');
		$addresses = CustomerAddress::where('cliente','=', $cliente)->lists('nombre', 'id');
		if(count($addresses)>=1){			
			return Response::json(array('success' => true, 'addresses' => $addresses));
		}
		return Response::json(array('success' => false));        
    }
}
