@extends ('core/layout')

<?php
    if ($order->exists):
        $form_data = array('route' => array('ordenes.update', $order->id), 'method' => 'PATCH', 'id' => 'form-add-order');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'ordenes.store', 'method' => 'POST', 'id' => 'form-add-order');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Ordenes de servicio</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('ordenes.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-order" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' orden', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-order' )) }}        
    </div>
 	{{ Form::model($order, $form_data, array('role' => 'form')) }}
  	<div class="row">
        <div class="form-group col-md-3">
            {{ Form::label('cliente_nit', 'Cliente') }}
            {{ Form::text('cliente_nit', isset($customer) ? $customer->nit : '', array('placeholder' => 'Ingrese cliente', 'class' => 'form-control')) }}        
            {{ Form::hidden('cliente', null, array('id' => 'cliente')) }}
        </div>
        <div class="form-group col-md-6">           
            {{ Form::label('cliente_nombre', 'Nombre') }}
            <span class="glyphicon glyphicon-search" id="icon-search-customers-nombre" style="cursor: pointer;"></span>
            {{ Form::text('cliente_nombre', isset($customer) ? $customer->nombre : '', array('placeholder' => 'Nombre cliente', 'class' => 'form-control')) }}                    
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('cliente_direccion', 'Dirección') }}
            {{ Form::select('cliente_direccion', isset($address) ? $address + array('' => 'Seleccione') : array('' => 'Seleccione') ,null, array('class' => 'form-control')) }}
        </div>       
    </div>
    <div id="customers" class="row" align="center"></div>

    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('tecnico', 'Técnico') }}
            {{ Form::select('tecnico', array('' => 'Seleccione') + $repairmans ,null, array('class' => 'form-control')) }}
        </div>   
        <div class="form-group col-md-3">           
            {{ Form::label('factura', 'Factura') }}
            {{ Form::select('factura', ['' => 'Seleccione', '1' => 'SI', '0' => 'NO'] ,null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-3">           
            {{ Form::label('llamo', 'Llamo') }}
            {{ Form::text('llamo', null, array('placeholder' => 'Ingresa Persona Llamo', 'class' => 'form-control', 'maxlength' => '100')) }}
        </div>  
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('dano', 'Daño') }}
            {{ Form::textarea('dano', null, ['size' => '30x4', 'class' => 'form-control']) }}
        </div>     
    </div>
	{{ Form::close() }}

    @if ($order->exists)
        <table class="table table-striped" align="center">
            <tr>
                <th style="text-align:center">Visitas</th>
            <tr> 
            <tr>
                <td>
                    {{ Form::open(array('route' => 'util.cart.store', 'method' => 'POST', 'id' => 'form-cart-order-visit')) }}
                    <div class="row">
                        {{ Form::hidden('_key', Order::$key_cart_visits) }}
                        {{ Form::hidden('_template', Order::$template_cart_visits) }}
                        {{ Form::hidden('_layer', Order::$layer_cart_visits) }}
                        <div class="form-group col-md-4">
                            {{ Form::label('vis_tecnico', 'Técnico') }}
                            {{ Form::select('vis_tecnico', array('' => 'Seleccione') + $repairmans ,null, array('class' => 'form-control')) }}
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('vis_fecha_inicial', 'Fecha inicial') }}
                            <div id="vis_fecha_inicial_picker" class="input-append"> 
                                <input data-format="yyyy-MM-dd HH:mm:ss PP" type="text" class="form-control" id="vis_fecha_inicial" name="vis_fecha_inicial"></input>
                                <span class="add-on"> 
                                    <i data-time-icon="glyphicon glyphicon-time" data-date-icon="glyphicon glyphicon-calendar"></i>
                                </span>
                            </div>
                        </div> 
                        <div class="form-group col-md-3">
                            {{ Form::label('vis_fecha_final', 'Fecha final') }}
                            <div id="vis_fecha_final_picker" class="input-append"> 
                                <input data-format="yyyy-MM-dd HH:mm:ss PP" type="text" class="form-control" id="vis_fecha_final" name="vis_fecha_final"></input>
                                <span class="add-on"> 
                                    <i data-time-icon="glyphicon glyphicon-time" data-date-icon="glyphicon glyphicon-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-1">           
                            {{ Form::label('vis_finorden', 'Fin Orden?') }}
                            {{ Form::checkbox('vis_finorden', 'yes', false) }}
                        </div>
                        <div class="form-group col-md-1">
                            <label><span>&nbsp;</span></label>
                            <button type="submit" id="btn-order-add-visit" class="btn btn-default btn-md">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            {{ Form::label('vis_observaciones', 'Observaciones') }}
                            {{ Form::textarea('vis_observaciones', null, ['size' => '30x3', 'class' => 'form-control']) }}
                        </div>
                        <div class="form-group col-md-6">
                            {{ Form::label('vis_pendientes', 'Pendientes') }}
                            {{ Form::textarea('vis_pendientes', null, ['size' => '30x3', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    {{ Form::hidden('vis_id', 0) }}
                    {{ Form::hidden('vis_tecnico_nombre', '',array('id' => 'vis_tecnico_nombre')) }}
                    {{ Form::close() }}
                </td>
            </tr>
            <tr><td>
            <div id="{{ Order::$layer_cart_visits }}">
                {{ $html_visits }}
            </div>
            </td></tr>
        </table>
    @endif

    <script type="text/javascript">
        $(function() {
            $("#cliente_nit").change(function() {
                $('#cliente_direccion').find('option:gt(0)').remove();
                window.Misc.searchCustomer(true); 
            });

            $("#btn-submit-order").click(function() {
                $("#form-add-order").submit();
            });

            $('#vis_fecha_inicial_picker').datetimepicker({
                language: 'en',
                pick12HourFormat: true
            });

            $('#vis_fecha_final_picker').datetimepicker({
                language: 'en',
                pick12HourFormat: true
            });

            $("#icon-search-customers-nombre").click(function( event ) {  
                window.Misc.searchCustomers($("#cliente_nit").val(),$("#cliente_nombre").val()); 
            })

            $('#form-add-order').on('submit', function(event){                             
                var url = $(this).attr('action');
                event.preventDefault();

                $.ajax({
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-order').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-order").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-order").append(data.errors);
                            $("#validation-errors-order").show();
                        }else{
                            window.location="{{URL::to('ordenes/"+data.order.id+"')}}";
                        }
                    },
                    error: function(xhr, textStatus, thrownError) {
                        $('#modal-client').modal('hide');
                        $('#error-app').modal('show');                      
                        $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
                    }
                });
                return false;
            }); 
            
            $("#vis_tecnico").change(function() {
                $("#vis_tecnico_nombre").val($("#vis_tecnico option:selected").text())
            });

            $('#form-cart-order-visit').on('submit', function(event){                             
                var url = $(this).attr('action')
                event.preventDefault();

                $("#vis_fecha_inicial").val();

                if(!$.isNumeric($("#vis_tecnico").val())){
                    alertify.error("Por favor seleccione técnico.");
                    return
                }
                if($("#vis_fecha_inicial").val() == ''){
                    alertify.error("Por favor ingrese fecha_inicial.");
                    return
                }
                if($("#vis_fecha_final").val() == ''){
                    alertify.error("Por favor ingrese fecha final.");
                    return
                }
                if($("#vis_observaciones").val() == ''){
                    alertify.error("Por favor ingrese observaciones.");
                    return
                }
                if($("#vis_pendientes").val() == ''){
                    alertify.error("Por favor ingrese pendientes.");
                    return
                }
                utilList.store(url, $('#form-cart-order-visit').serialize() ,'orders-list-visits')
            });
        });
    </script>
@stop