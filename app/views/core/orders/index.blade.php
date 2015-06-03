@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Ordenes de servicio</h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('ordenes.create') }}" class="btn btn-success">Nueva orden</a>
	        </div>
        @endif
    </div> 

	{{ Form::open(array('route' => 'ordenes.index', 'method' => 'POST', 'id' => 'form-search-orders'), array('role' => 'form')) }}
	<div class="row">	
        <div class="form-group col-md-3">
            {{ Form::label('cliente_nit', 'Cliente') }}
            <span class="glyphicon glyphicon-user" id="customer-glyphicon" style="cursor: pointer;"></span>            
            {{ Form::text('cliente_nit', null, array('placeholder' => 'Ingrese cliente', 'class' => 'form-control')) }}        
            {{ Form::hidden('cliente', null, array('id' => 'cliente')) }}
        </div>
        <div class="form-group col-md-6">           
            {{ Form::label('cliente_nombre', 'Nombre') }}
            {{ Form::text('cliente_nombre', null, array('placeholder' => 'Ingresa Nombre', 'class' => 'form-control')) }}        
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('cliente_direccion', 'Dirección') }}
            {{ Form::select('cliente_direccion', array('' => 'Seleccione') ,null, array('class' => 'form-control')) }}
        </div> 
 	</div> 	
 	<div class="row" align="center">
		<button type="submit" class="btn btn-primary">Buscar</button>
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-orders' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="orders">
		@include('core.orders.orders')
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