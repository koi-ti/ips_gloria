<div align="center">
	{{ $cities->links() }}
</div>
<div align="center">
	<table id="table-search-cities" class="table table-striped" style="width:50%;">
		<thead>
			<tr>
				<th>Nombre</th>		
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($cities as $city)
				<tr>
					<td>{{ $city->nombre }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						<a href="{{ route('ciudades.show', $city->codigo) }}" class="btn btn-info">Ver</a>
						<a href="{{ route('ciudades.edit', $city->codigo) }}" class="btn btn-primary">Editar</a>
					</td>
				</tr>
			@endforeach	
		</tbody>
	</table> 
</div>
<script type="text/javascript">
	$(document).ready(function(){	
		$(".pagination a").click(function()
		{
            window.Misc.pagination('form-search-cities', 'cities', $(this).attr('href')); 
			return false;
		});
	});
</script>