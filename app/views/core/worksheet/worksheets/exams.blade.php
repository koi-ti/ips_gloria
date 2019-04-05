<table id="table-list-exams" class="table table-striped center-table" style="width:80%;">
	<thead>
		<tr>
			<th><span>&nbsp;</span></th>
			<th>Exámen</th>
			<th>Valor</th>
		</tr>	
	</thead>     	    	
	<tbody>
		@if(count($list) > 0)
			@foreach ($list as $index => $item)
				{{--*/ $item = (object) $item; /*--}}
				<tr>
					<td align="center" width="10%;">
						@include('/util/list/remove',array('layer' => 'worksheet-list-exams')) 		
					</td>
					<td width="70%;">{{ $item->examen_nombre }}</td>
					<td align="right" width="20%;">${{ number_format($item->examen_valor, 2,'.',',' ) }}</td>
				</tr>
			@endforeach
		@else
			<tr>
				<td align="center" colspan="3">No exiten exámenes en el carrito.</td>
			</tr>	
		@endif
	</tbody>
</table> 
