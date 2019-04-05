<table id="table-list-pharmacies" class="table table-striped">
	<thead>
		<tr>
			<th><span>&nbsp;</span></th>
			<th>Farmacia</th>
			<th>Cantidad</th>		
			<th>V. Unitario</th>		
			<th>V. Todal</th>		
		</tr>	
	</thead>     	    	
	<tbody>
		@if(count($list) > 0)
			@foreach ($list as $index => $item)
				{{--*/ $item = (object) $item; /*--}}
				{{--*/ $valor = $item->farmacia_valor?:0; /*--}}
				<tr>
					<td align="center" width="10%;">
						@include('/util/list/remove',array('layer' => 'worksheet-list-pharmacies')) 		
					</td>
					<td width="50%;">{{ $item->farmacia_nombre }}</td>
					<td align="center" width="10%;">{{ $item->cantidad }}</td>
					<td align="right" width="15%;">${{ number_format($valor, 2,'.',',' ) }}</td>
					<td align="right" width="15%;">${{ number_format(($valor * $item->cantidad), 2,'.',',' ) }}</td>
				</tr>
			@endforeach
		@else
			<tr>
				<td align="center" colspan="5">No exiten productos en el carrito.</td>
			</tr>	
		@endif
	</tbody>
</table> 
