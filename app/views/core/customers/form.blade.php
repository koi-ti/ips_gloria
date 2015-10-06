@extends ('core/layout')

<?php
    if ($customer->exists):
        $form_data = array('route' => array('pacientes.update', $customer->id), 'method' => 'PATCH', 'id' => 'form-add-customer');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'pacientes.store', 'method' => 'POST', 'id' => 'form-add-customer');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Pacientes</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('pacientes.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-customer" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' pacientes', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-customer' )) }}        
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
            @if($customer->exists)
                <div class="short-div">
                    <img src="{{ $customer->imagen ? URL::asset($customer->imagen) : URL::asset('images/default-avatar.png') }}" class="img-responsive" width="100" height="auto">       
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            {{ Form::label('fecha_nacimiento', 'Fecha nacimiento') }}
            <div class="input-append date"> 
                {{ Form::text('fecha_nacimiento', null, array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
            </div>
        </div> 
        <div class="form-group col-md-3">           
            {{ Form::label('edad', 'Edad') }}
            <div><span class="label label-primary" id="div_edad"></span></div>           
        </div> 
        <div class="form-group col-md-3">           
            {{ Form::label('lugar_nacimiento', 'Lugar nacimiento') }}
            {{ Form::text('lugar_nacimiento', null, array('placeholder' => 'Lugar nacimiento', 'class' => 'form-control', 'maxlength' => '200')) }}        
        </div> 
        <div class="form-group col-md-3">           
            {{ Form::label('nacionalidad', 'Nacionalidad') }}
            {{ Form::text('nacionalidad', null, array('placeholder' => 'Nacionalidad', 'class' => 'form-control', 'maxlength' => '200')) }}        
        </div>    
    </div>

    <div class="row">
        <div class="form-group col-md-3">           
            {{ Form::label('escolaridad', 'Escolaridad') }}
            {{ Form::text('escolaridad', null, array('placeholder' => 'Ingrese escolaridad', 'class' => 'form-control', 'maxlength' => '200')) }}        
        </div>
        <div class="form-group col-md-3">           
            {{ Form::label('profesion', 'Profesión') }}
            {{ Form::text('profesion', null, array('placeholder' => 'Ingrese profesión', 'class' => 'form-control', 'maxlength' => '200')) }}        
        </div>
        <div class="form-group col-md-3">           
            {{ Form::label('oficio', 'Oficio') }}
            {{ Form::text('oficio', null, array('placeholder' => 'Ingrese oficio', 'class' => 'form-control', 'maxlength' => '200')) }}        
        </div>   
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            {{ Form::label('estadocivil', 'Estado civil') }}
            {{ Form::select('estadocivil', Customer::$maritalstatus,null, array('class' => 'form-control')) }}
        </div>   
        <div class="form-group col-md-3">
            {{ Form::label('sexo', 'Sexo') }}
            {{ Form::select('sexo', Customer::$sex,null, array('class' => 'form-control')) }}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-5">           
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
	{{ Form::close() }}
    
    @if($customer->exists)
        {{ Form::open(array('route' => 'pacientes.file','files' => true)) }}
        <div class="panel-footer">
            <div class="row">
                <div class="form-group col-md-4">
                    {{ Form::hidden('id', $customer->id) }}
                    {{ Form::label('imagen', 'Imagen') }}
                    {{ Form::file('imagen') }}
                </div> 
                <div class="form-group col-md-4">
                    {{ Form::button('Actualizar imagen', array('type' => 'submit','class' => 'btn btn-success')) }}        
                </div>        
            </div>
        </div>
        {{ Form::close() }}
    @endif

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
                            window.location="{{URL::to('pacientes/"+data.customer.id+"')}}";
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