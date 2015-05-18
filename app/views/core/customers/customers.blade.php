<div align="center">
	{{ $customers->links() }}
</div>
<div align="center">
	<table id="table-search-customers" class="table table-striped" style="width:80%;">
		<thead>
			<tr>
				<th>Cédula</th>		
				<th>Nombre</th>		
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($customers as $customer)
				<tr>
					<td>{{ $customer->nit }}</td>
					<td>{{ $customer->nombre }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						<a href="{{ route('clientes.show', $customer->id) }}" class="btn btn-info">Ver</a>
						<a href="{{ route('clientes.edit', $customer->id) }}" class="btn btn-primary">Editar</a>
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
            window.Misc.pagination('form-search-customers', 'customers', $(this).attr('href')); 
			return false;
		});
	});
</script>