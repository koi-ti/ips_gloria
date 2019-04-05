<table id="table-search-customers" class="table table-striped">
	<thead>
		<tr><th>Fecha</th></tr>	
	</thead>
	<tbody>
		<tr><td>{{ $fecha_inicial_examenes }}</td></tr>
	</tbody>
</table>
	
<div class="table-responsive">
	<table id="table-search-customers" class="table table-striped">
		<thead>
			<tr>
				<th class="text-center" width="80%">Producto</th>
				<th class="text-center" width="20%">Precio</th>
			</tr>	
		</thead>     	    	
		<tbody>
			<?php $total_expense = 0; ?>
			@foreach ($examenes as $expense)
				<tr>
					<td>{{ $expense->nombre }}</td>
					<td class="text-right">{{ number_format($expense->valor, 2,'.',',' ) }}</td>
					<?php 
						$total_expense += $expense->valor;
					?>
				</tr>
			@endforeach
			<tr>
				<th>Total</th>
				<th class="text-right">{{ number_format(($total_expense), 2,'.',',' ) }}</th>
			</tr>
			<?php $gastos = isset($gastos->gastos) ? $gastos->gastos : 0; ?>
			<tr>
				<th>Gastos</th>
				<th class="text-right">{{ number_format(($gastos), 2,'.',',' ) }}</th>
			</tr>
			<tr>
				<th>Total día</th>
				<th class="text-right">{{ number_format(($total_expense - $gastos), 2,'.',',' ) }}</th>
			</tr>	
		</tbody>
	</table>
</div>