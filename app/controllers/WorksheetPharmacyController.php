<?php

class WorksheetPharmacyController extends \BaseController {

	/**
     * Instantiate a new WorksheetPharmacyController instance.
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
		$permission = WorksheetPharmacy::getPermission();
        if(@$permission->consulta) {
			$data['pharmacies'] = $pharmacies = WorksheetPharmacy::getData();
			if(Request::ajax()) {
	            $data["links"] = $pharmacies->links();
	            $data["permission"] = $permission;
	            $pharmacies = View::make('core.worksheet.pharmacies.pharmacies', $data)->render();
	            return Response::json(['html' => $pharmacies]);
	        }

            $data['permission'] = $permission;
	        return View::make('core.worksheet.pharmacies.index')->with($data);	
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
		$permission = WorksheetPharmacy::getPermission();
        if(@$permission->adiciona) {
			$pharmacy = new WorksheetPharmacy;

	        return View::make('core.worksheet.pharmacies.form')->with(['pharmacy' => $pharmacy]);
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
		    $pharmacy = new WorksheetPharmacy;
	      	
	      	if ($pharmacy->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$pharmacy->fill($data);      				        			
	        		$pharmacy->save();

					DB::commit();
					return Response::json(array('success' => true, 'pharmacy' => $pharmacy));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $pharmacy->errors;
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
		$pharmacy = WorksheetPharmacy::find($id);
		if(!$pharmacy instanceof WorksheetPharmacy) {
			App::abort(404);	
		}	

		if(Request::ajax()) {
			return Response::json(['success' => true, 'valor' => $pharmacy->valor, 'nombre' => $pharmacy->nombre]);
		}

		$permission = WorksheetPharmacy::getPermission();
        if(@$permission->consulta) {
	        return View::make('core.worksheet.pharmacies.show')->with(['pharmacy' => $pharmacy, 'permission' => $permission]);
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
		$permission = WorksheetPharmacy::getPermission();
        if(@$permission->modifica) {
			$pharmacy = WorksheetPharmacy::find($id);
			if(!$pharmacy instanceof WorksheetPharmacy) {
				App::abort(404);	
			}
			
	        return View::make('core.worksheet.pharmacies.form')->with(['pharmacy' => $pharmacy]);
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
			$pharmacy = WorksheetPharmacy::find($id);
			if(!$pharmacy instanceof WorksheetPharmacy) {
				App::abort(404);	
			}       
	        $data = Input::all();
	      	if ($pharmacy->isValid($data)){      		        	
	       		DB::beginTransaction();	
	        	try{
	        		$pharmacy->fill($data);	
	        		$pharmacy->save();
					
					DB::commit();
					return Response::json(array('success' => true, 'pharmacy' => $pharmacy));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
	        }
  			$data['errors'] = $pharmacy->errors;
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
