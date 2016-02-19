<?php

class WorksheetController extends \BaseController {

    /**
     * Instantiate a new WorksheetController instance.
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
		$permission = Worksheet::getPermission();
        if(@$permission->consulta) {
			$data['worksheets'] = $worksheets = Worksheet::getDataDaily();
			if(Request::ajax()) {
	            $data["links"] = $worksheets->links();
	            $data["permission"] = $permission;
	            $worksheets = View::make('core.worksheet.worksheets.worksheets', $data)->render();
	            return Response::json(['html' => $worksheets]);
	        }

            $data['permission'] = $permission;
	        return View::make('core.worksheet.worksheets.index')->with($data);	
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
		$permission = Worksheet::getPermission();
        if(@$permission->adiciona) {
        	$date = Input::has('fecha') ? Input::get('fecha') : date('Y-m-d');
        	$data['worksheets'] = $worksheets = Worksheet::getData($date);
			if(Request::ajax()) {
	            $data["links"] = $worksheets->links();
	            $data["permission"] = $permission;
	            $worksheets = View::make('core.worksheet.worksheets.worksheetsitem', $data)->render();
	            return Response::json(['html' => $worksheets]);
	        }

            $data['permission'] = $permission;
            $data['services'] = WorksheetService::lists('nombre', 'id');
            $data['exams'] = WorksheetExam::lists('nombre', 'id');
            $data['date'] = $date;
	        return View::make('core.worksheet.worksheets.form')->with($data);
		}else{
			return Redirect::route('planilla.planillas.index');
        }
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    	$date = Input::has('fecha') ? Input::get('fecha') : date('Y-m-d');
		if(Request::ajax() && $date == date('Y-m-d')) {
  			$data = Input::all();
		    $worksheet = new Worksheet;
	      	
	      	if ($worksheet->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$worksheet->fill($data);

	        		// Examen
	        		$WorksheetService = WorksheetService::find(Input::get('servicio'));
	        		if($WorksheetService->examen && Input::has('examen')) {
	        			$worksheet->examen = Input::get('examen');
	        		}

	        		$worksheet->porcentaje = $WorksheetService->descuento;
	        		$worksheet->descuento = $WorksheetService->porcentaje;
	        		$worksheet->hora = date('H:m:s');
	        		$worksheet->save();

					DB::commit();
					return Response::json(array('success' => true, 'worksheet' => $worksheet));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $worksheet->errors;
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
		App::abort(404);	
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
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
