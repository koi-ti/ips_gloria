@extends ('core/layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Planillas <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.planillas.index') }}" class="btn btn-info">Ver lista de planillas</a>
        </div>
    </div>  

    {{ Form::open(array('route' => 'planilla.planillas.index', 'method' => 'POST', 'id' => 'form-search-worksheet-daily'), array('role' => 'form')) }}    
        <div class="row">
            <div class="form-group col-md-1"></div>
            <div class="form-group col-md-6">
                <h3 class="page-header">Planilla diaria: <small>{{ $date }}</small></h3>
            </div>
            <div class="form-group col-md-2 text-right">
                <a href="#" class="btn btn-primary">Resumen</a>
            </div>
            <div class="form-group col-md-2 text-left">
                <a href="#" class="btn btn-danger">Imprimir</a>
            </div>
            <div class="form-group col-md-1"></div>
        </div>
        {{ Form::hidden('fecha', $date) }}        
    {{ Form::close() }}

    <div id="worksheets-daily">
        @include('core.worksheet.worksheets.worksheetsitem')
    </div>

    @if(@$permission->adiciona && $date == date('Y-m-d'))
    <div class="row">
        <div class="form-group col-md-2 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-worksheet">Nuevo registro</button>
        </div>
    </div>
    @endif

    <div class="modal fade" id="modal-worksheet" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="page-header">Nuevo registro planilla diaria: <small>{{ $date }}</small></h4>
                </div>
                {{ Form::open(array('route' => 'planilla.planillas.store', 'method' => 'POST', 'id' => 'form-add-worksheet'), array('role' => 'form')) }}    
                    <div class="modal-body">
                        <div id="validation-errors-worksheet" style="display: none"></div>             
                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::label('cliente_cedula', 'Cliente') }}
                                {{ Form::text('cliente_cedula', isset($customer) ? $customer->cedula : '', array('placeholder' => 'Ingrese paciente', 'class' => 'form-control')) }}        
                                {{ Form::hidden('cliente', null, array('id' => 'cliente')) }}
                            </div>
                            <div class="form-group col-md-7">           
                                {{ Form::label('cliente_nombre', 'Nombre') }}
                                <span class="glyphicon glyphicon-search" id="icon-search-customers-nombre" style="cursor: pointer;"></span>
                                {{ Form::text('cliente_nombre', isset($customer) ? $customer->nombre : '', array('placeholder' => 'Nombre paciente', 'class' => 'form-control')) }}
                            </div>
                        </div>
                        <div id="customers" class="row" align="center"></div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ Form::label('servicio', 'Servicio') }}
                                {{ Form::select('servicio', ['' => 'Seleccione'] + $services, null, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group col-md-5" id="div_examen">
                                {{ Form::label('examen', 'Exámen') }}
                                {{ Form::select('examen', ['' => 'Seleccione'] + $exams, null, array('class' => 'form-control')) }}
                            </div>  
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::hidden('fecha', $date) }}        
                                {{ Form::label('valor', 'Valor') }}
                                {{ Form::text('valor', null, array('placeholder' => 'Valor', 'class' => 'form-control')) }}        
                            </div> 
                            <div class="form-group col-md-5">
                                {{ Form::label('sugerido', 'Valor sugerido para el servicio') }}
                                <div><span class="label label-success" id="valor_sugerido">$0</span></div>
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

    <script type="text/javascript">
        $(function() {
            $('#modal-worksheet').modal({
                keyboard: false,                
                show: false
            });  

            $('#modal-worksheet').on('show.bs.modal', function (e) {
                $("#validation-errors-worksheet").hide().empty();                                     
                $("#customers").empty();                              
                $('#valor_sugerido').html('$0');       
                $('#cliente_cedula').val('');
                $('#cliente_nombre').val('');
                $('#cliente').val('');
                $('#valor').val('');
                $("#servicio").val('');
                $("#examen").val('');                
            });

            $("#cliente_cedula").change(function() {
                window.Misc.searchCustomer(); 
            });

            $("#icon-search-customers-nombre").click(function( event ) {  
                window.Misc.searchCustomers($("#cliente_cedula").val(),$("#cliente_nombre").val()); 
            });

            $("#servicio").change(function() {
                $.ajax({
                    type: 'get',
                    cache: false,
                    dataType: 'json',
                    url : document.url + '/planilla/servicios/' + $("#servicio").val(),
                    success: function(data) {
                        if(data.success == true) {
                            // Valor
                            if(data.valor != undefined && data.valor){
                                $('#valor').val(data.valor);
                                $('#valor_sugerido').html('$'+data.valor_format);
                            }

                            // Examen
                            if(data.examen != undefined && data.examen) {
                                $('#div_examen').show();
                            }else{
                                $('#div_examen').hide();
                                $('#examen').val('')
                            }
                        }else{                          
                            $('#servicio').val('')                           
                        }
                    },
                    error: function(xhr, textStatus, thrownError) {
                        $('#error-app').modal('show');
                        $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
                    }
                });                
            });

            $('#form-add-worksheet').on('submit', function(event){                             
                var url = $(this).attr('action');
                event.preventDefault();

                $.ajax({
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-worksheet').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-worksheet").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-worksheet").append(data.errors);
                            $("#validation-errors-worksheet").show();
                        }else{
                            $('#modal-worksheet').modal('hide');
                            window.Misc.search('form-search-worksheet-daily', 'worksheets-daily', '/planilla/planillas/create'); 
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
@stop