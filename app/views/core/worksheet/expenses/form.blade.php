@extends ('core/layout')

<?php
    if ($expense->exists):
        $form_data = array('route' => array('planilla.gastos.update', $expense->id), 'method' => 'PATCH', 'id' => 'form-add-expense');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'planilla.gastos.store', 'method' => 'POST', 'id' => 'form-add-expense');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Gastos <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.gastos.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-expenses" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' gasto', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-expense' )) }}        
    </div>
 	{{ Form::model($expense, $form_data, array('role' => 'form')) }}
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
    
    <div class="row">
        <div class="form-group col-md-3">
            {{ Form::label('fecha', 'Fecha') }}
            <div class="input-append date"> 
                {{ Form::text('fecha', $expense->exists ? null : date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
            </div>
        </div>
    </div>


	{{ Form::close() }}

    <script type="text/javascript">
        $(function() {
            $("#btn-submit-expense").click(function() {
                $("#form-add-expense").submit();
            });

            $("#fecha").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });

            $('#form-add-expense').on('submit', function(event){                             
                var url = $(this).attr('action');
                var method = "<?php echo $method; ?>";
                event.preventDefault();

                $.ajax({
                    type: method,
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-expense').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-expenses").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-expenses").append(data.errors);
                            $("#validation-errors-expenses").show();
                        }else{
                            window.location="{{URL::to('planilla/gastos/"+data.expense.id+"')}}";
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