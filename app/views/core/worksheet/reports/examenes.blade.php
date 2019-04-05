@extends ('core/layout')

@section ('content')
	
	<div class="row">
        <div class="form-group col-md-8">
             <h1 class="page-header">Resumen exámenes medicos</h1>
        </div>
        <div class="form-group col-md-2">
	        {{ Form::open(array('url' => ['planilla/reportes/examenes'], 'method' => 'POST'), array('role' => 'form')) }}	
                {{ Form::hidden('type', 'xls') }}
                {{ Form::hidden('fecha_inicial_examenes', $fecha_inicial_examenes) }}
	        	<button type="submit" class="btn btn-danger">
					<span class="glyphicon glyphicon-file"></span>
        			Exportar XLS	
				</button>			
			{{ Form::close() }}
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.reportes.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div> 

    @include('core.worksheet.reports.exameneshtml')
@stop