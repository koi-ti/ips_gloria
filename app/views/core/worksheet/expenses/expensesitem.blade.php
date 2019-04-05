<div align="center">
	{{--*/ $expenses->setBaseUrl(URL::route('planilla.gastos.create')); /*--}}
	{{ $expenses->links() }}
</div>
<div align="center">
	<table id="table-search-companys" class="table table-striped" style="width:90%;">
		@if(count($expenses) > 0)
		<thead>
			<tr>
				<th>Descripción</th>		
				<th>Servicio</th>		
				<th>Valor</th>		
				<th>&nbsp;</th>
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($expenses as $expense)
				<tr>
					<td>{{ $expense->gasto }}</td>
					<td>{{ $expense->servicio }}</td>
					<td align="right">${{ number_format($expense->valor, 2,'.',',' ) }}</td>
					<td nowrap="nowrap" style="text-align:right">	
					    @if(@$permissionExpense->modifica && $date == date('Y-m-d'))				
			            	<a href="{{ route('planilla.gastos.update', $expense->id) }}" data-item="{{ $expense->id }}" class="btn btn-success button-edit-expense btn-sm">Editar</a>
						@endif
						@if(@$permissionExpense->borra && $date == date('Y-m-d'))				
			            	<a href="{{ route('planilla.gastos.destroy', $expense->id) }}" class="btn btn-danger button-destroy-expense btn-sm">Eliminar</a>        
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
		$("#expenses-daily .pagination a").off();
		$("#expenses-daily .pagination a").click(function()
		{
            window.Misc.pagination('form-search-expenses-daily', 'expenses-daily', $(this).attr('href')); 
			return false;
		});

		// Button edit
        $(".button-edit-expense").click(function(event) {
            event.preventDefault();

            $("#form-add-expense").attr("method", "PATCH");
            $("#form-add-expense").attr("action", $(this).attr('href'));

            var item = $(this).data( "item" );
            $.ajax({
                type: 'GET',
                cache: false,
                dataType: 'json',
                url : document.url + '/planilla/gastos/' + item,
                success: function(data) {
                    if(data.success == true) {
						// Set data
						$('#form-add-expense').find('input[id="nombre"]').val(data.expense.nombre);
						$('#form-add-expense').find('input[id="valor"]').val(data.expense.valor);
						$('#form-add-expense').find('select[id="servicio"]').val(data.expense.servicio ? data.expense.servicio: '');

                        // Open modal
                        $('#modal-expense').modal('show');
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    $('#error-app').modal('show');
                    $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
                }
            });
        });
		
		// Button destroy
		$(".button-destroy-expense").click(function(event) {
            event.preventDefault();

            $("#form-destroy-expense").attr("action", $(this).attr('href'));
            $('#modal-confirm').modal('show');
       	});
	});
</script>