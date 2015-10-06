@extends ('core.layout')

@section ('content')
	
	<h1 class="page-header">Reportes</h1>
	<div class="panel-group" id="accordion-reportes" role="tablist" aria-multiselectable="true">
		{{--*/ $permission = Report::getPermission('reportacumulate'); /*--}}        
		@if(@$permission->consulta) 
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingFour">
				<h4 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion-reportes" href="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
					Reporte Acumulados
				</a>
				</h4>
			</div>
			<div id="collapseFour" class="panel-collapse" role="tabpanel" aria-labelledby="headingFour">
				<div class="panel-body">
					{{ Form::open(array('url' => array('reportes/acumulados'), 'method' => 'POST', 'id' => 'form-reporte-acumulados'), array('role' => 'form')) }}
						{{ Form::hidden('type', 'view') }}
						<div class="row" align="center">
						<div class="form-group col-md-1"></div>
						<div class="form-group col-md-4">
							{{ Form::label('empresa_acumulados', 'Empresa') }}
               			 	{{ Form::select('empresa_acumulados', array('' => 'Seleccione') + $companys ,null, array('class' => 'form-control')) }}
						</div>
						<div class="form-group col-md-3">
							{{ Form::label('fecha_inicial_acumulados', 'Fecha Inicial') }}
				            <div class="input-append date">	
				            	{{ Form::text('fecha_inicial_acumulados', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
				        	</div>
						</div>
						<div class="form-group col-md-3">
							{{ Form::label('fecha_final_acumulados', 'Fecha Final') }}
				            <div class="input-append date">	
				            	{{ Form::text('fecha_final_acumulados', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
				        	</div>
						</div>
						<div class="form-group col-md-1"></div>
					</div>
					<p align="center">
						{{ Form::button('Generar', array('class' => 'btn btn-info', 'id' => 'btn-submit-reporte-acumulados' )) }}
					</p>
					{{ Form::close() }}
				</div>
			</div>
		</div>
		@endif
	</div>

    <script type="text/javascript">
        $(function() {
        	// Reporte Acumulados
            $("#fecha_inicial_acumulados").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })
			$("#fecha_final_acumulados").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })

			$("#btn-submit-reporte-acumulados").click(function() {
	           	if(!$("#fecha_inicial_acumulados").val()){
	            	alertify.error("Por favor seleccione fecha inicial.");
	            	return
	            }
	            if(!$("#fecha_final_acumulados").val()){
	            	alertify.error("Por favor seleccione fecha final.");
	            	return
	            }
				$("#form-reporte-acumulados").submit();
			});
        });
    </script>
@stop