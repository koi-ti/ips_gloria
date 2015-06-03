<div align="center">
	{{ $repairers->links() }}
</div>
<div align="center">
	<table id="table-search-roles" class="table table-striped" style="width:80%;">
		@if(count($repairers) > 0)
		<thead>
			<tr>
				<th>Cédula</th>		
				<th>Nombre</th>
				<th>Estado</th>
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($repairers as $repaiman)
				<tr>
					<td>{{ $repaiman->cedula }}</td>
					<td>{{ $repaiman->nombre }}</td>
					<td>{{ $repaiman->states[$repaiman->activo] }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						<a href="{{ route('tecnicos.show', $repaiman->id) }}" class="btn btn-info">Ver</a>
					    @if(@$permission->modifica)
							<a href="{{ route('tecnicos.edit', $repaiman->id) }}" class="btn btn-primary">Editar</a>
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
            window.Misc.pagination('form-search-repairers', 'repairers', $(this).attr('href')); 
			return false;
		});
	});
</script>