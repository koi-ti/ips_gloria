<?php

class CertificatesController extends \BaseController {

    /**
     * Instantiate a new CertificatesController instance.
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
		$permission = Certificate::getPermission();
        if(@$permission->consulta) {
			$data['certificates'] = $certificates = Certificate::getData();
			if(Request::ajax())
	        {
	            $data["links"] = $certificates->links();
	            $data["permission"] = $permission;
	            $certificates = View::make('core.certificates.certificates', $data)->render();
	            return Response::json(array('html' => $certificates));
	        }

            $data['permission'] = $permission;
            $data['companys'] = Company::where('activo',true)->lists('nombre', 'id');
	        return View::make('core.certificates.index')->with($data);	
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
		$permission = Certificate::getPermission();
        if(@$permission->adiciona) {
			$certificate = new Certificate;

 	        $companys = Company::where('activo',true)->lists('nombre', 'id');

	        return View::make('core.certificates.form')->with(['certificate' => $certificate, 'companys' => $companys]);
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
		    $certificate = new Certificate;
	      	
	      	if ($certificate->isValid($data)){ 

	 	        $object = Certificate::where('fecha', Input::get('fecha'))->where('cliente', Input::get('cliente'))->first();
	 	        if($object instanceof Certificate) {
					return Response::json(array('success' => false, 'errors' =>  '<div class="alert alert-danger">Ya existe un certificado para esta fecha y para este paciente.</div>'));
	 	        }     		        	

	        	DB::beginTransaction();	
	        	try{
	        		$certificate->fill($data);	  
	        		$certificate->booleanStore();
	        		$certificate->multipleStore();
	        		$certificate->save();
	        		
					DB::commit();
					return Response::json(array('success' => true, 'certificate' => $certificate));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
  			}
  			$data['errors'] = $certificate->errors;
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
		$permission = Certificate::getPermission();
        if(@$permission->consulta) {
        	
        	$certificate = Certificate::select('certificado.*', 'cliente.nombre as cliente_nombre', 'cliente.imagen as cliente_imagen', 'empresa.nombre as empresa_nombre')
				->join('cliente', 'certificado.cliente', '=', 'cliente.id')
				->join('empresa', 'certificado.empresa', '=', 'empresa.id')
				->where('certificado.id', '=', $id)
				->first();		
	        if(!$certificate instanceof Certificate) {
				App::abort(404);	
			}

	        return View::make('core.certificates.show')->with(['certificate' => $certificate, 'permission' => $permission]);
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
		$permission = Certificate::getPermission();
        if(@$permission->modifica) {
			$certificate = Certificate::find($id);
			if(!$certificate instanceof Certificate) {
				App::abort(404);	
			}
			
			$customer = Customer::find($certificate->cliente);
			if(!$customer instanceof Customer) {
				App::abort(404);	
			}

 	        $companys = Company::where('activo',true)->lists('nombre', 'id');

	        return View::make('core.certificates.form')->with(['certificate' => $certificate, 'customer' => $customer, 'companys' => $companys]);
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
			$certificate = Certificate::find($id);
			if(!$certificate instanceof Certificate) {
				App::abort(404);	
			}      
	        $data = Input::all();
	      	if ($certificate->isValid($data)){
	       		DB::beginTransaction();	
	        	try{
	        		$certificate->fill($data);	
	        		$certificate->booleanStore();
	        		$certificate->multipleStore();
	        		$certificate->save();
					
					DB::commit();
					return Response::json(array('success' => true, 'certificate' => $certificate));
			    }catch(\Exception $exception){
				    DB::rollback();
					return Response::json(array('success' => false, 'errors' =>  "$exception - Consulte al administrador."));
				}
	        }
  			$data['errors'] = $certificate->errors;
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
	 * Display the reporte resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reporte($id)
	{
		$permission = Certificate::getPermission();
        if(@$permission->consulta) {
        	$certificate = Certificate::find($id);
        	if($certificate instanceof Certificate) {
				$output = Certificate::report($certificate);
				// echo $output;
				return PDF::load($output, 'A4', 'portrait')->show();
        	}
        }else{
            return View::make('core.denied');   
        }
	}
}
