@extends ('core/layout')

@section ('content')

   	<div class="row">		
	  	<div class="form-group col-md-4">
			<a href="{{ route('usuarios.create') }}" class="btn btn-primary">Nuevo usuario</a>					
		</div>					
	</div>
	
	<div id="users">
		@include('core.users.users')
	</div>

@stop