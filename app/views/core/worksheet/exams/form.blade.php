@extends ('core/layout')

<?php
    if ($exam->exists):
        $form_data = array('route' => array('planilla.examen.update', $exam->id), 'method' => 'PATCH', 'id' => 'form-add-exam');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'planilla.examen.store', 'method' => 'POST', 'id' => 'form-add-exam');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Exámen <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.examen.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-exam" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' exámen', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-service' )) }}        
    </div>
 	{{ Form::model($exam, $form_data, array('role' => 'form')) }}
  	<div class="row">
        <div class="form-group col-md-6">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Ingrese Nombre', 'class' => 'form-control', 'maxlength' => '200')) }}        
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            {{ Form::label('valor', 'Valor') }}
            {{ Form::text('valor', null, array('placeholder' => 'Valor', 'class' => 'form-control')) }}        
        </div>  
    </div>

	{{ Form::close() }}

    <script type="text/javascript">
        $(function() {
            $("#btn-submit-service").click(function() {
                $("#form-add-exam").submit();
            });

            $('#form-add-exam').on('submit', function(event){                             
                var url = $(this).attr('action');
                var method = "<?php echo $method; ?>";
                event.preventDefault();

                $.ajax({
                    type: method,
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-exam').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-exam").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-exam").append(data.errors);
                            $("#validation-errors-exam").show();
                        }else{
                            window.location="{{URL::to('planilla/examen/"+data.exam.id+"')}}";
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