<div align="center">
	{{ $companys->links() }}
</div>
<div align="center">
	<table id="table-search-companys" class="table table-striped" style="width:80%;">
		@if(count($companys) > 0)
		<thead>
			<tr>
				<th>Nit</th>		
				<th>Nombre</th>		
				<th>Estado</th>		
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($companys as $company)
				<tr>
					<td>{{ $company->nit }}</td>
					<td>{{ $company->nombre }}</td>
					<td>{{ Company::$states[$company->activo] }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						<a href="{{ route('empresas.show', $company->id) }}" class="btn btn-info">Ver</a>
					    @if(@$permission->modifica)
							<a href="{{ route('empresas.edit', $company->id) }}" class="btn btn-primary">Editar</a>
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
            window.Misc.pagination('form-search-companys', 'companys', $(this).attr('href')); 
			return false;
		});
	});
</script>