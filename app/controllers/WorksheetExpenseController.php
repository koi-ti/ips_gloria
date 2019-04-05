<?php

class WorksheetExpenseController extends \BaseController {

    /**
     * Instantiate a new WorksheetExpenseController instance.
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
		$permission = WorksheetExpense::getPermission();
        if(@$permission->consulta) {
			$data['expenses'] = $expenses = WorksheetExpense::getDataDaily();
            $data["permissionExpense"] = $permission;
			if(Request::ajax()) {
	            $data["links"] = $expenses->links();
	            $expenses = View::make('core.worksheet.expenses.expenses', $data)->render();
	            return Response::json(['html' => $expenses]);
	        }

	        return View::make('core.worksheet.expenses.index')->with($data);	
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
		$permission = WorksheetExpense::getPermission();
        if(@$permission->adiciona) {
        	$date = Input::has('fecha') ? Input::get('fecha') : date('Y-m-d');
            $data['date'] = $date;
        	$data['expenses'] = $expenses = WorksheetExpense::getData($date);
            $data["permissionExpense"] = $permission;
			if(Request::ajax()) {
	            $data["links"] = $expenses->links();
	            $expenses = View::make('core.worksheet.expenses.expensesitem', $data)->render();
	            return Response::json(['html' => $expenses]);
	        }

            $data['services'] = WorksheetService::lists('nombre', 'id');
	        return View::make('core.worksheet.expenses.form')->with($data);
		}else{
			return Redirect::route('planilla.gastos.index');
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
		    $expense = new WorksheetExpense;
	      	
	      	if ($expense->isValid($data)){      		        	
	        	DB::beginTransaction();	
	        	try{
	        		$expense->fill($data);
	        		$expense->fecha = date('Y-m-d');
	        		$expense->save();

					DB::commit();
					return Response::json(array('success' => true, 'expense' => $expense));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $expense->errors;
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
			$permission = WorksheetExpense::getPermission();
	        if(@$permission->consulta) {
				$expense = WorksheetExpense::find($id);
				if(!$expense instanceof WorksheetExpense) {
					App::abort(404);	
				}
				return Response::json(['success' => true, 'expense' => $expense]);
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
		if(Request::ajax()) {
			$permission = WorksheetExpense::getPermission();
	        if(@$permission->modifica) {
				$expense = WorksheetExpense::find($id);
				if(!$expense instanceof WorksheetExpense) {
					App::abort(404);	
				}

			}else{
	            return View::make('core.denied');   
	        }
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
			$permission = WorksheetExpense::getPermission();

			$expense = WorksheetExpense::find($id);
			if(!$expense instanceof WorksheetExpense) {
				App::abort(404);	
			}       

			if(@$permission->modifica && $expense->fecha == date('Y-m-d')) {
		        $data = Input::all();
		      	if ($expense->isValid($data)){      		        	
		       		DB::beginTransaction();	
		        	try{
		        		$expense->fill($data);	
		        		$expense->save();
						DB::commit();
						return Response::json(array('success' => true, 'expense' => $expense));
				    }catch(\Exception $exception){
					    DB::rollback();
						return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
					}
		        }
	  			$data['errors'] = $expense->errors;
	        	$errors = View::make('errors', $data)->render();
	    		return Response::json(array('success' => false, 'errors' => $errors));
			}
        	App::abort(403);
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
			$permission = WorksheetExpense::getPermission();

			$expense = WorksheetExpense::find($id);
			if(!$expense instanceof WorksheetExpense) {
				App::abort(404);	
			} 

			if(@$permission->borra && $expense->fecha == date('Y-m-d')) {
		        $expense->delete();
	    		return Response::json(['success' => true]);
	       	}
        	App::abort(403);
	   	}
        App::abort(404);
	}


}
