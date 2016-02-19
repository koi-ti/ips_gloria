@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Gastos <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.gastos.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  

  	<div class="row">
        <div class="form-group col-md-6">
        	<label>Nombre</label>
            <div>{{ $expense->nombre }}</div> 
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label>Valor</label>
            <div>${{ number_format($expense->valor, 2,'.',',' ) }}</div> 
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label>Fecha</label>
            <div>{{ $expense->fecha }}</div> 
        </div>
    </div> 

    @if(@$permission->modifica)
    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('planilla.gastos.edit', $expense->id) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
    @endif
@stop 