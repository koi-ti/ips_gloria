<div align="center">
	{{ $orders->links() }}
</div>
<table id="table-search-products" class="table table-striped">
	<thead>
		<tr>
			<th>Orden</th>		
			<th>Cliente</th>		
			<th>Técnico</th>		
			<th>Dirección</th>		
			<th>&nbsp;</th>
		</tr>	
	</thead>     	    	
	<tbody>
		@foreach ($orders as $order)
			<tr>
				<td>{{ $order->orden_id }}</td>
				<td>{{ $order->cliente_nombre }}</td>
				<td>{{ $order->tecnico_nombre }}</td>
				<td>{{ $order->cliente_direccion_nombre }}</td>
				<td nowrap="nowrap" style="text-align:right">					
					<a href="{{ route('ordenes.show', $order->id) }}" class="btn btn-info">Ver</a>
					{{-- <a href="{{ route('ordenes.edit', $order->id) }}" class="btn btn-primary">Editar</a> --}}
				</td>
			</tr>
		@endforeach	
	</tbody>
</table> 
<script type="text/javascript">
	$(document).ready(function(){	
		$(".pagination a").click(function()
		{
            window.Misc.pagination('form-search-orders', 'orders', $(this).attr('href')); 
			return false;
		});
	});
</script>