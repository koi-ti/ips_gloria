<?php

class ReportesController extends \BaseController {

    /**
     * Instantiate a new CertificatesController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => ['post']));
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $companys = Company::where('activo',true)->lists('nombre', 'id');
		return View::make('core.reports.index', ['companys' => $companys]);
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

	public function acumulados()
	{
		$data = [];
        if(Input::has('empresa_acumulados')) {
			$company = Company::find(Input::get('empresa_acumulados'));		
	        if (!$company instanceof Company) {
	            App::abort(404);   
	        }

	        $data['company'] = $company;
	   	}
        $data['fecha_inicial'] = Input::get('fecha_inicial_acumulados');
        $data['fecha_final'] = Input::get('fecha_final_acumulados');

      	$data['gsanguineo'] = Report::getAcumuladosGSanguineo();
  		$data['lateridad'] = Report::getAcumuladosLateridad();
        $data['users'] = Report::getDataUsers();
        $data['certificate'] = Report::getAcumulados();
        $data['hipertension'] = Report::getAcumuladosHipertension();
        $data['imc'] = Report::getAcumuladosIMC();
		
		if(Input::has('type')){
			switch (Input::get('type')) {
				case 'xls':
					$output = View::make('core.reports.acumuladosxls', $data)->render();
					$headers = array(
				        'Pragma' => 'public',
				        'Expires' => 'public',
				        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
				        'Cache-Control' => 'private',
				        'Content-Type' => 'application/vnd.ms-excel',
				        'Content-Disposition' => 'attachment; filename=ips_acumulados_a_'.date('Y-m-d').'.xls',
				        'Content-Transfer-Encoding' => ' binary'
				    );
					return Response::make($output, 200, $headers);
			}
		}		
		return View::make('core.reports.acumulados', $data);
	}
}
