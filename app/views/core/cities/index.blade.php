@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Ciudades</h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('ciudades.create') }}" class="btn btn-success">Nueva ciudad</a>
	        </div>
        @endif
    </div> 

	{{ Form::open(array('route' => 'ciudades.index', 'method' => 'POST', 'id' => 'form-search-cities'), array('role' => 'form')) }}
	<div class="row">	
	   	<div class="form-group col-md-6">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('class' => 'form-control', 'maxlength' => '50')) }}        
        </div>
 	</div> 	
 	<div class="row" align="center">
		<button type="submit" class="btn btn-primary">Buscar</button>
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-cities' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="cities">
		@include('core.cities.cities')
	</div>

	<script type="text/javascript">		
		var orders = { 			
			search : function(){
				window.Misc.search('form-search-cities', 'cities', '/ciudades'); 
			},
			clearSearch : function(){
    			$('#nombre').val('')
			}
		}

		$("#form-search-cities").submit(function( event ) {  
			event.preventDefault()
			orders.search()	
		})

		$("#button-clear-search-cities").click(function( event ) {  
			orders.clearSearch()
			orders.search()	
		})
	</script>
@stop