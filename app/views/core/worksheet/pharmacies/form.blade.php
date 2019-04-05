@extends ('core/layout')

<?php
    if ($pharmacy->exists):
        $form_data = array('route' => array('planilla.farmacia.update', $pharmacy->id), 'method' => 'PATCH', 'id' => 'form-add-pharmacy');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'planilla.farmacia.store', 'method' => 'POST', 'id' => 'form-add-pharmacy');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Farmacia <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.farmacia.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-pharmacy" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' registro', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-pharmacy' )) }}        
    </div>
 	{{ Form::model($pharmacy, $form_data, array('role' => 'form')) }}
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
            $("#btn-submit-pharmacy").click(function() {
                $("#form-add-pharmacy").submit();
            });

            $('#form-add-pharmacy').on('submit', function(event){                             
                var url = $(this).attr('action');
                var method = "<?php echo $method; ?>";
                event.preventDefault();

                $.ajax({
                    type: method,
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-pharmacy').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-pharmacy").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-pharmacy").append(data.errors);
                            $("#validation-errors-pharmacy").show();
                        }else{
                            window.location="{{URL::to('planilla/farmacia/"+data.pharmacy.id+"')}}";
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