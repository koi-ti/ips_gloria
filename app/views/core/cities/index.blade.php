@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Ciudades</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('ciudades.create') }}" class="btn btn-success">Nueva ciudad</a>
        </div>
    </div> 

	{{ Form::open(array('route' => 'ordenes.index', 'method' => 'POST', 'id' => 'form-search-cities'), array('role' => 'form')) }}
	<div class="row">	

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
				window.Misc.search('form-search-orders', 'orders', '/ordenes'); 
			},
			clearSearch : function(){
    			$('#cliente_nit').val('')
    			$('#cliente').val('')
    			$('#cliente_nombre').val('')
	        	$('#cliente_direccion').find('option:gt(0)').remove();
			}
		}

		$("#form-search-orders").submit(function( event ) {  
			event.preventDefault()
			orders.search()	
		})

		$("#button-clear-search-orders").click(function( event ) {  
			orders.clearSearch()
			orders.search()	
		})

        $("#cliente_nit").change(function() {
            window.Misc.searchCustomer(true); 
        });
	</script>
@stop