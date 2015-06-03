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
				<td><a href="#" id="set_customer_{{ $customer->nit }}">{{ $customer->nit }}</a></td>
				<td>{{ $customer->nombre }}</td>
			</tr>
			<script type="text/javascript">
				$(document).ready(function(){	
					$("#set_customer_{{ $customer->nit }}").click(function()
					{
						$("#cliente_nit").val("{{ $customer->nit }}");
						$("#cliente_nombre").val("{{ $customer->nombre }}");
						$("#cliente").val("{{ $customer->id }}");
						window.Misc.searchCustomerAddress("{{ $customer->id }}");
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