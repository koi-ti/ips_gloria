<?php

class OrdersController extends \BaseController {

    /**
     * Instantiate a new OrdersController instance.
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
		$data['orders'] = $orders = Order::getData();
		if(Request::ajax())
        {
            $data["links"] = $orders->links();
            $orders = View::make('core.orders.orders', $data)->render();
            return Response::json(array('html' => $orders));
        }
        $permission = Order::getPermission();
        $data['permission'] = $permission;
        if(@$permission->consulta) {
        	return View::make('core.orders.index')->with($data);
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
        $permission = Order::getPermission();
        if(@$permission->adiciona) {
			$order = new Order;
	        $repairmans = Repairman::where('activo',true)->lists('nombre', 'id');
	    	
        	// Elimino datos carrito de session
	        Session::forget(Order::$key_cart_visits);
	        return View::make('core/orders/form')->with(['order' => $order, 'repairmans' => $repairmans, 'html_visits' => '']);	
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
		    $order = new Order;
	      	
	      	if ($order->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$order->fill($data);	        			
	        		$order->usuario_elaboro = Auth::user()->id;	        			
	        		$order->fecha_elaboro = date('Y-m-d H:i:s');	        			
	        		$order->save();
					DB::commit();
					return Response::json(array('success' => true, 'order' => $order));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $order->errors;
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
        $permission = Order::getPermission();
        if(@$permission->consulta) {
			$order = Order::select('orden.*', 'orden.id as orden_id', 'cliente.nit as cliente_nit', 'cliente.nombre as cliente_nombre', 'tecnico.nombre as tecnico_nombre', 
				'cliente_direccion.nombre as cliente_direccion_nombre')
				->join('cliente', 'orden.cliente', '=', 'cliente.id')
				->join('cliente_direccion', 'orden.cliente_direccion', '=', 'cliente_direccion.id')
				->join('tecnico', 'orden.tecnico', '=', 'tecnico.id')
				->where('orden.id', '=', $id)
				->first();		
	        if (!$order instanceof Order) {
	            App::abort(404);   
	        } 

	        $visits = Visit::select('visita.*', 'tecnico.nombre as tecnico_nombre')
	        	->join('tecnico', 'visita.tecnico', '=', 'tecnico.id')
	        	->where('visita.orden', '=', $order->orden_id)->get();
	        return View::make('core.orders.show', ['order' => $order, 'visits' => $visits, 'permission' => $permission]);	
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
		$permission = Order::getPermission();
		$order = Order::find($id);
		if(!$order instanceof Order){
			App::abort(404);   
		}
        if(@$permission->modifica && !$order->cerrada) {        	
        	$customer = Customer::find($order->cliente);
	        if (is_null($customer)) {
	            App::abort(404);   
	        }
        	$address = CustomerAddress::where('cliente', $customer->id)->lists('nombre', 'id');

        	// Elimino datos carrito de session
	        Session::forget(Order::$key_cart_visits);
	        $visits = Visit::select('visita.*', 'tecnico.nombre as tecnico_nombre')
	        	->join('tecnico', 'visita.tecnico', '=', 'tecnico.id')
	        	->where('orden', '=', $order->id)->get();
			foreach ($visits as $visit) {
	        	$item = array();
	        	$item['_key'] = Order::$key_cart_visits;
	        	$item['_template'] = Order::$template_cart_visits;
	        	$item['_layer'] = Order::$layer_cart_visits;	
				$item['vis_id'] = $visit->id;
				$item['vis_tecnico'] = $visit->tecnico;
				$item['vis_tecnico_nombre'] = $visit->tecnico_nombre;
				$item['vis_fecha_inicial'] = $visit->fecha_inicio;
				$item['vis_fecha_final'] = $visit->fecha_final;
				$item['vis_observaciones'] = $visit->observaciones;	
				$item['vis_pendientes'] = $visit->pendientes;
	        	SessionCart::addItem($item);
	        }
			$html_visits = SessionCart::show(Order::$key_cart_visits, Order::$template_cart_visits);

	        $repairmans = Repairman::where('activo',true)->lists('nombre', 'id');
	        return View::make('core/orders/form')->with(['order' => $order, 'repairmans' => $repairmans, 'customer' => $customer, 'address' => $address,
	        	'html_visits' => $html_visits]);	
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
			$order = Order::find($id);		
	        if (!$order instanceof Order) {
	            App::abort(404);   
	        } 

  			$data = Input::all();	      	
	      	if ($order->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$order->fill($data);	        			
	        		$order->save();
					
					// Actualizar direcciones cliente
			        $visits = Session::get(Order::$key_cart_visits);
			   		if(count($visits) !=0 && $visits != NULL)
			   		{
					    foreach ($visits as $visit) {				        	
			 		       	$visit = (object) $visit;
			 		      	$order_visit = Visit::find($visit->vis_id);
							if(isset($visit->_delete) != 'delete') 
			 		      	{
				 		      	if(!$order_visit instanceof Visit){
						        	$order_visit = new Visit();
						        	$order_visit->orden = $order->id;
						        	$order_visit->tecnico = $visit->vis_tecnico;
						        	$order_visit->fecha_inicio = $visit->vis_fecha_inicial;
						        	$order_visit->fecha_final = $visit->vis_fecha_final;
						        	$order_visit->observaciones = $visit->vis_observaciones;
						        	$order_visit->pendientes = $visit->vis_pendientes;
						       		$order_visit->usuario_elaboro = Auth::user()->id;	
						       		$order_visit->fecha_elaboro = date('Y-m-d H:i:s');
						        	if(isset($visit->vis_finorden)){
						        		$order_visit->finorden = true;
						        	}
						        	$order_visit->save();

						        	if(isset($visit->vis_finorden)){
						        		$order->cerrada = true;
						        		$order->usuario_cierra = Auth::user()->id;	
						       			$order->fecha_cierra = date('Y-m-d H:i:s');
						        		$order->save();
						        	}
			    	    		}
			    	    	}else{
				 		      	if($order_visit instanceof Visit){
			    	    			$order_visit->delete();
			    	    		}
			    	    	}
						}
					}
					DB::commit();
					return Response::json(array('success' => true, 'order' => $order));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $order->errors;
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
