@extends ('core/layout')

<?php
    if ($role->exists):
        $form_data = array('route' => array('roles.update', $role->id), 'method' => 'PATCH', 'id' => 'form-add-role');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'roles.store', 'method' => 'POST', 'id' => 'form-add-role');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Roles</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('roles.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-role" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' rol', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-role' )) }}        
    </div>
 	{{ Form::model($role, $form_data, array('role' => 'form')) }}
  	<div class="row">
        <div class="form-group col-md-6">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('class' => 'form-control', 'maxlength' => '50')) }}        
        </div>
    </div>
	{{ Form::close() }}

    <script type="text/javascript">
        $(function() {
            $("#btn-submit-role").click(function() {
                $("#form-add-role").submit();
            });

            $('#form-add-role').on('submit', function(event){                             
                var url = $(this).attr('action');
                var method = "<?php echo $method; ?>";
                event.preventDefault();

                $.ajax({
                    type: method,
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-role').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-role").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-role").append(data.errors);
                            $("#validation-errors-role").show();
                        }else{
                            window.location="{{URL::to('roles/"+data.role.id+"')}}";
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