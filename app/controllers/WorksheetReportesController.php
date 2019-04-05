<?php

class WorksheetReportesController extends \BaseController {

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
		return View::make('core.worksheet.reports.index');
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

	public function resumen()
	{
		$data = [];
        $data['fecha_resumen'] = Input::get('fecha_resumen');
      	$data['servicios'] = WorksheetReport::getServiciosResumen();
      	$data['gastosExamen'] = WorksheetReport::getGastosExamenResumen();
      	$data['gastosFarmacia'] = WorksheetReport::getGastosFarmaciaResumen();
      	$data['gastosGenerales'] = WorksheetReport::getGastosGeneralesResumen();

		if(Input::has('type')) {
			switch (Input::get('type')) {
				case 'xls':
					$output = View::make('core.worksheet.reports.resumenhtml', $data)->render();
					$headers = array(
				        'Pragma' => 'public',
				        'Expires' => 'public',
				        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
				        'Cache-Control' => 'private',
				        'Content-Type' => 'application/vnd.ms-excel',
				        'Content-Disposition' => 'attachment; filename=ips_planilla_resumen_diario_'.Input::get('fecha_inicial_farmacia').'.xls',
				        'Content-Transfer-Encoding' => ' binary'
				    );
					return Response::make($output, 200, $headers);
				break;
			}
		}		
		return View::make('core.worksheet.reports.resumen', $data);
	}

	public function framacia()
	{
		$data = [];
        $data['fecha_inicial_farmacia'] = Input::get('fecha_inicial_farmacia');
      	$data['farmacia'] = WorksheetReport::getVentasFarmacia();
      	$data['gastos'] = WorksheetReport::getGastosFarmacia();

		if(Input::has('type')) {
			switch (Input::get('type')) {
				case 'xls':
					$output = View::make('core.worksheet.reports.farmaciahtml', $data)->render();
					$headers = array(
				        'Pragma' => 'public',
				        'Expires' => 'public',
				        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
				        'Cache-Control' => 'private',
				        'Content-Type' => 'application/vnd.ms-excel',
				        'Content-Disposition' => 'attachment; filename=ips_planilla_ventas_farmacia_'.Input::get('fecha_inicial_farmacia').'.xls',
				        'Content-Transfer-Encoding' => ' binary'
				    );
					return Response::make($output, 200, $headers);
				break;
			}
		}		
		return View::make('core.worksheet.reports.farmacia', $data);
	}

	public function examenes()
	{
		$data = [];
        $data['fecha_inicial_examenes'] = Input::get('fecha_inicial_examenes');
      	$data['examenes'] = WorksheetReport::getVentasExamenes();
      	$data['gastos'] = WorksheetReport::getGastosExamenes();

		if(Input::has('type')) {
			switch (Input::get('type')) {
				case 'xls':
					$output = View::make('core.worksheet.reports.exameneshtml', $data)->render();
					$headers = array(
				        'Pragma' => 'public',
				        'Expires' => 'public',
				        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
				        'Cache-Control' => 'private',
				        'Content-Type' => 'application/vnd.ms-excel',
				        'Content-Disposition' => 'attachment; filename=ips_planilla_ventas_examenes_'.Input::get('fecha_inicial_examenes').'.xls',
				        'Content-Transfer-Encoding' => ' binary'
				    );
					return Response::make($output, 200, $headers);
				break;
			}
		}		
		return View::make('core.worksheet.reports.examenes', $data);
	}
}
