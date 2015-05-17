@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Roles</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('roles.create') }}" class="btn btn-success">Nuevo rol</a>
        </div>
    </div> 

	{{ Form::open(array('route' => 'roles.index', 'method' => 'POST', 'id' => 'form-search-roles'), array('role' => 'form')) }}
	<div class="row">	
	   	<div class="form-group col-md-6">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('class' => 'form-control', 'maxlength' => '50')) }}        
        </div>
 	</div> 	
 	<div class="row" align="center">
		<button type="submit" class="btn btn-primary">Buscar</button>
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-roles' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="roles">
		@include('core.roles.roles')
	</div>

	<script type="text/javascript">		
		var roles = { 			
			search : function(){
				window.Misc.search('form-search-roles', 'roles', '/roles'); 
			},
			clearSearch : function(){
    			$('#nombre').val('')
			}
		}

		$("#form-search-roles").submit(function( event ) {  
			event.preventDefault()
			roles.search()	
		})

		$("#button-clear-search-roles").click(function( event ) {  
			roles.clearSearch()
			roles.search()	
		})
	</script>
@stop