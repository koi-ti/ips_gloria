@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Empresas</h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('empresas.create') }}" class="btn btn-success">Nueva empresa</a>
	        </div>
        @endif
    </div> 

	{{ Form::open(array('route' => 'empresas.index', 'method' => 'POST', 'id' => 'form-search-company'), array('role' => 'form')) }}
	<div class="row">	
		<div class="form-group col-md-4">           
            {{ Form::label('nit', 'Nit') }}
            {{ Form::text('nit', null, array('placeholder' => 'Ingrese nit', 'class' => 'form-control', 'maxlength' => '15')) }}        
        </div>
	   	<div class="form-group col-md-7">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('class' => 'form-control', 'maxlength' => '50')) }}        
        </div>
 	</div> 	
 	<div class="row" align="center">
		<button type="submit" class="btn btn-primary">Buscar</button>
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-company' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="companys">
		@include('core.companys.companys')
	</div>

	<script type="text/javascript">		
		var company = { 			
			search : function(){
				window.Misc.search('form-search-company', 'companys', '/empresas'); 
			},
			clearSearch : function(){
    			$('#nit').val('')
    			$('#nombre').val('')
			}
		}

		$("#form-search-company").submit(function( event ) {  
			event.preventDefault()
			company.search()	
		})

		$("#button-clear-search-company").click(function( event ) {  
			company.clearSearch()
			company.search()	
		})
	</script>
@stop