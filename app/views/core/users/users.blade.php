<div align="center">
	{{ $users->links() }}
</div>
<table id="table-search-users" class="table table-striped">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Email</th>
			<th>Estado</th>
			<th>&nbsp;</th>
		</tr>	
	</thead>     	    	
	<tbody>
		@foreach ($users as $user)
			<tr>
				<td>{{ $user->nombre }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->states[$user->activo] }}</td>
				<td nowrap="nowrap">					
					<a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-info">Ver</a>
				    @if(@$permission->modifica)
						<a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-primary">Editar</a>					
					@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table> 

<script type="text/javascript">
	$(document).ready(function(){	
		$(".pagination a").click(function()
		{
			var url = $(this).attr('href');						
			$.ajax({
				url: url,
				type: "GET",
				datatype: "html",
				beforeSend: function() {
					$('#loading-app').modal('show');
				}
			})
			.done(function(data) {				
				$('#loading-app').modal('hide');
				$("#users").empty().html(data.html);
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
				$('#loading-app').modal('hide');
				$('#error-app').modal('show');
				$("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");				
			});
			return false;
		});
	});
</script>		