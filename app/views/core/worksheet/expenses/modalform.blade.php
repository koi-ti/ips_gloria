<div class="modal fade" id="modal-expense" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="page-header">Nuevo gasto para el día: <small>{{ $date }}</small></h4>
            </div>
            {{ Form::open(array('route' => 'planilla.gastos.index', 'id' => 'form-add-expense'), array('role' => 'form')) }}    
                <div class="modal-body">
                    <div id="validation-errors-expenses" style="display: none"></div>
                    <div class="row">
                        <div class="form-group col-md-12">           
                            {{ Form::label('nombre', 'Descripción') }}
                            {{ Form::text('nombre', null, array('placeholder' => 'Ingrese descripción gasto', 'class' => 'form-control', 'maxlength' => '200')) }}        
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-5">
                            {{ Form::label('valor', 'Valor') }}
                            {{ Form::text('valor', null, array('placeholder' => 'Valor', 'class' => 'form-control')) }}        
                        </div>  
                        <div class="form-group col-md-7">
                            {{ Form::label('servicio', 'Servicio') }}
                            {{ Form::select('servicio', ['' => 'Seleccione'] + $services, null, array('class' => 'form-control')) }}
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Continuar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>              
            {{ Form::close() }}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-confirm" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="page-header">Eliminar gasto</h4>
            </div>
            {{ Form::open(array('id' => 'form-destroy-expense', 'method' => 'DELETE'), array('role' => 'form')) }}    
                <div class="modal-body">
                    ¿Realmente desea eliminar este gasto para el día {{ $date }}?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="delete">Eliminar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>              
            {{ Form::close() }}
        </div>
    </div>
</div>

<script type="text/javascript">
        $(function() {

        	// Create
            $('#modal-expense').modal({
                keyboard: false,                
                show: false
            });

            $("#btn-submit-expense").click(function() {
                $("#form-add-expense").submit();
            });

            $("#button-register-expense").click(function() {
                $("#form-add-expense").attr("method", "POST");
                $("#form-add-expense").attr("action", "{{ route('planilla.gastos.store') }}");

                // Set data
                 $('#form-add-expense').find('input[id="nombre"]').val('');
                 $('#form-add-expense').find('input[id="valor"]').val('');
                 $('#form-add-expense').find('select[id="servicio"]').val('');

                // Open modal
                $('#modal-expense').modal('show');
            });

            $('#form-add-expense').on('submit', function(event){                             
                event.preventDefault();

                $.ajax({
                    cache: false,
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    dataType: 'json',
                    data:  $('#form-add-expense').serialize(),
                    beforeSend: function() { 
                        $("#validation-errors-expenses").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-expenses").append(data.errors);
                            $("#validation-errors-expenses").show();
                        }else{
                            $('#modal-expense').modal('hide');
                            window.Misc.search('form-search-expenses-daily', 'expenses-daily', '/planilla/gastos/create'); 
                        }
                    },
                    error: function(xhr, textStatus, thrownError) {
                        $('#error-app').modal('show');                      
                        $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
                    }
                });
                return false;
            });  
			
			// Destroy
            $('#modal-confirm').modal({
                show: false
            }); 

            $('#form-destroy-expense').on('submit', function(event){                             
                event.preventDefault();

                $.ajax({
                    cache: false,
                    url: $(this).attr('action'),
                    type: 'DELETE',
                    dataType: 'json',
                    data:  $('#form-destroy-expense').serialize(),
                    beforeSend: function() { 
                        $("#validation-errors-expenses").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-expenses").append(data.errors);
                            $("#validation-errors-expenses").show();
                        }else{
                            $('#modal-confirm').modal('hide');
                            window.Misc.search('form-search-expenses-daily', 'expenses-daily', '/planilla/gastos/create'); 
                        }
                    },
                    error: function(xhr, textStatus, thrownError) {
                        $('#error-app').modal('show');                      
                        $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
                    }
                });
                return false;
            }); 
        });
    </script>