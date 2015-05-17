<div align="center">
	{{ $roles->links() }}
</div>
<div align="center">
	<table id="table-search-roles" class="table table-striped" style="width:50%;">
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
						<a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-primary">Editar</a>
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
            window.Misc.pagination('form-search-roles', 'roles', $(this).attr('href')); 
			return false;
		});
	});
</script>