@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Servicios <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.servicios.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  

  	<div class="row">
        <div class="form-group col-md-6">
        	<label>Nombre</label>
            <div>{{ $service->nombre }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Porcentaje</label>
            <div>{{ $service->porcentaje }}%</div> 
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label>Valor</label>
            <div>${{ number_format($service->valor, 2,'.',',' ) }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Descuento</label>
            <div>${{ number_format($service->descuento, 2,'.',',' ) }}</div> 
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-1">
            <label>Exámen</label>
            <div>{{ $service->examen ? 'SI' : 'NO' }}</div>
        </div>
    </div> 

    @if(@$permission->modifica)
    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('planilla.servicios.edit', $service->id) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
    @endif
@stop 