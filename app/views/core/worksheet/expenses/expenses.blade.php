<div align="center">
	{{ $expenses->links() }}
</div>
<div align="center">
	<table id="table-search-companys" class="table table-striped" style="width:30%;">
		@if(count($expenses) > 0)
		<thead>
			<tr>
				<th>Fecha</th>		
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($expenses as $expense)
				<tr>
					<td>{{ $expense->fecha }}</td>
					<td nowrap="nowrap" style="text-align:right">					
					    @if(@$permission->adiciona && $expense->fecha == date('Y-m-d'))
							<a href="{{ route('planilla.gastos.create', ['fecha' => $expense->fecha]) }}" class="btn btn-danger btn-sm">Actualizar gastos</a>
						@else
							<a href="{{ route('planilla.gastos.create', ['fecha' => $expense->fecha]) }}" class="btn btn-primary btn-sm">Consultar</a>
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