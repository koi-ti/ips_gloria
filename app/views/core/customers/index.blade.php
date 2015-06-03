@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Clientes</h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('clientes.create') }}" class="btn btn-success">Nuevo cliente</a>
	        </div>
	  	@endif
    </div> 

	{{ Form::open(array('method' => 'POST', 'id' => 'form-search-customers'), array('role' => 'form')) }}
	<div class="row">	
       <div class="form-group col-md-4">           
            {{ Form::label('nit', 'Nit') }}
            {{ Form::text('nit', null, array('placeholder' => 'Ingresa Nit', 'class' => 'form-control', 'maxlength' => '15')) }}        
        </div>
        <div class="form-group col-md-7">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Ingresa Nombre', 'class' => 'form-control', 'maxlength' => '100')) }}        
        </div>
 	</div> 	
 	<div class="row" align="center">
		<button type="submit" class="btn btn-primary">Buscar</button>
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-customers' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="customers">
		@include('core.customers.customers')
	</div>

	<script type="text/javascript">		
		var customers = { 			
			search : function(){
				window.Misc.search('form-search-customers', 'customers', '/clientes'); 
			},
			clearSearch : function(){
    			$('#nit').val('')
    			$('#nombre').val('')
			}
		}

		$("#form-search-customers").submit(function( event ) {  
			event.preventDefault()
			customers.search()	
		})

		$("#button-clear-search-customers").click(function( event ) {  
			customers.clearSearch()
			customers.search()	
		})
	</script>
@stop