<div align="center">
	{{ $expenses->links() }}
</div>
<div align="center">
	<table id="table-search-companys" class="table table-striped" style="width:80%;">
		@if(count($expenses) > 0)
		<thead>
			<tr>
				<th>Nombre</th>		
				<th>Fecha</th>		
				<th>Valor</th>		
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($expenses as $expense)
				<tr>
					<td>{{ $expense->nombre }}</td>
					<td>{{ $expense->fecha }}</td>
					<td align="right">${{ number_format($expense->valor, 2,'.',',' ) }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						<a href="{{ route('planilla.gastos.show', $expense->id) }}" class="btn btn-info">Ver</a>
					    @if(@$permission->modifica)
							<a href="{{ route('planilla.gastos.edit', $expense->id) }}" class="btn btn-primary">Editar</a>
						@endif
					</td>
				</tr>
			@endforeach	
		</tbody>
		@else
			<tr><td align="center">No hay ningún resultado que coincida con la búsqueda.</td></tr>
		@endif
	</table> 
</div>
<script type="text/javascript">
	$(document).ready(function(){	
		$(".pagination a").click(function()
		{
            window.Misc.pagination('form-search-expense', 'expenses', $(this).attr('href')); 
			return false;
		});
	});
</script>