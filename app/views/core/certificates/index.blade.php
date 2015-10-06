@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Certificados</h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('certificados.create') }}" class="btn btn-success">Nuevo certificado</a>
	        </div>
	  	@endif
    </div> 

	{{ Form::open(array('method' => 'POST', 'id' => 'form-search-certificates'), array('role' => 'form')) }}
	<div class="row">
		<div class="form-group col-md-3">
            {{ Form::label('fecha', 'Fecha') }}
            <div class="input-append date"> 
                {{ Form::text('fecha', null, array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
            </div>
       	</div>
		<div class="form-group col-md-3">
            {{ Form::label('cliente_cedula', 'Cliente') }}
            {{ Form::text('cliente_cedula', null, array('placeholder' => 'Ingrese paciente', 'class' => 'form-control')) }}        
            {{ Form::hidden('cliente', null, array('id' => 'cliente')) }}
        </div>
        <div class="form-group col-md-6">           
            {{ Form::label('cliente_nombre', 'Nombre') }}
            <span class="glyphicon glyphicon-search" id="icon-search-customers-nombre" style="cursor: pointer;"></span>
            {{ Form::text('cliente_nombre', null, array('placeholder' => 'Nombre cliente', 'class' => 'form-control')) }}
        </div>
	</div>
    <div id="customers" class="row" align="center"></div>	
	<div class="row">
        <div class="form-group col-md-3"></div>
        <div class="form-group col-md-6">
			{{ Form::label('empresa', 'Empresa') }}
		 	{{ Form::select('empresa', array('' => 'Seleccione') + $companys ,null, array('class' => 'form-control')) }}
		</div>
        <div class="form-group col-md-3"></div>
 	</div> 	
 	<div class="row" align="center">
		<button type="submit" class="btn btn-primary">Buscar</button>
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-certificates' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="certificates">
		@include('core.certificates.certificates')
	</div>

	<script type="text/javascript">	
        $(function() {
	        $("#fecha").datepicker({
		        changeMonth: true,
	            changeYear: true,
	            dateFormat: "yy-mm-dd"              
	        })

	        $("#cliente_cedula").change(function() {
	            window.Misc.searchCustomer(); 
	        });

	        $("#icon-search-customers-nombre").click(function( event ) {  
	            window.Misc.searchCustomers($("#cliente_cedula").val(),$("#cliente_nombre").val()); 
	        })

			var certificates = { 			
				search : function(){
					window.Misc.search('form-search-certificates', 'certificates', '/certificados'); 
				},
				clearSearch : function() {
					$('#fecha').val('')
					$("#empresa").val('')

					$("#cliente_cedula").val('')
					$("#cliente_nombre").val('')
					$("#cliente").val('')
				}
			}

			$("#form-search-certificates").submit(function( event ) {  
				event.preventDefault()
				certificates.search()	
			})

			$("#button-clear-search-certificates").click(function( event ) {  
				certificates.clearSearch()
				certificates.search()	
			})
		});
	</script>
@stop