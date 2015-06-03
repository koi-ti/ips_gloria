<table id="table-list-products" class="table table-striped">
	<thead>
		<tr>
			<th><span>&nbsp;</span></th>
			<th>Nombre</th>
			<th>Persona</th>
			<th>Dirección</th>
			<th>Estado</th>
			<th>Ciudad</th>		
			<th>Teléfono</th>		
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
						<td>{{ $item->add_nombre }}</td>
						<td>{{ $item->add_persona }}</td>
						<td>{{ $item->add_direccion }}</td>
						<td>{{ CustomerAddress::$states[$item->add_activo] }}</td>
						<td>{{ $item->add_ciudad_nombre }}</td>
						<td>{{ $item->add_telefono }}</td>
					</tr>
				@endif
			@endforeach
		@else
			<tr>
				<td align="center" colspan="7">No exiten direcciones en el carrito.</td>
			</tr>	
		@endif
	</tbody>
</table> 
