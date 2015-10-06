@extends ('core/layout')

<?php
    if ($company->exists):
        $form_data = array('route' => array('empresas.update', $company->id), 'method' => 'PATCH', 'id' => 'form-add-company');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'empresas.store', 'method' => 'POST', 'id' => 'form-add-company');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Empresas</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('empresas.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-company" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' empresa', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-company' )) }}        
    </div>
 	{{ Form::model($company, $form_data, array('role' => 'form')) }}
  	<div class="row">
        <div class="form-group col-md-3">           
            {{ Form::label('nit', 'Nit') }}
            {{ Form::text('nit', null, array('placeholder' => 'Ingrese nit', 'class' => 'form-control', 'maxlength' => '15')) }}        
        </div>
        <div class="form-group col-md-7">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Ingrese Nombre', 'class' => 'form-control', 'maxlength' => '200')) }}        
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::label('activo', 'Estado') }}
            {{ Form::select('activo', Company::$states,null, array('class' => 'form-control')) }}
        </div>
    </div>

	{{ Form::close() }}

    <script type="text/javascript">
        $(function() {
            $("#btn-submit-company").click(function() {
                $("#form-add-company").submit();
            });

            $('#form-add-company').on('submit', function(event){                             
                var url = $(this).attr('action');
                var method = "<?php echo $method; ?>";
                event.preventDefault();

                $.ajax({
                    type: method,
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-company').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-company").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-company").append(data.errors);
                            $("#validation-errors-company").show();
                        }else{
                            window.location="{{URL::to('empresas/"+data.company.id+"')}}";
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