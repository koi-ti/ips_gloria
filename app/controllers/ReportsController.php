<?php

class ReportsController extends \BaseController {

    /**
     * Instantiate a new ReportsController instance.
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
		return View::make('core.reports.index');
	}


	/**
	 * Show the report ordenes.
	 *
	 * @return Response
	 */
	public function ordenes()
	{
		$query_ordenes = "SELECT ord.*, cld.nombre as cliente_direccion,  us.nombre as usuario_nombre,
			cl.nit as cliente_nit, cl.nombre as cliente_nombre,
			te.cedula as tecnico_cedula , te.nombre as tecnico_nombre
		FROM orden as ord
		INNER JOIN usuario AS us ON ord.usuario_elaboro = us.id
		INNER JOIN cliente AS cl ON ord.cliente = cl.id
		INNER JOIN cliente_direccion AS cld ON ord.cliente_direccion = cld.id
		INNER JOIN tecnico AS te ON ord.tecnico = te.id
		WHERE
		ord.fecha_elaboro BETWEEN '".Input::get("fecha_inicial_ordenes")." 00:00:00' AND '".Input::get("fecha_final_ordenes")." 23:59:59'";	

		$query_ordenes.= " ORDER BY ord.fecha_elaboro DESC";
		$ordenes = DB::select($query_ordenes);

		$output = '
		<table>
            <thead>
	            <tr>
					<td colspan="10">Security Access :: Ordenes de Servicio a '.date("Y-m-d H:i:s").' por periodo ('.Input::get("fecha_inicial_ordenes").' - '.Input::get("fecha_final_ordenes").')</td>
	            </tr>
			    <tr>
			        <th>Numero</th>
			        <th>Cliente</th>
			        <th>Nombre</th>
			        <th>Dirección</th>
			        <th>Técnico</th>
			        <th>Nombre</th>
			        <th>Llamo</th>
			        <th>Daño</th>
			        <th>Factura</th>
			        <th>Fecha</th>
			    	<th>Usuario</th>
			    	<th>Cerrada</th>
			    </tr>
			</thead>
			<tbody>';

		foreach ($ordenes as $orden) {
			$orden = (array) $orden;
			$output.='
		    <tr>
		        <td>'.$orden['id'].'</td>
		        <td>'.$orden['cliente_nit'].'</td>
		        <td>'.$orden['cliente_nombre'].'</td>
		        <td>'.$orden['cliente_direccion'].'</td>
		        <td>'.$orden['tecnico_cedula'].'</td>
		        <td>'.$orden['tecnico_nombre'].'</td>
		        <td>'.$orden['llamo'].'</td>
		        <td>'.$orden['dano'].'</td>
		        <td>'.($orden['factura'] ? 'SI' : 'NO').'</td>
		        <td>'.$orden['fecha_elaboro'].'</td>
		        <td>'.$orden['usuario_nombre'].'</td>
		        <td>'.($orden['cerrada'] ? 'SI' : 'NO').'</td>'
		    .'</tr>';
		}

		$output.='
			</tbody>
		</table>';

	    $headers = array(
	        'Pragma' => 'public',
	        'Expires' => 'public',
	        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
	        'Cache-Control' => 'private',
	        'Content-Type' => 'application/vnd.ms-excel',
	        'Content-Disposition' => 'attachment; filename=security_access_ordenes_servicio_'.date('Y-m-d').'.xls',
	        'Content-Transfer-Encoding' => ' binary'
	    );
		return Response::make($output, 200, $headers);
	}

	/**
	 * Show the report ordenessinvisitas.
	 *
	 * @return Response
	 */
	public function ordenessinvisitas()
	{
		$query_ordenes = "SELECT ord.*, cld.nombre as cliente_direccion,  us.nombre as usuario_nombre,
			cl.nit as cliente_nit, cl.nombre as cliente_nombre,
			te.cedula as tecnico_cedula , te.nombre as tecnico_nombre
		FROM orden as ord
		LEFT JOIN visita AS vs ON ord.id = vs.orden AND vs.deleted_at IS NULL
		INNER JOIN usuario AS us ON ord.usuario_elaboro = us.id
		INNER JOIN cliente AS cl ON ord.cliente = cl.id
		INNER JOIN cliente_direccion AS cld ON ord.cliente_direccion = cld.id
		INNER JOIN tecnico AS te ON ord.tecnico = te.id
		WHERE
		vs.id IS NULL
		AND
		ord.fecha_elaboro BETWEEN '".Input::get("fecha_inicial_osinvisitas")." 00:00:00' AND '".Input::get("fecha_final_osinvisitas")." 23:59:59'";	

		$query_ordenes.= " ORDER BY ord.fecha_elaboro DESC";
		$ordenes = DB::select($query_ordenes);

		$output = '
		<table>
            <thead>
	            <tr>
					<td colspan="10">Security Access :: Ordenes de Servicio Sin Visitas a '.date("Y-m-d H:i:s").' por periodo ('.Input::get("fecha_inicial_osinvisitas").' - '.Input::get("fecha_final_osinvisitas").')</td>
	            </tr>
			    <tr>
			        <th>Numero</th>
			        <th>Cliente</th>
			        <th>Nombre</th>
			        <th>Dirección</th>
			        <th>Técnico</th>
			        <th>Nombre</th>
			        <th>Llamo</th>
			        <th>Daño</th>
			        <th>Fecha</th>
			    	<th>Usuario</th>
			    </tr>
			</thead>
			<tbody>';

		foreach ($ordenes as $orden) {
			$orden = (array) $orden;
			$output.='
		    <tr>
		        <td>'.$orden['id'].'</td>
		        <td>'.$orden['cliente_nit'].'</td>
		        <td>'.$orden['cliente_nombre'].'</td>
		        <td>'.$orden['cliente_direccion'].'</td>
		        <td>'.$orden['tecnico_cedula'].'</td>
		        <td>'.$orden['tecnico_nombre'].'</td>
		        <td>'.$orden['llamo'].'</td>
		        <td>'.$orden['dano'].'</td>
		        <td>'.$orden['fecha_elaboro'].'</td>
		        <td>'.$orden['usuario_nombre'].'</td>'
		    .'</tr>';
		}

		$output.='
			</tbody>
		</table>';

	    $headers = array(
	        'Pragma' => 'public',
	        'Expires' => 'public',
	        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
	        'Cache-Control' => 'private',
	        'Content-Type' => 'application/vnd.ms-excel',
	        'Content-Disposition' => 'attachment; filename=security_access_ordenes_sin_visitas_'.date('Y-m-d').'.xls',
	        'Content-Transfer-Encoding' => ' binary'
	    );
		return Response::make($output, 200, $headers);
	}

	/**
	 * Show the report ordenesabiertas.
	 *
	 * @return Response
	 */
	public function ordenesabiertas()
	{
		$query_ordenes = "SELECT ord.*, cld.nombre as cliente_direccion,  us.nombre as usuario_nombre,
			cl.nit as cliente_nit, cl.nombre as cliente_nombre,
			te.cedula as tecnico_cedula , te.nombre as tecnico_nombre
		FROM orden as ord
		INNER JOIN usuario AS us ON ord.usuario_elaboro = us.id
		INNER JOIN cliente AS cl ON ord.cliente = cl.id
		INNER JOIN cliente_direccion AS cld ON ord.cliente_direccion = cld.id
		INNER JOIN tecnico AS te ON ord.tecnico = te.id
		WHERE
		ord.cerrada = false
		AND
		ord.fecha_elaboro BETWEEN '".Input::get("fecha_inicial_oabiertas")." 00:00:00' AND '".Input::get("fecha_final_oabiertas")." 23:59:59'";	

		$cliente = '';
		if(Input::has('cliente') && Input::get('cliente') != '0') {
			$query_ordenes.= " AND ord.cliente = '".Input::get('cliente')."'";
			$cliente = ' Cliente '.utf8_decode(Input::get('cliente_nombre'));
			if(Input::has('cliente_direccion') && Input::get('cliente_direccion') != '0') {
				$query_ordenes.= " AND ord.cliente_direccion = '".Input::get('cliente_direccion')."'";
			}
		}

		$query_ordenes.= " ORDER BY ord.fecha_elaboro DESC";
		$ordenes = DB::select($query_ordenes);

		$output = '
		<table>
            <thead>
	            <tr>
					<td colspan="10">Security Access :: Ordenes de Servicio Abiertas a '.date("Y-m-d H:i:s").' por periodo ('.Input::get("fecha_inicial_oabiertas").' - '.Input::get("fecha_final_oabiertas").') '.$cliente.'</td>
	            </tr>
			    <tr>
			        <th>Numero</th>
			        <th>Cliente</th>
			        <th>Nombre</th>
			        <th>Dirección</th>
			        <th>Técnico</th>
			        <th>Nombre</th>
			        <th>Llamo</th>
			        <th>Daño</th>
			        <th>Fecha</th>
			    	<th>Usuario</th>
			    </tr>
			</thead>
			<tbody>';

		foreach ($ordenes as $orden) {
			$orden = (array) $orden;
			$output.='
		    <tr>
		        <td>'.$orden['id'].'</td>
		        <td>'.$orden['cliente_nit'].'</td>
		        <td>'.$orden['cliente_nombre'].'</td>
		        <td>'.$orden['cliente_direccion'].'</td>
		        <td>'.$orden['tecnico_cedula'].'</td>
		        <td>'.$orden['tecnico_nombre'].'</td>
		        <td>'.$orden['llamo'].'</td>
		        <td>'.$orden['dano'].'</td>
		        <td>'.$orden['fecha_elaboro'].'</td>
		        <td>'.$orden['usuario_nombre'].'</td>'
		    .'</tr>';

		 	$query_visitas = "SELECT vis.*, te.cedula as tecnico_cedula , te.nombre as tecnico_nombre
				FROM visita AS vis
				INNER JOIN tecnico AS te ON vis.tecnico = te.id
				WHERE
				vis.deleted_at IS NULL
				ORDER BY vis.id DESC"; 
				$visitas = DB::select($query_visitas); 

				if(count($visitas) > 0){
					$output.='<tr><td colspan="10" align="center"><table>';
					foreach ($visitas as $visita) {
						$visita = (array) $visita; 
						$output.='
						    <tr>
						        <td>'.$visita['tecnico_nombre'].'</td>
						        <td>'.$visita['fecha_inicio'].'</td>
						        <td>'.$visita['fecha_final'].'</td>
						        <td>'.$visita['observaciones'].'</td>
						        <td>'.$visita['pendientes'].'</td>'
						    .'</tr>';
					}
					$output.='</table></td></tr>';
				}
		}

		$output.='
			</tbody>
		</table>';

	    $headers = array(
	        'Pragma' => 'public',
	        'Expires' => 'public',
	        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
	        'Cache-Control' => 'private',
	        'Content-Type' => 'application/vnd.ms-excel',
	        'Content-Disposition' => 'attachment; filename=security_access_ordenes_abiertas_'.date('Y-m-d').'.xls',
	        'Content-Transfer-Encoding' => ' binary'
	    );
		return Response::make($output, 200, $headers);
	}
}
