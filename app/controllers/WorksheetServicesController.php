<?php

class WorksheetServicesController extends \BaseController {

    /**
     * Instantiate a new WorksheetServicesController instance.
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
		$permission = WorksheetService::getPermission();
        if(@$permission->consulta) {
			$data['services'] = $services = WorksheetService::getData();
			if(Request::ajax()) {
	            $data["links"] = $services->links();
	            $data["permission"] = $permission;
	            $services = View::make('core.worksheet.services.services', $data)->render();
	            return Response::json(['html' => $services]);
	        }

            $data['permission'] = $permission;
	        return View::make('core.worksheet.services.index')->with($data);	
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
		$permission = WorksheetService::getPermission();
        if(@$permission->adiciona) {
			$service = new WorksheetService;

	        return View::make('core.worksheet.services.form')->with(['service' => $service]);
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
		    $service = new WorksheetService;
	      	
	      	if ($service->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$service->fill($data);
	        		$service->examen = Input::has('examen') ? true : false;       				        			
	        		$service->save();

					DB::commit();
					return Response::json(array('success' => true, 'service' => $service));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $service->errors;
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
		$service = WorksheetService::find($id);
		if(!$service instanceof WorksheetService) {
			App::abort(404);	
		}
		
		if(Request::ajax()) {
    		return Response::json(['success' => true, 'examen' => $service->examen, 'valor' => $service->valor, 'valor_format' => number_format($service->valor, 2,'.',',' )]);
		}

		$permission = WorksheetService::getPermission();
        if(@$permission->consulta) {
	        return View::make('core.worksheet.services.show')->with(['service' => $service, 'permission' => $permission]);
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
		$permission = WorksheetService::getPermission();
        if(@$permission->modifica) {
			$service = WorksheetService::find($id);
			if(!$service instanceof WorksheetService) {
				App::abort(404);	
			}
			
	        return View::make('core.worksheet.services.form')->with(['service' => $service]);
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
			$service = WorksheetService::find($id);
			if(!$service instanceof WorksheetService) {
				App::abort(404);	
			}       
	        $data = Input::all();
	      	if ($service->isValid($data)){      		        	
	       		DB::beginTransaction();	
	        	try{
	        		$service->fill($data);	
	        		$service->examen = Input::has('examen') ? true : false;       				        			        				        			
	        		$service->save();
					DB::commit();
					return Response::json(array('success' => true, 'service' => $service));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
	        }
  			$data['errors'] = $service->errors;
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
