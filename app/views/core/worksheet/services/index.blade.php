@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
         	<h1 class="page-header">Servicios <small>(Planilla)</small></h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('planilla.servicios.create') }}" class="btn btn-success">Nueva servicio</a>
	        </div>
        @endif
    </div> 

	{{ Form::open(array('route' => 'planilla.servicios.index', 'method' => 'POST', 'id' => 'form-search-service'), array('role' => 'form')) }}
	<div class="row">	
	   	<div class="form-group col-md-3"></div>
	   	<div class="form-group col-md-6">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Ingrese nombre', 'class' => 'form-control', 'maxlength' => '50')) }}        
        </div>
	   	<div class="form-group col-md-3"></div>
 	</div> 	
 	<div class="row" align="center">
		<button type="submit" class="btn btn-primary">Buscar</button>
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-service' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="services">
		@include('core.worksheet.services.services')
	</div>

	<script type="text/javascript">		
		var service = { 			
			search : function(){
				window.Misc.search('form-search-service', 'services', '/planilla/servicios'); 
			},
			clearSearch : function(){
    			$('#nombre').val('')
			}
		}

		$("#form-search-service").submit(function( event ) {  
			event.preventDefault()
			service.search()	
		})

		$("#button-clear-search-service").click(function( event ) {  
			service.clearSearch()
			service.search()	
		})
	</script>
@stop