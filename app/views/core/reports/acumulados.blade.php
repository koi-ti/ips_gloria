@extends ('core/layout')

@section ('content')
	
	<div class="row">
        <div class="form-group col-md-8">
             <h1 class="page-header">Reportes / Acumulados</h1>
        </div>
        <div class="form-group col-md-2">
	        {{ Form::open(array('url' => array('reportes/acumulados'), 'method' => 'POST'), array('role' => 'form')) }}	
                {{ Form::hidden('type', 'xls') }}
                {{ Form::hidden('empresa_acumulados', isset($company) ? $company->id : '') }}
                {{ Form::hidden('fecha_inicial_acumulados', $fecha_inicial) }}
				{{ Form::hidden('fecha_final_acumulados', $fecha_final) }}
	        	<button type="submit" class="btn btn-danger">
					<span class="glyphicon glyphicon-file"></span>
        			Exportar XLS	
				</button>			
			{{ Form::close() }}
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('reportes.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div> 

    <div class="row">
        <div class="form-group col-md-6">
        	<label>Empresa</label>
            <div>{{ isset($company) ? $company->nombre : '' }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Fecha Inicial</label>
            <div>{{ $fecha_inicial }}</div> 
        </div>  
        <div class="form-group col-md-3">
            <label>Fecha Final</label>
            <div>{{ $fecha_final }}</div> 
        </div>          
    </div>
    <div class="panel-group" id="accordion-form" role="tablist" aria-multiselectable="true">
   		<div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-form" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Antecedentes Familiares
                </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-3"><span class="label label-primary">Enfermedad</span></div>
                        <div class="form-group col-md-3"><span class="label label-primary">Enfermedad</span></div>
                        <div class="form-group col-md-3"><span class="label label-primary">Enfermedad</span></div>
                        <div class="form-group col-md-3"><span class="label label-primary">Enfermedad</span></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <span class="badge">{{ $certificate->fenfermedad1 }}</span>
                            {{ Form::label('fenfermedad1', 'HTA') }}
                        </div>
                        <div class="form-group col-md-3">
                            <span class="badge">{{ $certificate->fenfermedad2 }}</span>
                            {{ Form::label('fenfermedad2', 'ACV') }}
                        </div>
                        <div class="form-group col-md-3">
                            <span class="badge">{{ $certificate->fenfermedad3 }}</span>
                            {{ Form::label('fenfermedad3', 'Diabetis') }}
                        </div>
                        <div class="form-group col-md-3">
                            <span class="badge">{{ $certificate->fenfermedad4 }}</span>
                            {{ Form::label('fenfermedad4', 'Cancer') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <span class="badge">{{ $certificate->fenfermedad5 }}</span>
                            {{ Form::label('fenfermedad5', 'Coronaria') }}
                        </div>
                        <div class="form-group col-md-3">
                            <span class="badge">{{ $certificate->fenfermedad6 }}</span>
                            {{ Form::label('fenfermedad6', 'Artritis') }}
                        </div>
                        <div class="form-group col-md-3">
                            <span class="badge">{{ $certificate->fenfermedad7 }}</span>
                            {{ Form::label('fenfermedad7', 'Alergias') }}
                        </div>
                        <div class="form-group col-md-3">
                            <span class="badge">{{ $certificate->fenfermedad8 }}</span>
                            {{ Form::label('fenfermedad8', 'Otra') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-form" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Antecedentes Personales
                </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad1 }}</span>
                            {{ Form::label('penfermedad1', 'Enfermedad') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad2 }}</span>
                            {{ Form::label('penfermedad2', 'Traumas Esguinces Fracturas') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad3 }}</span>
                            {{ Form::label('penfermedad3', 'Quirurgicos') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad4 }}</span>
                            {{ Form::label('penfermedad4', 'Intoxicaciones / Alergias') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad5 }}</span>
                            {{ Form::label('penfermedad5', 'Hospitalizaciones') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad6 }}</span>
                            {{ Form::label('penfermedad6', 'Transfusiones') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad7 }}</span>
                            {{ Form::label('penfermedad7', 'Transtornos mentales') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad8 }}</span>
                            {{ Form::label('penfermedad8', 'Farmacologicos') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad9 }}</span>
                            {{ Form::label('penfermedad9', 'Ginecoobstetrio') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad10 }}</span>
                            {{ Form::label('penfermedad10', 'Tetanos') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad11 }}</span>
                            {{ Form::label('penfermedad11', 'Vacuna fiebre amarilla') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad12 }}</span>
                            {{ Form::label('penfermedad12', 'Otras vacunas') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad13 }}</span>
                            {{ Form::label('penfermedad13', 'Fuma') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad14 }}</span>
                            {{ Form::label('penfermedad14', 'Toma') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="badge">{{ $certificate->penfermedad15 }}</span>
                            {{ Form::label('penfermedad15', 'Deporte') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingSix">
                <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-form" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    Examen Fisico
                </a>
                </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-3"><span class="label label-primary">Organo</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">N</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">A</span></div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n1', 'Cabeza') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n1 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a1 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n2', 'Ojos') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n2 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a2 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n3', 'Agudeza Visual') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n3 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a3 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n4', 'Nariz') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n4 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a4 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n5', 'Boca') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n5 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a5 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n6', 'Oidos') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n6 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a6 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n7', 'Torax') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n7 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a7 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n8', 'Corazon') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n8 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a8 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n9', 'Abdomen') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n9 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a9 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n10', 'Genitourinario') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n10 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a10 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n11', 'Columna') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n11 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a11 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n12', 'Extremidades') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n12 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a12 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n13', 'SNC') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n13 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a13 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('n14', 'Piel y Faneas') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->n14 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->a14 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingSeven">
                <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-form" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    Informe Examenes Adicionales
                </a>
                </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-3"><span class="label label-primary">Examen</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">SI</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">NO</span></div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('si1', 'PA') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->si1 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->no1 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('si2', 'SE') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->si2 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->no2 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('si3', 'Sist. Osteomuscular') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->si3 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->no3 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('si4', 'Varicocele') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->si4 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->no4 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('si5', 'Tunel del carpo') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->si5 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->no5 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('si6', 'Hernias') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->si6 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->no6 }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('si7', 'Manguito Rotador') }}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->si7 }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <span class="badge">{{ $certificate->no7 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingEight">
                <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-form" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    Aptitud
                </a>
                </h4>
            </div>
            <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->apto1 }}</span>
                            {{ Form::label('apto1', 'APTO CON LIMITACIONES (Que NO interfieren en su trabajo)') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->apto2 }}</span>
                            {{ Form::label('apto2', 'APTO CON LIMITACIONES (Que interfieren en su trabajo)') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->apto3 }}</span>
                            {{ Form::label('apto3', 'APTO CON LIMITACIONES (NO APTO para realizar la labor especifica)') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->apto4 }}</span>
                            {{ Form::label('apto4', 'APTO SIN LIMITACIONES') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->apto5 }}</span>
                            {{ Form::label('apto5', 'APTO PARA LABORAR EN ALTURAS') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12"><span class="label label-primary">Segun examenes solicitados por la empresa remitente</span></div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->examen1 }}</span>
                            {{ Form::label('examen1', 'EXAMEN DE INGRESO') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->examen2 }}</span>
                            {{ Form::label('examen2', 'EXAMEN PERIODICO') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->examen3 }}</span>
                            {{ Form::label('examen3', 'EXAMEN DE EGRESO') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->aplazado }}</span>
                            {{ Form::label('aplazado', 'APLAZADO') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion1 }}</span>
                            {{ Form::label('limitacion1', 'HIGIENE POSTURAL') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion2 }}</span>
                            {{ Form::label('limitacion2', 'USO DE ELEMENTOS DE PROTECCION') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion3 }}</span>
                            {{ Form::label('limitacion3', 'USA LENTES PERMANENTE') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion4 }}</span>
                            {{ Form::label('limitacion4', 'VALORACION POR S.O. ANUAL') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion5 }}</span>
                            {{ Form::label('limitacion5', 'CAPACITACION EN SU AREA DE TRABAJO') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion6 }}</span>
                            {{ Form::label('limitacion6', 'REMISION ESPECIALISTA') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion7 }}</span>
                            {{ Form::label('limitacion7', 'REALIZA PAUSAS EN SU LABOR') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion8 }}</span>
                            {{ Form::label('limitacion8', 'REALIZAR EXAMENES COMPLEMENTARIOS') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion9 }}</span>
                            {{ Form::label('limitacion9', 'ESQUEMA VACUNACION ADULTO') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion10 }}</span>
                            {{ Form::label('limitacion10', 'RECOMENDACION CREMAS HUMECTANTES PARA LA PIEL') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion11 }}</span>
                            {{ Form::label('limitacion11', 'HABITOS NUTRICIONALES ADECUADOS, REALIZAR ACTIVIDAD FISICA, CONTROL DE PESO, CONTROL MEDICO PERIODICO') }}
                        </div>
                        <div class="form-group col-md-4">
                            <span class="badge">{{ $certificate->limitacion12 }}</span>
                            {{ Form::label('limitacion12', 'CONTROL DE COMORBILIDAD EPS') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
   	</div>
	
@stop