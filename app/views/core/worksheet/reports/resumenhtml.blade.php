<table id="table-search-customers" class="table table-striped">
	<thead>
		<tr><th>Fecha</th></tr>	
	</thead>
	<tbody>
		<tr><td>{{ $fecha_resumen }}</td></tr>
	</tbody>
</table>
	
<div class="table-responsive">
	<table id="table-search-customers" class="table table-striped">
		<thead>
			<tr>
				<th class="text-center" width="40%">Servicio</th>
				<th class="text-center" width="20%">Valor</th>
				<th class="text-center" width="10%">Cantidad</th>
				<th class="text-center" width="10%">% Tercero</th>
				<th class="text-center" width="20%">Descuento</th>
			</tr>	
		</thead>     	    	
		<tbody>
			<?php $total_services = $total_porcentaje = $total_descuento = 0; ?>
			@foreach ($servicios as $service)
				<tr>
					<td>{{ $service->nombre }}</td>
					<td class="text-right">{{ number_format($service->valor, 2,'.',',' ) }}</td>
					<td class="text-center">{{ $service->cantidad }}</td>
					<td class="text-right">{{ number_format($service->porcentaje, 2,'.',',' ) }}</td>
					<td class="text-right">{{ number_format($service->descuento, 2,'.',',' ) }}</td>
					<?php 
						$total_services += $service->valor;
						$total_descuento += $service->descuento;
						$total_porcentaje += $service->porcentaje;
					?>
				</tr>
			@endforeach
				<tr>
					<th>TOTAL INGRESOS</th>
					<th class="text-right">{{ number_format(($total_services), 2,'.',',' ) }}</th>
					<th></th>
					<th class="text-right">{{ number_format(($total_porcentaje), 2,'.',',' ) }}</th>
					<th class="text-right">{{ number_format(($total_descuento), 2,'.',',' ) }}</th>
				</tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr><th colspan="5">GASTOS</th></tr>
				<tr>
					<td>Generales</td>
					<td class="text-right">{{ number_format(isset($gastosGenerales->valor) ? $gastosGenerales->valor : 0, 2,'.',',' ) }}</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>x Farmacia</td>
					<td class="text-right">{{ number_format(isset($gastosFarmacia->valor) ? $gastosFarmacia->valor : 0, 2,'.',',' ) }}</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>x Exámenes</td>
					<td class="text-right">{{ number_format(isset($gastosExamen->valor) ? $gastosExamen->valor : 0, 2,'.',',' ) }}</td>
					<td colspan="3"></td>
				</tr>
				<?php 
					$total_gastos = (isset($gastosGenerales->valor) ? $gastosGenerales->valor : 0) + (isset($gastosExamen->valor) ? $gastosExamen->valor : 0) + (isset($gastosFarmacia->valor) ? $gastosFarmacia->valor : 0);
				?>
				<tr>
					<th>TOTAL GASTOS</th>
					<th class="text-right">{{ number_format($total_gastos , 2,'.',',' ) }}</th>
					<td colspan="3"></td>
				</tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr>
					<th>TOTAL DÍA</th>
					<th class="text-right">{{ number_format($total_services - $total_gastos , 2,'.',',' ) }}</th>
					<td></td>
					<th class="text-right">{{ number_format(($total_porcentaje), 2,'.',',' ) }}</th>
					<th class="text-right">{{ number_format(($total_descuento), 2,'.',',' ) }}</th>
				</tr>
		</tbody>
	</table>
</div>