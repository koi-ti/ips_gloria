@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Empresas</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('empresas.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  

  	<div class="row">
        <div class="form-group col-md-3">
            <label>Nit</label>
            <div>{{ $company->nit }}</div> 
        </div>
        <div class="form-group col-md-7">
        	<label>Nombre</label>
            <div>{{ $company->nombre }}</div> 
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label>Estado</label>
            <div>{{ Company::$states[$company->activo] }}</div>
        </div>
    </div>

    @if(@$permission->modifica)
    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('empresas.edit', $company->id) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
    @endif
@stop 