<div align="center">
	{{ $orders->links() }}
</div>
<table id="table-search-products" class="table table-striped">
	@if(count($orders) > 0)	
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
				<td @if($order->cerrada) style="background-color: #FA5858;" @endif >{{ $order->orden_id }}</td>
				<td>{{ $order->cliente_nombre }}</td>
				<td>{{ $order->tecnico_nombre }}</td>
				<td>{{ $order->cliente_direccion_nombre }}</td>
				<td nowrap="nowrap" style="text-align:right">					
					<a href="{{ route('ordenes.show', $order->orden_id) }}" class="btn btn-info">Ver</a>
				    @if(@$permission->modifica)
				    	@if(!$order->cerrada)
							<a href="{{ route('ordenes.edit', $order->orden_id) }}" class="btn btn-primary">Editar</a>
						@endif	
					@endif
				</td>
			</tr>
		@endforeach	
	</tbody>
	@else
		<tr><td align="center">No hay ningún resultado que coincida con la búsqueda.</td></tr>
	@endif
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