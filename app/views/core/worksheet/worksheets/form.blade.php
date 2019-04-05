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
            <div class="form-group col-md-8">
                <h3 class="page-header">Planilla diaria: <small>{{ $date }}</small></h3>
            </div>
            <div class="form-group col-md-2 text-right">
                @if(@$permission->adiciona && $date == date('Y-m-d'))
                    <a href="{{ route('planilla.planillas.store') }}" class="btn btn-success button-create-worksheet btn-sm">
                        <span class="glyphicon glyphicon-plus-sign"></span> Nuevo registro
                    </a>
                @endif
            </div>
            <div class="form-group col-md-1"></div>
        </div>
        {{ Form::hidden('fecha', $date) }}        
    {{ Form::close() }}

    <div id="worksheets-daily">
        @include('core.worksheet.worksheets.worksheetsitem')
    </div>

    <div class="modal fade" id="modal-worksheet" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-worksheet modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="page-header">Nuevo registro planilla diaria: <small>{{ $date }}</small></h4>
                </div>
                <div class="modal-body modal-body-worksheet">
                    {{ Form::open(array('route' => 'planilla.planillas.store', 'method' => 'POST', 'id' => 'form-add-worksheet'), array('role' => 'form')) }}    
                        <div id="validation-errors-worksheet" style="display: none"></div>             
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('cliente_cedula', 'Cliente') }}
                                {{ Form::text('cliente_cedula', isset($customer) ? $customer->cedula : '', array('placeholder' => 'Ingrese paciente', 'class' => 'form-control')) }}        
                                {{ Form::hidden('cliente', null, array('id' => 'cliente')) }}
                            </div>
                            <div class="form-group col-md-8">           
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
                            <div class="form-group col-md-3">
                                {{ Form::hidden('fecha', $date) }}        
                                {{ Form::label('valor', 'Valor') }}
                                {{ Form::text('valor', null, array('placeholder' => 'Valor', 'class' => 'form-control')) }}        
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('sugerido', 'Valor sugerido para el servicio') }}
                                <div><span class="label label-success" id="valor_sugerido"></span></div>
                            </div>  
                        </div>
                    {{ Form::close() }}

                    <div id="div_examen" style="display:none;">
                        {{ Form::open(array('route' => 'util.cart.store', 'method' => 'POST', 'id' => 'form-cart-exams-worksheet')) }}
                            <div class="row">
                                {{ Form::hidden('_key', Worksheet::$key_cart_exams) }}
                                {{ Form::hidden('_template', Worksheet::$template_cart_exams) }}
                                <div class="form-group col-md-3"></div>
                                <div class="form-group col-md-5">
                                    {{ Form::label('examen', 'Exámen') }}
                                    {{ Form::select('examen', ['' => 'Seleccione'] + $exams, null, array('class' => 'form-control', 'style' => 'width:100%;')) }}
                                    
                                    {{ Form::hidden('examen_nombre', null, ['id' => 'examen_nombre']) }}
                                    {{ Form::hidden('examen_valor', null, ['id' => 'examen_valor']) }}
                                </div>
                                <div class="form-group col-md-1">
                                    <label><span>&nbsp;</span></label>
                                    <button type="submit" id="btn-contract-add-product" class="btn btn-default btn-md">
                                        <span class="glyphicon glyphicon-plus-sign"></span>
                                    </button>
                                </div>
                                <div class="form-group col-md-3"></div>
                            </div>
                        {{ Form::close() }}
                        <div id="worksheet-list-exams" style="display:none;"></div>
                    </div>

                    <div id="div_farmacia" style="display:none;">
                        {{ Form::open(array('route' => 'util.cart.store', 'method' => 'POST', 'id' => 'form-cart-pharmacy-worksheet')) }}
                            <div class="row">
                                {{ Form::hidden('_key', Worksheet::$key_cart_pharmacies) }}
                                {{ Form::hidden('_template', Worksheet::$template_cart_pharmacies) }}
                                <div class="form-group col-md-1"></div>
                                <div class="form-group col-md-7">
                                    {{ Form::label('farmacia', 'Farmacia') }}
                                    {{ Form::select('farmacia', ['' => 'Seleccione'] + $pharmacies, null, array('class' => 'form-control', 'style' => 'width:100%;')) }}
                                </div>
                                <div class="form-group col-md-2">
                                    {{ Form::label('cantidad', 'Cantidad') }}
                                    {{ Form::text('cantidad', null, array('placeholder' => 'Cantidad', 'class' => 'form-control')) }}   
                                    {{ Form::hidden('farmacia_nombre', null, ['id' => 'farmacia_nombre']) }}
                                    {{ Form::hidden('farmacia_valor', null, ['id' => 'farmacia_valor']) }}     
                                </div>
                                <div class="form-group col-md-1">
                                    <label><span>&nbsp;</span></label>
                                    <button type="submit" id="btn-contract-add-product" class="btn btn-default btn-md">
                                        <span class="glyphicon glyphicon-plus-sign"></span>
                                    </button>
                                </div>
                                <div class="form-group col-md-1"></div>
                            </div>
                        {{ Form::close() }}
                        <div id="worksheet-list-pharmacies" style="display:none;"></div>
                    </div>
                </div>            
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-submit-worksheet">Continuar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>  
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-confirm-destroy-worksheet" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="page-header">Eliminar item</h4>
                </div>
                {{ Form::open(['id' => 'form-destroy-worksheet', 'method' => 'DELETE'], ['role' => 'form']) }}    
                    <div class="modal-body">
                        ¿Realmente desea eliminar este item para el día {{ $date }}?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="delete">Eliminar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>              
                {{ Form::close() }}
            </div>
        </div>
    </div>
    

    @if(@$permissionExpense->consulta && $date == date('Y-m-d'))
        {{-- Gastos --}}
        <br />
        {{ Form::open(array('route' => 'planilla.gastos.index', 'method' => 'POST', 'id' => 'form-search-expenses-daily'), array('role' => 'form')) }}    
            <div class="row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-8">
                    <h3 class="page-header">Gastos</h3>
                </div>
                <div class="form-group col-md-2 text-right">
                    @if(@$permissionExpense->adiciona && $date == date('Y-m-d'))
                        <button type="button" class="btn btn-success btn-sm" id="button-register-expense">
                            <span class="glyphicon glyphicon-plus-sign"></span> Nuevo gasto
                        </button>  
                    @endif        
                </div>
                <div class="form-group col-md-1"></div>
            </div>
            {{ Form::hidden('collection', 'expenses') }}        
            {{ Form::hidden('fecha', $date) }}        
        {{ Form::close() }}

        <div id="expenses-daily">
            @include('core.worksheet.expenses.expensesitem')
        </div>

        @include('core.worksheet.expenses.modalform')
    @endif
    

    {{-- Javascript --}}
    <script type="text/javascript">
        $(function() {
            $('#modal-worksheet').modal({
                keyboard: false,                
                show: false
            });  

            $("#cliente_cedula").change(function() {
                window.Misc.searchCustomer(); 
            });

            $("#icon-search-customers-nombre").click(function( event ) {  
                window.Misc.searchCustomers($("#cliente_cedula").val(),$("#cliente_nombre").val()); 
            });

            $("#servicio").change(function() {
                // Clear set data
                $("#validation-errors-worksheet").hide().empty();                                     
                $("#worksheet-list-pharmacies").empty();                                     
                $("#worksheet-list-exams").empty();                

                if($("#servicio").val() != '') 
                {
                    $.ajax({
                        type: 'get',
                        cache: false,
                        dataType: 'json',
                        url : document.url + '/planilla/servicios/' + $("#servicio").val(),
                        success: function(data) {
                            if(data.success == true) {
                                
                                // Examen, Famarcia
                                if(data.examen != undefined && data.examen =='1') {
                                    // Valor
                                    $('#valor').val('');
                                    $('#valor_sugerido').html('0');

                                    $('#div_examen').show();
                                    $('#div_farmacia').hide();
                                }else if(data.farmacia != undefined && data.farmacia =='1') {
                                    // Valor
                                    $('#valor').val('');
                                    $('#valor_sugerido').html('0');

                                    $('#div_examen').hide();
                                    $('#div_farmacia').show();
                                }else{
                                    // Valor
                                    $('#valor').val(data.valor ? data.valor : 0);
                                    $('#valor_sugerido').html(data.valor_format ? data.valor_format : 0);

                                    $('#div_examen').hide();
                                    $('#div_farmacia').hide();    
                                }

                            }else{                          
                                $('#servicio').val('');
                            }
                        },
                        error: function(xhr, textStatus, thrownError) {
                            $("#validation-errors-worksheet").append('<div class="alert alert-danger">No hay respuesta del servidor - Consulte al administrador.</div>');
                            $("#validation-errors-worksheet").show();               
                        }
                    });
                }else{
                    $('#valor').val('');
                    $('#valor_sugerido').html('$0');

                    $('#div_examen').hide();
                    $('#div_farmacia').hide();    
                }                
            });
            
            $(".button-create-worksheet").click(function(event) {
                event.preventDefault();

                $("#form-add-worksheet").attr("method", "POST");
                $("#form-add-worksheet").attr("action", $(this).attr('href'));

                $('#div_farmacia').hide();
                $('#div_examen').hide();

                // Clear set data
                $("#validation-errors-worksheet").hide().empty();                                     
                $("#worksheet-list-pharmacies").empty();                                     
                $("#worksheet-list-exams").empty();                                     
                $("#customers").empty(); 

                // Clear form
                $('#cliente_cedula').val('');
                $('#cliente_nombre').val('');
                $('#cliente').val('');
                $("#servicio").val('');
                $('#valor').val('');
                $('#valor_sugerido').html('0');

                // Clear form exam
                $("#examen").val('');  
                $("#examen_nombre").val('');
                $("#examen_valor").val('');

                // Clear form
                $("#farmacia").val('');
                $("#cantidad").val('0');  
                $("#farmacia_nombre").val('');
                $("#farmacia_valor").val('');

                // Open modal
                $('#modal-worksheet').modal('show');
            });
            

            $("#btn-submit-worksheet").click(function() {
                $("#form-add-worksheet").submit();
            }); 

            $('#form-add-worksheet').on('submit', function(event){                             
                event.preventDefault();
                
                $.ajax({
                    type: $(this).attr('method'),
                    url : $(this).attr('action'),
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-worksheet').serialize(),
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
                        $("#validation-errors-worksheet").append('<div class="alert alert-danger">No hay respuesta del servidor - Consulte al administrador.</div>');
                        $("#validation-errors-worksheet").show();
                    }
                });
                return false;
            }); 
            
            // Cart exams
            $('#form-cart-exams-worksheet').on('submit', function(event){                             
                event.preventDefault();
                var url = $(this).attr('action')

                if($("#examen").val() == '' || $("#examen").val() == '0'){
                    alertify.error("Por favor seleccione examen.");
                    return
                }

                $.ajax({
                    type: 'get',
                    cache: false,
                    dataType: 'json',
                    url : document.url + '/planilla/examen/' + $("#examen").val(),
                    success: function(data) {
                        if(data.success == true) {
                            // Set exam values
                            $("#examen_nombre").val(data.nombre);
                            $("#examen_valor").val(data.valor);

                            // Add cart
                            utilList.store(url,$('#form-cart-exams-worksheet').serialize(),'worksheet-list-exams');
                            $("#valor").val( (parseInt($("#valor").val()?$("#valor").val():0) + parseInt(data.valor?data.valor:0) ));
                        }                            
                        // Clear form
                        $("#examen").val('');  
                        $("#examen_nombre").val('');
                        $("#examen_valor").val('');      
                    },
                    error: function(xhr, textStatus, thrownError) {
                        $("#validation-errors-worksheet").append('<div class="alert alert-danger">No hay respuesta del servidor - Consulte al administrador.</div>');
                        $("#validation-errors-worksheet").show();
                    }
                });
            });

            // Cart pharmacies
            $('#form-cart-pharmacy-worksheet').on('submit', function(event){                             
                event.preventDefault();
                var url = $(this).attr('action')
                
                if($("#farmacia").val() == '' || $("#farmacia").val() == '0'){
                    alertify.error("Por favor seleccione farmacia.");
                    return
                }

                if(!$.isNumeric($("#cantidad").val()) || $("#cantidad").val() == '0'){
                    alertify.error("Por favor ingrese cantidad.");
                    return
                }

                $.ajax({
                    type: 'get',
                    cache: false,
                    dataType: 'json',
                    url : document.url + '/planilla/farmacia/' + $("#farmacia").val(),
                    success: function(data) {
                        if(data.success == true) {
                            // Set exam values
                            $("#farmacia_nombre").val(data.nombre);
                            $("#farmacia_valor").val(data.valor);

                            // Add cart
                            utilList.store(url,$('#form-cart-pharmacy-worksheet').serialize(),'worksheet-list-pharmacies');
                            $("#valor").val( (parseInt($("#valor").val()?$("#valor").val():0) + (parseInt(data.valor?data.valor:0)*$("#cantidad").val()) ));       
                        }                            
                        // Clear form
                        $("#farmacia").val('');
                        $("#cantidad").val('0');  
                        $("#farmacia_nombre").val('');
                        $("#farmacia_valor").val('');      
                    },
                    error: function(xhr, textStatus, thrownError) {
                        $("#validation-errors-worksheet").append('<div class="alert alert-danger">No hay respuesta del servidor - Consulte al administrador.</div>');
                        $("#validation-errors-worksheet").show();
                    }
                });
            }); 

            $('#form-destroy-worksheet').on('submit', function(event){                             
                event.preventDefault();

                $.ajax({
                    cache: false,
                    url: $(this).attr('action'),
                    type: 'DELETE',
                    dataType: 'json',
                    data:  $('#form-destroy-worksheet').serialize(),
                    beforeSend: function() { 
                        $("#validation-errors-expenses").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-expenses").append(data.errors);
                            $("#validation-errors-expenses").show();
                        }else{
                            $('#modal-confirm-destroy-worksheet').modal('hide');
                            window.Misc.search('form-search-worksheet-daily', 'worksheets-daily', '/planilla/planillas/create'); 
                        }
                    },
                    error: function(xhr, textStatus, thrownError) {
                        $("#validation-errors-worksheet").append('<div class="alert alert-danger">No hay respuesta del servidor - Consulte al administrador.</div>');
                        $("#validation-errors-worksheet").show();               
                    }
                });
                return false;
            }); 
        });
    </script>
@stop