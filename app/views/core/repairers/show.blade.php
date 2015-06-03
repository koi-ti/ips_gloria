@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Técnicos</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('tecnicos.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>   

  	<div class="row">
        <div class="form-group col-md-4">
        	<label>Cédula</label>
            <div>{{ $repairman->cedula }}</div> 
        </div>
        <div class="form-group col-md-7">
            <label>Nombre</label>
            <div>{{ $repairman->nombre }}</div> 
        </div>
    </div>	

    <div class="row">
        <div class="form-group col-md-4">
            <label>Dirección</label>
            <div>{{ $repairman->direccion }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Ciudad</label>
            <div>{{ $city->nombre }}</div> 
        </div>
        <div class="form-group col-md-4">
            <label>Teléfono</label>
            <div>{{ $repairman->telefono }}</div> 
        </div>
    </div> 

    <div class="row">
        <div class="form-group col-md-4">
            <label>Dirección de E-mail</label>
            <div>{{ $repairman->email }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Estado</label>
            <div>{{ $repairman->states[$repairman->activo] }}</div>
        </div>
    </div> 
    @if(@$permission->modifica)
    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('tecnicos.edit', $repairman->id) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
    @endif
@stop 