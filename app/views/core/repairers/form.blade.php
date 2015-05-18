@extends ('core/layout')

<?php
    if ($repairman->exists):
        $form_data = array('route' => array('tecnicos.update', $repairman->id), 'method' => 'PATCH', 'id' => 'form-add-repairman');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'tecnicos.store', 'method' => 'POST', 'id' => 'form-add-repairman');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Técnicos</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('tecnicos.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-repairman" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' técnico', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-repairman' )) }}        
    </div>
 	{{ Form::model($repairman, $form_data, array('role' => 'form')) }}
  	<div class="row">
        <div class="form-group col-md-4">           
            {{ Form::label('cedula', 'Cédula') }}
            {{ Form::text('cedula', null, array('placeholder' => 'Ingresa Cédula', 'class' => 'form-control', 'maxlength' => '15')) }}        
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

    <script type="text/javascript">
        $(function() {
            $("#btn-submit-repairman").click(function() {
                $("#form-add-repairman").submit();
            });

            $('#form-add-repairman').on('submit', function(event){                             
                var url = $(this).attr('action');
                var method = "<?php echo $method; ?>";
                event.preventDefault();

                $.ajax({
                    type: method,
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-repairman').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-repairman").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-repairman").append(data.errors);
                            $("#validation-errors-repairman").show();
                        }else{
                            window.location="{{URL::to('tecnicos/"+data.repairman.id+"')}}";
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