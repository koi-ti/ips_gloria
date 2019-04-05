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
            $data['date'] = $date;
        	$data['worksheets'] = $worksheets = Worksheet::getData($date);
            $data["permission"] = $permission;
        	
			if(Request::ajax()) {
	            $data["links"] = $worksheets->links();
	            $worksheets = View::make('core.worksheet.worksheets.worksheetsitem', $data)->render();
	            return Response::json(['html' => $worksheets]);
	        }
            $data['services'] = WorksheetService::lists('nombre', 'id');
            $data['pharmacies'] = WorksheetPharmacy::lists('nombre', 'id');
            $data['exams'] = WorksheetExam::lists('nombre', 'id');
        	
        	// Gastos
        	$expenses = WorksheetExpense::getData($date);
        	$data['expenses'] = $expenses;
            $data["permissionExpense"] = WorksheetExpense::getPermission();

			// Elimino datos carritos de session
			Session::forget(Worksheet::$key_cart_exams);
			Session::forget(Worksheet::$key_cart_pharmacies);
	        
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
	        	$WorksheetService = WorksheetService::find(Input::get('servicio'));
	       		if(!$WorksheetService instanceof WorksheetService){
					return Response::json(['success' => false, 'errors' => 'Ocurrio un error recuperando informacion del servicio - Consulte al administrador.']);
	       		}

	       		// Is valid carritos
	       		$result = 'OK';
	       		if($WorksheetService->examen) {
       				$result = $worksheet->isValidExams();
	 		  	}else if($WorksheetService->farmacia) {
	 		  		$result = $worksheet->isValidPharmacies();
	 		  	}
 		  		if(trim($result) != 'OK') {
		        	$errors = View::make('error', ['error' => $result])->render();
		    		return Response::json(array('success' => false, 'errors' => $errors));	        	
    			}

	        	DB::beginTransaction();	
	        	try{
	        		// Worksheet
	        		$worksheet->fill($data);
	        		$worksheet->porcentaje = $WorksheetService->porcentaje;
	        		$worksheet->descuento = $WorksheetService->descuento;
	        		$worksheet->hora = date('H:m:s');
	        		$worksheet->save();

	        		// Exams
	        		if($WorksheetService->examen) {
		        		$exams = Session::get(Worksheet::$key_cart_exams);   
			        	if(isset($exams) && is_array($exams) && $exams >0) {
				        	foreach ($exams as $exam) {				        	
			 		       		$exam = (object) $exam;

								$worksheetExam = WorksheetExam::find($exam->examen);
					       		if(!$worksheetExam instanceof WorksheetExam) {
									DB::rollback();
									return Response::json(['success' => false, 'errors' => 'Ocurrio un error recuperando informacion de examen $exam->examen  - Consulte al administrador.']);
					       		}

			 		       		$worksheetHasExam = new WorksheetHasExam();
					        	$worksheetHasExam->planilla = $worksheet->id;
					        	$worksheetHasExam->examen = $worksheetExam->id;
					        	$worksheetHasExam->valor = $worksheetExam->valor;
					        	$worksheetHasExam->save();
			 		       	}
		 		       }
		 		  	}else if($WorksheetService->farmacia) {
		 		  		// Pharmacies
		        		$pharmacies = Session::get(Worksheet::$key_cart_pharmacies);   
			        	if(isset($pharmacies) && is_array($pharmacies) && $pharmacies >0) {
				        	foreach ($pharmacies as $pharmacy) {				        	
			 		       		$pharmacy = (object) $pharmacy;

								$worksheetPharmacy = WorksheetPharmacy::find($pharmacy->farmacia);
					       		if(!$worksheetPharmacy instanceof WorksheetPharmacy) {
									DB::rollback();
									return Response::json(['success' => false, 'errors' => 'Ocurrio un error recuperando informacion de farmacia $pharmacy->farmacia  - Consulte al administrador.']);
					       		}

			 		       		$worksheetHasPharmacy = new WorksheetHasPharmacy();
					        	$worksheetHasPharmacy->planilla = $worksheet->id;
					        	$worksheetHasPharmacy->farmacia = $worksheetPharmacy->id;
					        	$worksheetHasPharmacy->unidades = $pharmacy->cantidad;
					        	$worksheetHasPharmacy->valor = $worksheetPharmacy->valor;
					        	$worksheetHasPharmacy->save();
			 		       	}
			 		 	}
		 		  	}

	  				// Elimino datos carritos de session
					Session::forget(Worksheet::$key_cart_exams);
					Session::forget(Worksheet::$key_cart_pharmacies);

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
		if(Request::ajax()) {
			$permission = Worksheet::getPermission();
	        if(@$permission->consulta) {
				$worksheet = Worksheet::select('planilla.*', DB::raw('cliente.cedula as cliente_cedula'), DB::raw('cliente.nombre as cliente_nombre'), DB::raw('servicio.valor as valor_servicio'), DB::raw('servicio.examen as examen'), DB::raw('servicio.farmacia as farmacia'))
					->join('cliente', 'planilla.cliente', '=', 'cliente.id')
					->join('servicio', 'planilla.servicio', '=', 'servicio.id')
        			->where('planilla.id', '=', $id)->first();
				if(!$worksheet instanceof Worksheet) {
					App::abort(404);	
				}
				
				$html = '';
		        // Elimino datos carrito de session
				Session::forget(Worksheet::$key_cart_exams);
				Session::forget(Worksheet::$key_cart_pharmacies);

		        if($worksheet->examen) {
					
					$worksheet->valor_format = 0;
					// Recuperar items examen
			        $arExams = WorksheetHasExam::join('examen', 'planilla_examen.examen', '=', 'examen.id')
			        	->where('planilla', '=', $worksheet->id)->get();
			        foreach ($arExams as $exam) {
			        	$item = [];
			        	$item['_key'] = Worksheet::$key_cart_exams;
			        	$item['_template'] = Worksheet::$template_cart_exams;
						$item['examen'] = $exam->id;
						$item['examen_valor'] = $exam->valor;
						$item['examen_nombre'] = $exam->nombre;
			        	SessionCart::addItem($item);
			        }
			        $html = SessionCart::show(Worksheet::$key_cart_exams, Worksheet::$template_cart_exams);
			   	 
			   	 } else if($worksheet->farmacia) {

			   	 	$worksheet->valor_format = 0;
			   	 	// Recuperar items farmacia
			        $arPharmacies = WorksheetHasPharmacy::join('farmacia', 'planilla_farmacia.farmacia', '=', 'farmacia.id')
			        	->where('planilla', '=', $worksheet->id)->get();
			        foreach ($arPharmacies as $pharmacy) {
			        	$item = [];
			        	$item['_key'] = Worksheet::$key_cart_pharmacies;
			        	$item['_template'] = Worksheet::$template_cart_pharmacies;
						$item['farmacia'] = $pharmacy->id;
						$item['cantidad'] = $pharmacy->unidades;
						$item['farmacia_valor'] = $pharmacy->valor;
						$item['farmacia_nombre'] = $pharmacy->nombre;
			        	SessionCart::addItem($item);
			        }
			        $html = SessionCart::show(Worksheet::$key_cart_pharmacies, Worksheet::$template_cart_pharmacies);
	   	 		}else{
	   	 			// Valor sugerido formateado
					$worksheet->valor_format = number_format($worksheet->valor_servicio, 2,'.',',' );
	   	 		}
				return Response::json(['success' => true, 'worksheet' => $worksheet, 'html' => $html]);
			}else{
	            return View::make('core.denied');   
	        }
       	}
        App::abort(404);
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
    	$date = Input::has('fecha') ? Input::get('fecha') : date('Y-m-d');
		if(Request::ajax() && $date == date('Y-m-d')) {

			$worksheet = Worksheet::find($id);
			if(!$worksheet instanceof Worksheet) {
				App::abort(404);	
			}       
	        $data = Input::all();

	      	if ($worksheet->isValid($data)) {      		        	
	        	$WorksheetService = WorksheetService::find(Input::get('servicio'));
	       		if(!$WorksheetService instanceof WorksheetService){
					return Response::json(['success' => false, 'errors' => 'Ocurrio un error recuperando informacion del servicio - Consulte al administrador.']);
	       		}

	       		// Is valid carritos
	       		$result = 'OK';
	       		if($WorksheetService->examen) {
       				$result = $worksheet->isValidExams();
	 		  	}else if($WorksheetService->farmacia) {
	 		  		$result = $worksheet->isValidPharmacies();
	 		  	}
 		  		if(trim($result) != 'OK') {
		        	$errors = View::make('error', ['error' => $result])->render();
		    		return Response::json(array('success' => false, 'errors' => $errors));	        	
    			}

    			DB::beginTransaction();	
	        	try{
	        		// Worksheet
	        		$worksheet->fill($data);
	        		$worksheet->porcentaje = $WorksheetService->porcentaje;
	        		$worksheet->descuento = $WorksheetService->descuento;
	        		$worksheet->hora = date('H:m:s');
	        		$worksheet->save();

	        		// Elimino items antiguos de examen y farmacia
	        		WorksheetHasExam::where('planilla', $worksheet->id)->delete();
	        		WorksheetHasPharmacy::where('planilla', $worksheet->id)->delete();

	        		// Exams
	        		if($WorksheetService->examen) {
		        		$exams = Session::get(Worksheet::$key_cart_exams);   
			        	if(isset($exams) && is_array($exams) && $exams >0) {
				        	foreach ($exams as $exam) {				        	
			 		       		$exam = (object) $exam;

								$worksheetExam = WorksheetExam::find($exam->examen);
					       		if(!$worksheetExam instanceof WorksheetExam) {
									DB::rollback();
									return Response::json(['success' => false, 'errors' => 'Ocurrio un error recuperando informacion de examen $exam->examen  - Consulte al administrador.']);
					       		}

			 		       		$worksheetHasExam = new WorksheetHasExam();
					        	$worksheetHasExam->planilla = $worksheet->id;
					        	$worksheetHasExam->examen = $worksheetExam->id;
					        	$worksheetHasExam->valor = $worksheetExam->valor;
					        	$worksheetHasExam->save();
			 		       	}
		 		       }
		 		  	}else if($WorksheetService->farmacia) {
		 		  		// Pharmacies
		        		$pharmacies = Session::get(Worksheet::$key_cart_pharmacies);   
			        	if(isset($pharmacies) && is_array($pharmacies) && $pharmacies >0) {
				        	foreach ($pharmacies as $pharmacy) {				        	
			 		       		$pharmacy = (object) $pharmacy;

								$worksheetPharmacy = WorksheetPharmacy::find($pharmacy->farmacia);
					       		if(!$worksheetPharmacy instanceof WorksheetPharmacy) {
									DB::rollback();
									return Response::json(['success' => false, 'errors' => 'Ocurrio un error recuperando informacion de farmacia $pharmacy->farmacia  - Consulte al administrador.']);
					       		}

			 		       		$worksheetHasPharmacy = new WorksheetHasPharmacy();
					        	$worksheetHasPharmacy->planilla = $worksheet->id;
					        	$worksheetHasPharmacy->farmacia = $worksheetPharmacy->id;
					        	$worksheetHasPharmacy->unidades = $pharmacy->cantidad;
					        	$worksheetHasPharmacy->valor = $worksheetPharmacy->valor;
					        	$worksheetHasPharmacy->save();
			 		       	}
			 		 	}
		 		  	}

	  				// Elimino datos carritos de session
					Session::forget(Worksheet::$key_cart_exams);
					Session::forget(Worksheet::$key_cart_pharmacies);

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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Request::ajax()) {
			$permission = Worksheet::getPermission();

			$worksheet = Worksheet::find($id);
			if(!$worksheet instanceof Worksheet) {
				App::abort(404);	
			} 

			if(@$permission->borra && $worksheet->fecha == date('Y-m-d')) {
				DB::beginTransaction();	
	        	try{
					// Elimino items antiguos de examen y farmacia
					WorksheetHasExam::where('planilla', $worksheet->id)->delete();
					WorksheetHasPharmacy::where('planilla', $worksheet->id)->delete();

			        $worksheet->delete();

					DB::commit();
		    		return Response::json(['success' => true]);
	    		}catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
	       	}
        	App::abort(403);
	   	}
        App::abort(404);	
    }
}
