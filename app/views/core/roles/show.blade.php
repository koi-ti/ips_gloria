@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Roles</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('roles.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  

  	<div class="row">
        <div class="form-group col-md-6">
        	<label>Nombre</label>
            <div>{{ $role->nombre }}</div> 
        </div>
    </div>	

    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
@stop 