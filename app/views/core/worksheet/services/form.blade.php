@extends ('core/layout')

<?php
    if ($service->exists):
        $form_data = array('route' => array('planilla.servicios.update', $service->id), 'method' => 'PATCH', 'id' => 'form-add-service');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'planilla.servicios.store', 'method' => 'POST', 'id' => 'form-add-service');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Servicios <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.servicios.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-service" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' servicio', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-service' )) }}        
    </div>
 	{{ Form::model($service, $form_data, array('role' => 'form')) }}
  	<div class="row">
        <div class="form-group col-md-6">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Ingrese Nombre', 'class' => 'form-control', 'maxlength' => '200')) }}        
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('porcentaje', 'Porcentaje') }}
            {{ Form::text('porcentaje', null, array('placeholder' => 'Porcentaje', 'class' => 'form-control')) }}        
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            {{ Form::label('valor', 'Valor') }}
            {{ Form::text('valor', null, array('placeholder' => 'Valor', 'class' => 'form-control')) }}        
        </div> 
        <div class="form-group col-md-3">
            {{ Form::label('descuento', 'Descuento') }}
            {{ Form::text('descuento', null, array('placeholder' => 'Descuento', 'class' => 'form-control')) }}        
        </div>   
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            {{ Form::label('examen', 'Exámen') }}
            {{ Form::checkbox('examen', 'check', null, null, ['id' => 'examen']) }}
        </div>      
    </div>

	{{ Form::close() }}

    <script type="text/javascript">
        $(function() {
            $("#btn-submit-service").click(function() {
                $("#form-add-service").submit();
            });

            $('#form-add-service').on('submit', function(event){                             
                var url = $(this).attr('action');
                var method = "<?php echo $method; ?>";
                event.preventDefault();

                $.ajax({
                    type: method,
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-service').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-service").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-service").append(data.errors);
                            $("#validation-errors-service").show();
                        }else{
                            window.location="{{URL::to('planilla/servicios/"+data.service.id+"')}}";
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