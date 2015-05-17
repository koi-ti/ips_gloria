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
            <span class="glyphicon glyphicon-user" id="customer-glyphicon" style="cursor: pointer;"></span>            
            {{ Form::text('cliente_nit', null, array('placeholder' => 'Ingrese cliente', 'class' => 'form-control')) }}        
            {{ Form::hidden('cliente', null, array('id' => 'cliente')) }}
        </div>
        <div class="form-group col-md-6">           
            {{ Form::label('cliente_nombre', 'Nombre') }}
            {{ Form::text('cliente_nombre', null, array('class' => 'form-control', 'disabled' => 'disabled')) }}        
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('cliente_direccion', 'Dirección') }}
            {{ Form::select('cliente_direccion', array('' => 'Seleccione') ,null, array('class' => 'form-control')) }}
        </div>       
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('tecnico', 'Técnico') }}
            {{ Form::select('tecnico', array('' => 'Seleccione') + $repairmans ,null, array('class' => 'form-control')) }}
        </div>   
        <div class="form-group col-md-3">           
            {{ Form::label('factura', 'Factura') }}
            {{ Form::select('factura', ['' => 'Seleccione', 'yes' => 'SI', 'not' => 'NO'] ,null, array('class' => 'form-control')) }}
        </div>  
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('dano', 'Daño') }}
            {{ Form::textarea('dano', null, ['size' => '30x4', 'class' => 'form-control']) }}
        </div>     
    </div>
	{{ Form::close() }}

    <script type="text/javascript">
        $(function() {
            $("#cliente_nit").change(function() {
                window.Misc.searchCustomer(true); 
            });

            $("#btn-submit-order").click(function() {
                $("#form-add-order").submit();
            });

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
        });
    </script>
@stop