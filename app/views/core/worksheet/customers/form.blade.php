@extends ('core/layout')

<?php
    if ($customer->exists):
        $form_data = array('route' => array('planilla.pacientes.update', $customer->id), 'method' => 'PATCH', 'id' => 'form-add-customer');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'planilla.pacientes.store', 'method' => 'POST', 'id' => 'form-add-customer');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Pacientes <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.pacientes.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-customer" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' paciente', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-customer' )) }}        
    </div>
 	{{ Form::model($customer, $form_data, array('role' => 'form')) }}
  	<div class="row">
        <div class="form-group col-md-3">           
            {{ Form::label('cedula', 'Cédula') }}
            {{ Form::text('cedula', null, array('placeholder' => 'Ingrese cédula de ciudadania', 'class' => 'form-control', 'maxlength' => '15')) }}        
        </div>
        <div class="form-group col-md-6">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Ingrese Nombre', 'class' => 'form-control', 'maxlength' => '100')) }}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('fecha_nacimiento', 'Fecha nacimiento') }}
            <div class="input-append date"> 
                {{ Form::text('fecha_nacimiento', null, array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
            </div>
        </div>    
    </div>

    <div class="row">
        <div class="form-group col-md-5">           
            {{ Form::label('direccion', 'Dirección') }}
            {{ Form::text('direccion', null, array('placeholder' => 'Ingresa Dirección', 'class' => 'form-control', 'maxlength' => '100')) }}        
        </div>
        <div class="form-group col-md-4">           
            {{ Form::label('telefono', 'Teléfono') }}
            {{ Form::text('telefono', null, array('placeholder' => 'Ingresa Teléfono', 'class' => 'form-control', 'maxlength' => '50')) }}        
        </div>       
    </div>
	{{ Form::close() }}
    
    <script type="text/javascript">
        $(function() {

            $("#fecha_nacimiento").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd"              
            })

            $("#fecha_nacimiento").change(function() {
                window.Misc.calcularEdad($("#fecha_nacimiento").val()); 
            });
            window.Misc.calcularEdad($("#fecha_nacimiento").val()); 

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
                            window.location="{{URL::to('planilla/pacientes/"+data.customer.id+"')}}";
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