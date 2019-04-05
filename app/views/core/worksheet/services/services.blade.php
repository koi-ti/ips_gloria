<div align="center">
	{{ $services->links() }}
</div>
<div align="center">
	<table id="table-search-companys" class="table table-striped" style="width:80%;">
		@if(count($services) > 0)
		<thead>
			<tr>
				<th>Nombre</th>		
				<th>Porcentaje</th>		
				<th>Valor</th>		
				<th>Descuento</th>		
				<th>Exámen</th>		
				<th>Farmacia</th>		
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($services as $service)
				<tr>
					<td>{{ $service->nombre }}</td>
					<td>{{ $service->porcentaje }}%</td>
					<td align="right">${{ number_format($service->valor, 2,'.',',' ) }}</td>
					<td align="right">${{ number_format($service->descuento, 2,'.',',' ) }}</td>
					<td align="center">{{ $service->examen ? 'SI' : 'NO' }}</td>
					<td align="center">{{ $service->farmacia ? 'SI' : 'NO' }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						<a href="{{ route('planilla.servicios.show', $service->id) }}" class="btn btn-info">Ver</a>
					    @if(@$permission->modifica)
							<a href="{{ route('planilla.servicios.edit', $service->id) }}" class="btn btn-primary">Editar</a>
						@endif
					</td>
				</tr>
			@endforeach	
		</tbody>
		@else
			<tr><td align="center">No hay ningún resultado que coincida con la búsqueda.</td></tr>
		@endif
	</table> 
</div>
<script type="text/javascript">
	$(document).ready(function(){	
		$(".pagination a").click(function()
		{
            window.Misc.pagination('form-search-service', 'services', $(this).attr('href')); 
			return false;
		});
	});
</script>