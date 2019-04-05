@extends ('core/layout')

@section ('content')
	
	<h1 class="page-header">Usuario</h1>

	<div class="row">
	    <div class="form-group col-md-4">
	        <a href="{{ route('usuarios.index') }}" class="btn btn-info">Lista de usuarios</a>
	    </div>
  	</div> 

	<div class="row">
		<div class="form-group col-md-4">
			<label>Nombre</label>
			<div>{{ $user->nombre }}</div> 
		</div>
		<div class="form-group col-md-4">
		    <label>Dirección de E-mail</label>
			<div>{{ $user->email }}</div>
		</div>
    </div>
    <div class="row">
		<div class="form-group col-md-4">
			<label>Rol</label>
			<div>{{ $role->nombre }}</div>
      	</div>
      	<div class="form-group col-md-4">
        	<label>Estado</label>
        	<div>{{ $user->states[$user->activo] }}</div>
        </div>  
    </div>
    <div class="row">
		<div class="form-group col-md-4">
			<label>Creación</label>
			<div>{{ $user->created_at }}</div>
      	</div>
      	<div class="form-group col-md-4">
        	<label>Actualización</label>
        	<div>{{ $user->updated_at }}</div>
        </div>  
    </div>
    <div class="row">
		<div class="form-group col-md-1">
			<label>Medico</label>
			<div>{{ $user->medico ? 'SI' : 'NO' }}</div>
      	</div>  
      	<div class="form-group col-md-3" style="display:@if($user->medico) block @else none @endif">
	    	<label>Cédula</label>
	        <div>{{ $user->cedula }}</div> 
	    </div>
      	<div class="form-group col-md-3" style="display:@if($user->medico) block @else none @endif">
        	<label>Numero de registro</label>
        	<div>{{ $user->registro }}</div>
        </div>
        <div class="form-group col-md-2" style="display:@if($user->medico) block @else none @endif">
        	<label>Firma</label>
        	<div>{{ $user->firma ? 'SI' : 'NO' }}</div>
        </div>
    </div>
    @if(@$permission->modifica)
    <p>			
		{{ Form::model($user, array('route' => array('usuarios.destroy', $user->id), 'method' => 'DELETE'), array('role' => 'form')) }}			
			<a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-success">Editar</a>		
			{{-- {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }} --}}
		{{ Form::close() }}
	</p>
	@endif	
@stop