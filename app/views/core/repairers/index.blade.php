@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Técnicos</h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('tecnicos.create') }}" class="btn btn-success">Nuevo técnico</a>
	        </div>
        @endif
    </div> 

	{{ Form::open(array('route' => 'roles.index', 'method' => 'POST', 'id' => 'form-search-repairers'), array('role' => 'form')) }}
	<div class="row">	
       <div class="form-group col-md-4">           
            {{ Form::label('cedula', 'Cédula') }}
            {{ Form::text('cedula', null, array('placeholder' => 'Ingresa Cédula', 'class' => 'form-control', 'maxlength' => '15')) }}        
        </div>
        <div class="form-group col-md-7">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Ingresa Nombre', 'class' => 'form-control', 'maxlength' => '100')) }}        
        </div>
 	</div> 	
 	<div class="row" align="center">
		<button type="submit" class="btn btn-primary">Buscar</button>
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-repairers' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="repairers">
		@include('core.repairers.repairers')
	</div>

	<script type="text/javascript">		
		var repairers = { 			
			search : function(){
				window.Misc.search('form-search-repairers', 'repairers', '/tecnicos'); 
			},
			clearSearch : function(){
    			$('#cedula').val('')
    			$('#nombre').val('')
			}
		}

		$("#form-search-repairers").submit(function( event ) {  
			event.preventDefault()
			repairers.search()	
		})

		$("#button-clear-search-repairers").click(function( event ) {  
			repairers.clearSearch()
			repairers.search()	
		})
	</script>
@stop