@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Exámen <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.examen.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  

  	<div class="row">
        <div class="form-group col-md-6">
        	<label>Nombre</label>
            <div>{{ $exam->nombre }}</div> 
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label>Valor</label>
            <div>${{ number_format($exam->valor, 2,'.',',' ) }}</div> 
        </div>
    </div>
    
    @if(@$permission->modifica)
    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('planilla.examen.edit', $exam->id) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
    @endif
@stop 