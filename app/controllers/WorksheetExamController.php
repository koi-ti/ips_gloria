<?php

class WorksheetExamController extends \BaseController {

	/**
     * Instantiate a new WorksheetExamController instance.
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
		$permission = WorksheetExam::getPermission();
        if(@$permission->consulta) {
			$data['exams'] = $exams = WorksheetExam::getData();
			if(Request::ajax()) {
	            $data["links"] = $exams->links();
	            $data["permission"] = $permission;
	            $exams = View::make('core.worksheet.exams.exams', $data)->render();
	            return Response::json(['html' => $exams]);
	        }

            $data['permission'] = $permission;
	        return View::make('core.worksheet.exams.index')->with($data);	
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
		$permission = WorksheetExam::getPermission();
        if(@$permission->adiciona) {
			$exam = new WorksheetExam;

	        return View::make('core.worksheet.exams.form')->with(['exam' => $exam]);
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
		    $exam = new WorksheetExam;
	      	
	      	if ($exam->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$exam->fill($data);
	        		$exam->save();

					DB::commit();
					return Response::json(array('success' => true, 'exam' => $exam));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $exam->errors;
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
		$exam = WorksheetExam::find($id);
		if(!$exam instanceof WorksheetExam) {
			App::abort(404);	
		}

		if(Request::ajax()) {
			return Response::json(['success' => true, 'valor' => $exam->valor, 'nombre' => $exam->nombre]);
		}

		$permission = WorksheetExam::getPermission();
        if(@$permission->consulta) {
	        return View::make('core.worksheet.exams.show')->with(['exam' => $exam, 'permission' => $permission]);
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
		$permission = WorksheetExam::getPermission();
        if(@$permission->modifica) {
			$exam = WorksheetExam::find($id);
			if(!$exam instanceof WorksheetExam) {
				App::abort(404);	
			}
			
	        return View::make('core.worksheet.exams.form')->with(['exam' => $exam]);
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
			$exam = WorksheetExam::find($id);
			if(!$exam instanceof WorksheetExam) {
				App::abort(404);	
			}       
	        $data = Input::all();
	      	if ($exam->isValid($data)){      		        	
	       		DB::beginTransaction();	
	        	try{
	        		$exam->fill($data);	
	        		$exam->save();
					DB::commit();
					return Response::json(array('success' => true, 'exam' => $exam));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
	        }
  			$data['errors'] = $exam->errors;
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
