@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Ciudades</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('ciudades.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  

  	<div class="row">
        <div class="form-group col-md-6">
        	<label>Nombre</label>
            <div>{{ $city->nombre }}</div> 
        </div>
    </div>	
    @if(@$permission->modifica)
    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('ciudades.edit', $city->codigo) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
    @endif
@stop 