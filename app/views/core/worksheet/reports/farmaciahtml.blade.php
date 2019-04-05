<table id="table-search-customers" class="table table-striped">
	<thead>
		<tr><th>Fecha</th></tr>	
	</thead>
	<tbody>
		<tr><td>{{ $fecha_inicial_farmacia }}</td></tr>
	</tbody>
</table>
	
<div class="table-responsive">
	<table id="table-search-customers" class="table table-striped">
		<thead>
			<tr>
				<th class="text-center" width="45%">Producto</th>
				<th class="text-center" width="15%">Cantidad</th>
				<th class="text-center" width="20%">Precio</th>
				<th class="text-center" width="20%">Total</th>
			</tr>	
		</thead>     	    	
		<tbody>
			<?php $total_pharmacy = 0; ?>
			@foreach ($farmacia as $pharmacy)
				<tr>
					<td>{{ $pharmacy->nombre }}</td>
					<td class="text-center">{{ $pharmacy->unidades }}</td>
					<td class="text-right">{{ number_format($pharmacy->valor, 2,'.',',' ) }}</td>
					<?php 
						$total = $pharmacy->unidades * $pharmacy->valor;
						$total_pharmacy += $total;
					?>
					<td class="text-right">{{ number_format(($total), 2,'.',',' ) }}</td>
				</tr>
			@endforeach
			<tr>
				<th>Total</th>
				<th class="text-right" colspan="3">{{ number_format(($total_pharmacy), 2,'.',',' ) }}</th>
			</tr>
			<?php $gastos = isset($gastos->gastos) ? $gastos->gastos : 0; ?>
			<tr>
				<th>Gastos</th>
				<th class="text-right" colspan="3">{{ number_format(($gastos), 2,'.',',' ) }}</th>
			</tr>
			<tr>
				<th>Total día</th>
				<th class="text-right" colspan="3">{{ number_format(($total_pharmacy - $gastos), 2,'.',',' ) }}</th>
			</tr>	
		</tbody>
	</table>
</div>