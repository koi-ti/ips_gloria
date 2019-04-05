<div align="center">
	{{ $pharmacies->links() }}
</div>
<div align="center">
	<table id="table-search-exams" class="table table-striped" style="width:80%;">
		@if(count($pharmacies) > 0)
		<thead>
			<tr>
				<th>Nombre</th>		
				<th>Valor</th>		
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($pharmacies as $pharmacy)
				<tr>
					<td>{{ $pharmacy->nombre }}</td>
					<td align="right">${{ number_format($pharmacy->valor, 2,'.',',' ) }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						<a href="{{ route('planilla.farmacia.show', $pharmacy->id) }}" class="btn btn-info">Ver</a>
					    @if(@$permission->modifica)
							<a href="{{ route('planilla.farmacia.edit', $pharmacy->id) }}" class="btn btn-primary">Editar</a>
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
            window.Misc.pagination('form-search-pharmacies', 'pharmacies', $(this).attr('href')); 
			return false;
		});
	});
</script>