<?php

class CustomersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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

	/**
	 * Search resource.
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
