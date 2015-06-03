@extends ('core/layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Usuarios</h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
			<a href="{{ route('usuarios.create') }}" class="btn btn-primary">Nuevo usuario</a>					
	        </div>
        @endif
    </div> 
	
	<div id="users">
		@include('core.users.users')
	</div>

@stop