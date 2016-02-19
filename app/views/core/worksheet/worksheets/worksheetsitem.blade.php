<div align="center">
	{{ $worksheets->links() }}
</div>
<div align="center">
	<table id="table-search-worksheets-item" class="table table-striped" style="width:90%;">
		@if(count($worksheets) > 0)
		<thead>
			<tr>
				<th>Hora</th>		
				<th>Paciente</th>		
				<th>Servicio</th>
				<th>Exámen</th>		
				<th>Valor</th>		
				<th>Factura</th>		
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($worksheets as $worksheet)
				<tr>
					<td>{{ $worksheet->hora }}</td>
					<td>{{ $worksheet->cliente }}</td>
					<td>{{ $worksheet->servicio }}</td>
					<td>{{ $worksheet->examen ?: '' }}</td>
					<td align="right">${{ number_format($worksheet->valor, 2,'.',',' ) }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						<a href="#" class="btn btn-info">Factura</a>
					</td>
				</tr>
			@endforeach	
		</tbody>
		@else
			<tr><td align="center">No hay ningún item registrado para esta planilla.</td></tr>
		@endif
	</table> 
</div>
<script type="text/javascript">
	$(document).ready(function(){	
		$(".pagination a").click(function()
		{
            window.Misc.pagination('form-search-worksheet-daily', 'worksheets-daily', $(this).attr('href')); 
			return false;
		});
	});
</script>