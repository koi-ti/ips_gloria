@extends ('core/layout')

<?php
    if ($city->exists):
        $form_data = array('route' => array('ciudades.update', $city->codigo), 'method' => 'PATCH', 'id' => 'form-add-city');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'ciudades.store', 'method' => 'POST', 'id' => 'form-add-city');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Ciudades</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('ciudades.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-city" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' ciudad', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-city' )) }}        
    </div>
 	{{ Form::model($city, $form_data, array('role' => 'form')) }}
  	<div class="row">
        <div class="form-group col-md-6">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('class' => 'form-control', 'maxlength' => '50')) }}        
        </div>
    </div>
	{{ Form::close() }}

    <script type="text/javascript">
        $(function() {
            $("#btn-submit-city").click(function() {
                $("#form-add-city").submit();
            });

            $('#form-add-city').on('submit', function(event){                             
                var url = $(this).attr('action');
                var method = "<?php echo $method; ?>";
                event.preventDefault();

                $.ajax({
                    type: method,
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-city').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-city").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-city").append(data.errors);
                            $("#validation-errors-city").show();
                        }else{
                            window.location="{{URL::to('ciudades/"+data.city.codigo+"')}}";
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