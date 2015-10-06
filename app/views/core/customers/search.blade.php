<table class="table table-striped table-bordered table-hover table-condensed" style="width:70%;">
	@if(count($customers) > 0)
	<thead>
		<tr>
			<th>Cédula</th>		
			<th>Nombre</th>		
		</tr>	
	</thead>     	    	
	<tbody>
		@foreach ($customers as $customer)
			<tr>
				<td><a href="#" id="set_customer_{{ $customer->cedula }}">{{ $customer->cedula }}</a></td>
				<td>{{ $customer->nombre }}</td>
			</tr>
			<script type="text/javascript">
				$(document).ready(function(){	
					$("#set_customer_{{ $customer->cedula }}").click(function()
					{
						$("#cliente_cedula").val("{{ $customer->cedula }}");
						$("#cliente_nombre").val("{{ $customer->nombre }}");
						$("#cliente_imagen").attr("src", "{{ $customer->imagen ? URL::asset($customer->imagen) : URL::asset('images/default-avatar.png') }}")
						$("#cliente").val("{{ $customer->id }}");
						$('#customers').empty();
						return false;
					});
				});
			</script>
		@endforeach	
	</tbody>
	@else
		<tr><td align="center">No hay ningún resultado que coincida con la búsqueda.</td></tr>
	@endif
</table> 