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
        return View::make('core.orders.index')->with($data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$order = new Order;
        $repairmans = Repairman::lists('nombre', 'id');
    
        return View::make('core/orders/form')->with(['order' => $order, 'repairmans' => $repairmans]);	
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
		$order = Order::select('orden.*', 'cliente.nit as cliente_nit', 'cliente.nombre as cliente_nombre', 'tecnico.nombre as tecnico_nombre', 
			'cliente_direccion.nombre as cliente_direccion_nombre')
			->join('cliente', 'orden.cliente', '=', 'cliente.id')
			->join('cliente_direccion', 'orden.cliente_direccion', '=', 'cliente_direccion.id')
			->join('tecnico', 'orden.tecnico', '=', 'tecnico.id')
			->first();		
        if (!$order instanceof Order) {
            App::abort(404);   
        } 

        return View::make('core.orders.show', ['order' => $order]);	
    }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// 
   	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
