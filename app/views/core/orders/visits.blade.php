<table id="table-list-visits" class="table table-striped">
	<thead>
		<tr>
			<th><span>&nbsp;</span></th>
			<th>Técnico</th>
			<th>Fecha inicial</th>
			<th>Fecha final</th>
			<th>Observaciones</th>
			<th>Pendientes</th>		
		</tr>	
	</thead>     	    	
	<tbody>
		@if(count($list) > 0)
			@foreach ($list as $index => $item)
				{{--*/ $item = (object) $item; /*--}}
				@if(@$item->_delete != 'delete')
					<tr>
						<td align="center" width="20%;">
							@include('/util/list/remove',array('layer' => $item->_layer)) 		
						</td>
						<td>{{ $item->vis_tecnico_nombre }}</td>
						<td>{{ $item->vis_fecha_inicial }}</td>
						<td>{{ $item->vis_fecha_final }}</td>
						<td>{{ $item->vis_observaciones }}</td>
						<td>{{ $item->vis_pendientes }}</td>
					</tr>
				@endif
			@endforeach
		@else
			<tr>
				<td align="center" colspan="7">No exiten visitas en el carrito.</td>
			</tr>	
		@endif
	</tbody>
</table> 
