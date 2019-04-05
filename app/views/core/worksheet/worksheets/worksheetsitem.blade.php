<div align="center">
	{{--*/ $worksheets->setBaseUrl(URL::route('planilla.planillas.create')); /*--}}
	{{ $worksheets->links() }}
</div>
<div align="center">
	<table id="table-search-worksheets-item" class="table table-striped" style="width:90%;">
		@if(count($worksheets) > 0)
		<thead>
			<tr>
				<th>Hora</th>		
				<th>Paciente</th>		
				<th>Servicio</th>
				<th>Valor</th>		
				<th>Factura</th>		
			</tr>	
		</thead>     	    	
		<tbody>
			@foreach ($worksheets as $worksheet)
				<tr>
					<td>{{ $permission->modifica }}</td>
					<td>{{ $worksheet->hora }}</td>
					<td>{{ $worksheet->cliente }}</td>
					<td>{{ $worksheet->servicio }}</td>
					<td align="right">${{ number_format($worksheet->valor, 2,'.',',' ) }}</td>
					<td nowrap="nowrap" style="text-align:right">					
						{{-- <a href="#" class="btn btn-info btn-sm">Factura</a> --}}
					    @if(@$permission->modifica && $worksheet->fecha == date('Y-m-d'))				
							<a href="{{ route('planilla.planillas.update', $worksheet->id) }}" data-item="{{ $worksheet->id }}" class="btn btn-success button-edit-worksheet btn-sm">Editar</a>
						@endif
						@if(@$permission->borra && $worksheet->fecha == date('Y-m-d'))
							<a href="{{ route('planilla.planillas.destroy', $worksheet->id) }}" class="btn btn-danger button-destroy-worksheet btn-sm">Eliminar</a>
						@endif
					</td>
				</tr>
			@endforeach	
		</tbody>
		@else
			<tr><td align="center">No hay ningún item registrado para esta planilla.</td></tr>
		@endif
	</table> 
</div>
<script type="text/javascript">
	$(document).ready(function(){	
		$("#worksheets-daily .pagination a").off();
		$("#worksheets-daily .pagination a").click(function()
		{
            window.Misc.pagination('form-search-worksheet-daily', 'worksheets-daily', $(this).attr('href')); 
			return false;
		});

				// Button edit
        $(".button-edit-worksheet").click(function(event) {
            event.preventDefault();

            $("#form-add-worksheet").attr("method", "PATCH");
            $("#form-add-worksheet").attr("action", $(this).attr('href'));

            var item = $(this).data( "item" );
            $.ajax({
                type: 'GET',
                cache: false,
                dataType: 'json',
                url : document.url + '/planilla/planillas/' + item,
                success: function(data) {
                    if(data.success == true) {
                        // Set data
                        $("#validation-errors-worksheet").hide().empty();                                     
                        $("#worksheet-list-pharmacies").empty();                                     
                        $("#worksheet-list-exams").empty();                                     
                		$("#customers").empty();     

	                	$('#cliente').val(data.worksheet.cliente);
						$('#cliente_cedula').val(data.worksheet.cliente_cedula);
						$('#cliente_nombre').val(data.worksheet.cliente_nombre);
                		$("#servicio").val(data.worksheet.servicio);
	                	$('#valor').val(data.worksheet.valor);
                        $('#valor_sugerido').html(data.worksheet.valor_format ? data.worksheet.valor_format : 0);
  
	            	    // Examen, Famarcia
                        if(data.worksheet.examen != undefined && data.worksheet.examen) {
                            $('#div_farmacia').hide();
                            
                            $("#worksheet-list-exams").html(data.html).show();                                     
                            $('#div_examen').show();
                        }else if(data.worksheet.farmacia != undefined && data.worksheet.farmacia) {
                            $('#div_examen').hide();

                            $("#worksheet-list-pharmacies").html(data.html).show();                                     
                            $('#div_farmacia').show();
                        }else{
                        	
                            $('#div_examen').hide();
                            $('#div_farmacia').hide();    
                        }

                        // Open modal
                        $('#modal-worksheet').modal('show');
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    $('#error-app').modal('show');
                    $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
                }
            });
        });

		// Button destroy
		$(".button-destroy-worksheet").click(function(event) {
            event.preventDefault();

            $("#form-destroy-worksheet").attr("action", $(this).attr('href'));
            $('#modal-confirm-destroy-worksheet').modal('show');
       	});
	});
</script>