@extends ('core.layout')

@section ('content')
	
	<h1 class="page-header">Reportes</h1>
	<div class="panel-group" id="accordion-reportes" role="tablist" aria-multiselectable="true">
		{{--*/ $permission = WorksheetReport::getPermission('worksheetreportdaily'); /*--}}        
		@if(@$permission->consulta)
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne">
				<h4 class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#accordion-reportes" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Resumen diario
					</a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				<div class="panel-body">
					{{ Form::open(array('url' => ['planilla/reportes/resumen'], 'method' => 'POST', 'id' => 'form-reporte-resumen'), array('role' => 'form')) }}
						{{ Form::hidden('type', 'view') }}
						<div class="row" align="center">
						<div class="form-group col-md-4"></div>
						<div class="form-group col-md-4">
							{{ Form::label('fecha_resumen', 'Fecha') }}
				            <div class="input-append date">	
				            	{{ Form::text('fecha_resumen', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
				        	</div>
						</div>
						<div class="form-group col-md-4"></div>
					</div>
					<p align="center">
						{{ Form::button('Generar', ['class' => 'btn btn-info', 'id' => 'btn-submit-reporte-resumen']) }}
					</p>
					{{ Form::close() }}				
				</div>
			</div>
		</div>
		@endif 

		{{--*/ $permission = WorksheetReport::getPermission('worksheetreportpharmacy'); /*--}}        
		@if(@$permission->consulta)
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingTwo">
				<h4 class="panel-title">
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-reportes" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						Resumen ventas farmacia
					</a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
				<div class="panel-body">
					{{ Form::open(array('url' => ['planilla/reportes/framacia'], 'method' => 'POST', 'id' => 'form-reporte-farmacia'), array('role' => 'form')) }}
						{{ Form::hidden('type', 'view') }}
						<div class="row" align="center">
						<div class="form-group col-md-4"></div>
						<div class="form-group col-md-4">
							{{ Form::label('fecha_inicial_farmacia', 'Fecha') }}
				            <div class="input-append date">	
				            	{{ Form::text('fecha_inicial_farmacia', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
				        	</div>
						</div>
						<div class="form-group col-md-4"></div>
					</div>
					<p align="center">
						{{ Form::button('Generar', array('class' => 'btn btn-info', 'id' => 'btn-submit-reporte-farmacia' )) }}
					</p>
					{{ Form::close() }}
				</div>
			</div>
		</div>
		@endif

		{{--*/ $permission = WorksheetReport::getPermission('worksheetreportexams'); /*--}}        
		@if(@$permission->consulta)
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingThree">
				<h4 class="panel-title">
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-reportes" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						Resumen exámenes medicos
					</a>
				</h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
				<div class="panel-body">
					{{ Form::open(array('url' => ['planilla/reportes/examenes'], 'method' => 'POST', 'id' => 'form-reporte-examenes'), array('role' => 'form')) }}
						{{ Form::hidden('type', 'view') }}
						<div class="row" align="center">
						<div class="form-group col-md-4"></div>
						<div class="form-group col-md-4">
							{{ Form::label('fecha_inicial_examenes', 'Fecha') }}
				            <div class="input-append date">	
				            	{{ Form::text('fecha_inicial_examenes', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
				        	</div>
						</div>
						<div class="form-group col-md-4"></div>
					</div>
					<p align="center">
						{{ Form::button('Generar', array('class' => 'btn btn-info', 'id' => 'btn-submit-reporte-examenes' )) }}
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
            $("#fecha_resumen").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })
			$("#fecha_inicial_farmacia").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })
			$("#fecha_inicial_examenes").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })

			// Reporte resumen
			$("#btn-submit-reporte-resumen").click(function() {
	           	if(!$("#fecha_resumen").val()){
	            	alertify.error("Por favor seleccione fecha.");
	            	return
	            }
				$("#form-reporte-resumen").submit();
			});

			// Reporte farmacia
			$("#btn-submit-reporte-farmacia").click(function() {
	           	if(!$("#fecha_inicial_farmacia").val()){
	            	alertify.error("Por favor seleccione fecha.");
	            	return
	            }
				$("#form-reporte-farmacia").submit();
			});

			// Reporte examenes
			$("#btn-submit-reporte-examenes").click(function() {
	           	if(!$("#fecha_inicial_examenes").val()){
	            	alertify.error("Por favor seleccione fecha.");
	            	return
	            }
				$("#form-reporte-examenes").submit();
			});
        });
    </script>
@stop