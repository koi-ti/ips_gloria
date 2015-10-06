<div align="center">
	{{ $certificates->links() }}
</div>
<div align="center">
	<table id="table-search-customers" class="table table-striped" style="width:80%;">
		@if(count($certificates) > 0)
		<thead>
			<tr>
				<th>Fecha</th>	
				<th>Cliente</th>	
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($certificates as $certificate)
				<tr>
					<td>{{ $certificate->fecha }}</td>
					<td>{{ $certificate->cliente_nombre }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						<a href="{{ route('certificados.show', $certificate->id) }}" class="btn btn-info">Ver</a>
					    @if(@$permission->modifica)
							<a href="{{ route('certificados.edit', $certificate->id) }}" class="btn btn-primary">Editar</a>
						@endif
						@if(@$permission->consulta)
							<a href="{{ route('certificados.reporte', $certificate->id) }}" class="btn btn-danger" target="_blank">Exportar PDF</a>
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
            window.Misc.pagination('form-search-certificates', 'certificates', $(this).attr('href')); 
			return false;
		});
	});
</script>