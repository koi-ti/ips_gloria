<div align="center">
	{{ $worksheets->links() }}
</div>
<div align="center">
	<table id="table-search-worksheets" class="table table-striped" style="width:30%;">
		@if(count($worksheets) > 0)
		<thead>
			<tr>
				<th>Fecha</th>		
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($worksheets as $worksheet)
				<tr>
					<td>{{ $worksheet->fecha }}</td>
					<td nowrap="nowrap" style="text-align:right">					
					    @if(@$permission->adiciona && $worksheet->fecha == date('Y-m-d'))
							<a href="{{ route('planilla.planillas.create', ['fecha' => $worksheet->fecha]) }}" class="btn btn-danger btn-sm">Nuevo registro</a>
						@else
							<a href="{{ route('planilla.planillas.create', ['fecha' => $worksheet->fecha]) }}" class="btn btn-primary btn-sm">Consultar</a>
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
            window.Misc.pagination('form-search-worksheet', 'worksheets', $(this).attr('href')); 
			return false;
		});
	});
</script>