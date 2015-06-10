@extends ('core.layout')

@section ('content')
	
	<h1 class="page-header">Reportes</h1>
	<div class="panel-group" id="accordion-reportes" role="tablist" aria-multiselectable="true">
		{{--*/ $permission = Report::getPermission('reportorder'); /*--}}        
		@if(@$permission->consulta) 
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingFour">
				<h4 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion-reportes" href="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
					Ordenes
				</a>
				</h4>
			</div>
			<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
				<div class="panel-body">
					{{ Form::open(array('url' => array('reportes/ordenes'), 'method' => 'POST', 'id' => 'form-reporte-ventas'), array('role' => 'form')) }}
						<div class="row" align="center">
						<div class="form-group col-md-3"></div>
						<div class="form-group col-md-3">
							{{ Form::label('fecha_inicial_ordenes', 'Fecha Inicial') }}
				            <div class="input-append date">	
				            	{{ Form::text('fecha_inicial_ordenes', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
				        	</div>
						</div>
						<div class="form-group col-md-3">
							{{ Form::label('fecha_final_ordenes', 'Fecha Final') }}
				            <div class="input-append date">	
				            	{{ Form::text('fecha_final_ordenes', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
				        	</div>
						</div>
						<div class="form-group col-md-3"></div>
					</div>
					<p align="center">
						{{ Form::submit('Generar', array('class' => 'btn btn-info')) }}
					</p>
					{{ Form::close() }}
				</div>
			</div>
		</div>
		@endif

		{{--*/ $permission = Report::getPermission('reportopenorder'); /*--}}        
		@if(@$permission->consulta)
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingFive">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion-reportes" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
						Ordenes abiertas
					</a>
				</h4>
			</div>
			<div id="collapseFive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFive">
				<div class="panel-body">
					{{ Form::open(array('url' => array('reportes/ordenesabiertas'), 'method' => 'POST'), array('role' => 'form')
						) }}									
						<div class="row" align="center">
							<div class="form-group col-md-3">
					            {{ Form::label('cliente_nit', 'Cliente') }}
					            {{ Form::text('cliente_nit', null, array('placeholder' => 'Ingrese cliente', 'class' => 'form-control')) }}        
					            {{ Form::hidden('cliente', null, array('id' => 'cliente')) }}
					        </div>
					        <div class="form-group col-md-6">           
					            {{ Form::label('cliente_nombre', 'Nombre') }}
					            <span class="glyphicon glyphicon-search" id="icon-search-customers-nombre" style="cursor: pointer;"></span>
					            {{ Form::text('cliente_nombre', null, array('placeholder' => 'Nombre cliente', 'class' => 'form-control')) }}                    
					        </div>
					        <div class="form-group col-md-3">
					            {{ Form::label('cliente_direccion', 'Dirección') }}
					            {{ Form::select('cliente_direccion', isset($address) ? $address + array('' => 'Seleccione') : array('' => 'Seleccione') ,null, array('class' => 'form-control')) }}
					        </div> 
						</div>	
					    <div id="customers" class="row" align="center"></div>

						<div class="row" align="center">
							<div class="form-group col-md-3"></div>
							<div class="form-group col-md-3">
								{{ Form::label('fecha_inicial_oabiertas', 'Fecha Inicial') }}
					            <div class="input-append date">	
					            	{{ Form::text('fecha_inicial_oabiertas', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
					        	</div>
							</div>
							<div class="form-group col-md-3">
								{{ Form::label('fecha_final_oabiertas', 'Fecha Final') }}
					            <div class="input-append date">	
					            	{{ Form::text('fecha_final_oabiertas', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
					        	</div>
							</div>
							<div class="form-group col-md-3"></div>
						</div>
						<p align="center">
							{{ Form::submit('Generar', array('class' => 'btn btn-info')) }}
						</p>
					{{ Form::close() }}	
				</div>
			</div>
		</div>
		@endif

		{{--*/ $permission = Report::getPermission('reportoutvisit'); /*--}}        
		@if(@$permission->consulta)
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne">
				<h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion-reportes" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
						Ordenes abiertas sin visitas
					</a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
				<div class="panel-body">
					{{ Form::open(array('url' => array('reportes/ordenessinvisitas'), 'method' => 'POST'), array('role' => 'form')) }}									
						<div class="row" align="center">
							<div class="form-group col-md-3"></div>
							<div class="form-group col-md-3">
								{{ Form::label('fecha_inicial_osinvisitas', 'Fecha Inicial') }}
					            <div class="input-append date">	
					            	{{ Form::text('fecha_inicial_osinvisitas', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
					        	</div>
							</div>
							<div class="form-group col-md-3">
								{{ Form::label('fecha_final_osinvisitas', 'Fecha Final') }}
					            <div class="input-append date">	
					            	{{ Form::text('fecha_final_osinvisitas', date('Y-m-d'), array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
					        	</div>
							</div>
							<div class="form-group col-md-3"></div>
						</div>
						<p align="center">
							{{ Form::submit('Generar', array('class' => 'btn btn-info')) }}
						</p>
					{{ Form::close() }}	
				</div>
			</div>
		</div>	
		@endif
	</div>

    <script type="text/javascript">
        $(function() {
        	// Reporte Ordenes Abiertas
            $("#cliente_nit").change(function() {
                $('#cliente_direccion').find('option:gt(0)').remove();
                window.Misc.searchCustomer(true); 
			});

			$("#fecha_inicial_oabiertas").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })
			$("#fecha_final_oabiertas").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })

            $("#icon-search-customers-nombre").click(function( event ) {  
            	window.Misc.searchCustomers($("#cliente_nit").val(),$("#cliente_nombre").val()); 
        	})

        	// Reporte Ordenes Sin visitas
			$("#fecha_inicial_osinvisitas").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })
			$("#fecha_final_osinvisitas").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })

        	// Reporte Ordenes
			$("#fecha_inicial_ordenes").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })
			$("#fecha_final_ordenes").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" })
        });
    </script>
@stop