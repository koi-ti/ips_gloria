@extends ('core/layout')

<?php
    if ($customer->exists):
        $form_data = array('route' => array('clientes.update', $customer->id), 'method' => 'PATCH', 'id' => 'form-add-customer');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'clientes.store', 'method' => 'POST', 'id' => 'form-add-customer');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Clientes</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('clientes.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-customer" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' cliente', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-customer' )) }}        
    </div>
 	{{ Form::model($customer, $form_data, array('role' => 'form')) }}
  	<div class="row">
        <div class="form-group col-md-4">           
            {{ Form::label('nit', 'Nit') }}
            {{ Form::text('nit', null, array('placeholder' => 'Ingresa Nit', 'class' => 'form-control', 'maxlength' => '15')) }}        
        </div>
        <div class="form-group col-md-7">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Ingresa Nombre', 'class' => 'form-control', 'maxlength' => '100')) }}        
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">           
            {{ Form::label('direccion', 'Dirección') }}
            {{ Form::text('direccion', null, array('placeholder' => 'Ingresa Dirección', 'class' => 'form-control', 'maxlength' => '100')) }}        
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('ciudad', 'Ciudad') }}
            {{ Form::select('ciudad', array('' => 'Seleccione') + $cities ,null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-4">           
            {{ Form::label('telefono', 'Teléfono') }}
            {{ Form::text('telefono', null, array('placeholder' => 'Ingresa Teléfono', 'class' => 'form-control', 'maxlength' => '50')) }}        
        </div>       
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::label('email', 'Dirección de E-mail') }}
            {{ Form::text('email', null, array('placeholder' => 'Ingresa E-mail', 'class' => 'form-control', 'maxlength' => '50')) }}
        </div>
    </div>
	{{ Form::close() }}
    
    <table class="table table-striped" align="center">
        <tr>
            <th style="text-align:center">Direcciones Cliente</th>
        <tr> 
        <tr><td>
        {{ Form::open(array('route' => 'util.cart.store', 'method' => 'POST', 'id' => 'form-cart-customer-address')) }}
            <div class="row">
                {{ Form::hidden('_key', Customer::$key_cart_address) }}
                {{ Form::hidden('_template', Customer::$template_cart_address) }}
                {{ Form::hidden('_layer', Customer::$layer_cart_address) }}
                <div class="form-group col-md-3">
                    {{ Form::label('add_nombre', 'Nombre') }}
                    {{ Form::text('add_nombre', null, array('placeholder' => 'Nombre', 'class' => 'form-control', 'maxlength' => '100')) }}        
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('add_persona', 'Persona') }}
                    {{ Form::text('add_persona', null, array('placeholder' => 'Persona', 'class' => 'form-control', 'maxlength' => '100')) }}        
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('add_direccion', 'Dirección') }}
                    {{ Form::text('add_direccion', null, array('placeholder' => 'Dirección', 'class' => 'form-control', 'maxlength' => '100')) }}        
                </div>
                <div class="form-group col-md-2">
                    {{ Form::label('add_activo', 'Estado') }}
                    {{ Form::select('add_activo', CustomerAddress::$states ,1, array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    {{ Form::label('add_ciudad', 'Ciudad') }}
                    {{ Form::select('add_ciudad', array('' => 'Seleccione') + $cities ,null, array('class' => 'form-control', 'id' => 'add_ciudad')) }}
                </div>
                <div class="form-group col-md-3">           
                    {{ Form::label('add_telefono', 'Teléfono') }}
                    {{ Form::text('add_telefono', null, array('placeholder' => 'Teléfono', 'class' => 'form-control', 'maxlength' => '50')) }}        
                </div>
                <div class="form-group col-md-1">
                    {{ Form::hidden('add_id', 0) }}
                    {{ Form::hidden('add_ciudad_nombre', '',array('id' => 'add_ciudad_nombre')) }}
                    <label><span>&nbsp;</span></label>
                    <button type="submit" id="btn-customer-add-address" class="btn btn-default btn-md">
                        <span class="glyphicon glyphicon-plus-sign"></span>
                    </button>
                </div>
            </div>
        {{ Form::close() }}
        </td></tr>
        <tr><td>
        <div id="{{ Customer::$layer_cart_address }}">
            {{ $html_address }}
        </div>
        </td></tr>
    </table>
    
    <script type="text/javascript">
        $(function() {
            $("#btn-submit-customer").click(function() {
                $("#form-add-customer").submit();
            });

            $('#form-add-customer').on('submit', function(event){                             
                var url = $(this).attr('action');
                var method = "<?php echo $method; ?>";
                event.preventDefault();

                $.ajax({
                    type: method,
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-customer').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-customer").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-customer").append(data.errors);
                            $("#validation-errors-customer").show();
                        }else{
                            window.location="{{URL::to('clientes/"+data.customer.id+"')}}";
                        }
                    },
                    error: function(xhr, textStatus, thrownError) {
                        $('#error-app').modal('show');                      
                        $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
                    }
                });
                return false;
            });     
            

            $("#add_ciudad").change(function() {
                $("#add_ciudad_nombre").val($("#add_ciudad option:selected").text())
            });

            $('#form-cart-customer-address').on('submit', function(event){                             
                var url = $(this).attr('action')
                event.preventDefault();

                if($("#add_nombre").val() == ''){
                    alertify.error("Por favor ingrese nombre.");
                    return
                }
                if($("#add_persona").val() == ''){
                    alertify.error("Por favor ingrese persona.");
                    return
                }
                if($("#add_direccion").val() == ''){
                    alertify.error("Por favor ingrese dirección.");
                    return
                }
                if(!$.isNumeric($("#add_ciudad").val())){
                    alertify.error("Por favor seleccione ciudad.");
                    return
                }
                utilList.store(url, $('#form-cart-customer-address').serialize() ,'customer-list-address')
            });
        });
    </script>
@stop