@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Pacientes <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.pacientes.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>    

   	<div class="row">
        <div class="form-group col-md-3">
        	<label>Cédula</label>
            <div>{{ $customer->cedula }}</div> 
        </div>
        <div class="form-group col-md-6">
            <label>Nombre</label>
            <div>{{ $customer->nombre }}</div> 
        </div>         
        <div class="form-group col-md-3">
            <label>Fecha nacimiento</label>
            <div>{{ $customer->fecha_nacimiento }}</div> 
        </div>
    </div>  

    <div class="row">
        <div class="form-group col-md-5">
            <label>Dirección</label>
            <div>{{ $customer->direccion }}</div> 
        </div>
        <div class="form-group col-md-4">
            <label>Teléfono</label>
            <div>{{ $customer->telefono }}</div> 
        </div>
    </div> 

    @if(@$permission->modifica)
    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('planilla.pacientes.edit', $customer->id) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
    @endif
@stop 