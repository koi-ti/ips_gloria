<div align="center">
	{{ $roles->links() }}
</div>
<div align="center">
	<table id="table-search-roles" class="table table-striped" style="width:50%;">
		@if(count($roles) > 0)
		<thead>
			<tr>
				<th>Nombre</th>		
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($roles as $rol)
				<tr>
					<td>{{ $rol->nombre }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						<a href="{{ route('roles.show', $rol->id) }}" class="btn btn-info">Ver</a>
					    @if(@$permission->modifica)
							<a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-primary">Editar</a>
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
            window.Misc.pagination('form-search-roles', 'roles', $(this).attr('href')); 
			return false;
		});
	});
</script>