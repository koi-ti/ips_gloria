@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-8">
             <h1 class="page-header">Certificados</h1>
        </div>
        <div class="form-group col-md-2">
            @if(@$permission->consulta)
                <a href="{{ route('certificados.reporte', $certificate->id) }}" class="btn btn-danger" target="_blank">
                    <span class="glyphicon glyphicon-file"></span>
                    Exportar PDF
                </a>
            @endif
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('certificados.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>    

   <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-9">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group col-md-2">
                    <label>Fecha</label>
                    <div>{{ $certificate->fecha }}</div> 
                </div>

                <div class="form-group col-md-5">
                    <label>Nombre</label>
                    <div>{{ $certificate->cliente_nombre }}</div> 
                </div>
                <div class="form-group col-md-3">
                    <label>Dirección</label>
                    <div>{{ $certificate->fecha }}</div>   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group col-md-10">
                    <label>Empresa</label>
                    <div>{{ $certificate->empresa_nombre }}</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <img src="{{ $certificate->cliente_imagen ? URL::asset($certificate->cliente_imagen) : URL::asset('images/default-avatar.png') }}" class="img-responsive" width="100" height="auto">       
            </div>
        </div>
    </div>

    <div class="panel-group" id="accordion-form" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-form" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Antecedentes Ocupacionales
                </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-2"><span class="label label-primary">Empresa</span></div>
                        {{-- <div class="form-group col-md-1"><span class="label label-primary">E A</span></div> --}}
                        <div class="form-group col-md-2"><span class="label label-primary">Tiempo</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Cargo</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Factores de riesgo</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Tipo de Riesgo</span></div>
                        <div class="form-group col-md-1"><span class="label label-primary">Epp</span></div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            <div>{{ $certificate->oempresa1 }}</div>   
                        </div>

                        {{-- <div class="form-group col-md-1">
                            <div>{{ $certificate->oae1 }}</div>   
                        </div> --}}

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->otiempo1 }}</div>   
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->ocargo1 }}</div>   
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->ofactor1 ? $certificate->ofactor1 : '' }}</div>   
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->otipo1 }}</div>   
                        </div>
                        
                        <div class="form-group col-md-2">
                            <div>{{ $certificate->oepp1 }}</div>   
                        </div>   
                    </div> 

                    <div class="row">
                        <div class="form-group col-md-2">
                            <div>{{ $certificate->oempresa2 }}</div>   
                        </div>

                        {{-- <div class="form-group col-md-1">
                            <div>{{ $certificate->oae2 }}</div>   
                        </div> --}}

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->otiempo2 }}</div>   
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->ocargo2 }}</div>   
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->ofactor2 ? $certificate->ofactor2 : '' }}</div>   
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->otipo2 }}</div>   
                        </div>
                        
                        <div class="form-group col-md-2">
                            <div>{{ $certificate->oepp2 }}</div>   
                        </div>    
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            <div>{{ $certificate->oempresa3 }}</div>   
                        </div>

                        {{-- <div class="form-group col-md-1">
                            <div>{{ $certificate->oae3 }}</div>   
                        </div> --}}

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->otiempo3 }}</div>   
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->ocargo3 }}</div>   
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->ofactor3 ? $certificate->ofactor3 : '' }}</div>   
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->otipo3 }}</div>   
                        </div>
                        
                        <div class="form-group col-md-2">
                            <div>{{ $certificate->oepp3 }}</div>   
                        </div>    
                    </div>  
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="label label-warning">{{ Certificate::getFactores() }}</span>   
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-form" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Antecedentes Laborales y Enfermedad Profesional
                </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-2"><span class="label label-primary">Empresa</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Fecha</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Causa</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Diagnostico</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Factores de riesgo</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Incapacidad / Secuelas</span></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <div>{{ $certificate->lempresa1 }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->lfecha1 }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->lcausa1 }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->ldiagnostico1 }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->lfactor1 }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->lincapacidad1 }}</div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <div>{{ $certificate->lempresa2 }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->lfecha2 }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->lcausa2 }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->ldiagnostico2 }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->lfactor2 }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>{{ $certificate->lincapacidad2 }}</div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-form" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Antecedentes Familiares
                </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-1"><span class="label label-primary">Enfermedad</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Parentesco</span></div>
                        <div class="form-group col-md-1"><span class="label label-primary">Enfermedad</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Parentesco</span></div>
                        <div class="form-group col-md-1"><span class="label label-primary">Enfermedad</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Parentesco</span></div>
                        <div class="form-group col-md-1"><span class="label label-primary">Enfermedad</span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Parentesco</span></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad1', 'check', $certificate->fenfermedad1, ['disabled' => 'disabled']) }}
                            {{ Form::label('fenfermedad1', 'HTA') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ $certificate->fparentesco1 }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad2', 'check', $certificate->fenfermedad2, ['disabled' => 'disabled']) }}
                            {{ Form::label('fenfermedad2', 'ACV') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ $certificate->fparentesco2 }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad3', 'check', $certificate->fenfermedad3, ['disabled' => 'disabled']) }}
                            {{ Form::label('fenfermedad3', 'Diabetes') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ $certificate->fparentesco3 }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad4', 'check', $certificate->fenfermedad4, ['disabled' => 'disabled']) }}
                            {{ Form::label('fenfermedad4', 'Cancer') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ $certificate->fparentesco4 }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad5', 'check', $certificate->fenfermedad5, ['disabled' => 'disabled']) }}
                            {{ Form::label('fenfermedad5', 'Coronaria') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ $certificate->fparentesco5 }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad6', 'check', $certificate->fenfermedad6, ['disabled' => 'disabled']) }}
                            {{ Form::label('fenfermedad6', 'Artritis') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ $certificate->fparentesco6 }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad7', 'check', $certificate->fenfermedad7, ['disabled' => 'disabled']) }}
                            {{ Form::label('fenfermedad7', 'Alergias') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ $certificate->fparentesco7 }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad8', 'check', $certificate->fenfermedad8, ['disabled' => 'disabled']) }}
                            {{ Form::label('fenfermedad8', 'Otra') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ $certificate->fparentesco8 }}
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
                        <div class="form-group col-md-3"><span class="label label-primary"></span></div>
                        <div class="form-group col-md-2"><span class="label label-primary">Fecha</span></div>
                        <div class="form-group col-md-7"><span class="label label-primary">Descripción y Tratamiento</span></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad1', 'check', $certificate->penfermedad1, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad1', 'Enfermedad') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha1 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento1 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad2', 'check', $certificate->penfermedad2, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad2', 'Traumas Esguinces Fracturas') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha2 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento2 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad3', 'check', $certificate->penfermedad3, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad3', 'Quirurgicos') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha3 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento3 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad4', 'check', $certificate->penfermedad4, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad4', 'Intoxicaciones / Alergias') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha4 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento4 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad5', 'check', $certificate->penfermedad5, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad5', 'Hospitalizaciones') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha5 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento5 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad6', 'check', $certificate->penfermedad6, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad6', 'Transfusiones') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha6 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento6 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad7', 'check', $certificate->penfermedad7, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad7', 'Transtornos mentales') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha7 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento7 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad8', 'check', $certificate->penfermedad8, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad8', 'Farmacologicos') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha8 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento8 }}}                        
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad9', 'check', $certificate->penfermedad9, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad9', 'Ginecoobstetrio') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha9 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento9 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad10', 'check', $certificate->penfermedad10, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad10', 'Tetanos') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha10 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento10 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad11', 'check', $certificate->penfermedad11, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad11', 'Vacuna fiebre amarilla') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha11 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento11 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad12', 'check', $certificate->penfermedad12, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad12', 'Otras vacunas') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha12 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento12 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad13', 'check', $certificate->penfermedad13, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad13', 'Fuma') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha13 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento13 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad14', 'check', $certificate->penfermedad14, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad14', 'Toma') }}
                        </div>
                        <div class="form-group col-md-2"> 
                            {{{ $certificate->pfecha14 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento14 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad15', 'check', $certificate->penfermedad15, ['disabled' => 'disabled']) }}
                            {{ Form::label('penfermedad15', 'Deporte') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{{ $certificate->pfecha15 }}}
                        </div>
                        <div class="form-group col-md-7">
                            {{{ $certificate->ptratamiento15 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3"></div>
                        <div class="form-group col-md-2">
                            <span>HEMOCLASIFICACION</span>
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('grupo', 'Grupo Sanguineo') }}
                            {{{ $certificate->grupo }}}        
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('rh', 'RH') }}
                            {{{ $certificate->rh }}}
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
                        <div class="form-group col-md-2">
                            {{ Form::label('peso', 'Peso (Kg)') }}
                            {{{ $certificate->peso }}}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('estatura', 'Estatura (cm)') }}
                            {{{ $certificate->estatura }}}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('imc', 'IMC') }}
                            {{{ $certificate->imc }}}
                            <span class="label label-warning" id="imc_text"></span>
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('lateridad', 'Lateralidad') }}
                            {{{ $certificate->lateridad ? Certificate::$lateralidad[$certificate->lateridad] : '' }}}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('ta', 'TA') }}
                            {{{ $certificate->ta }}}
                        </div>
                        <div class="form-group col-md-2">
                            <span class="label label-warning">{{ in_array($certificate->hipertension, array_keys(Certificate::$hipertension)) ? Certificate::$hipertension[$certificate->hipertension] : '' }}</span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('fc', 'FC') }}
                            {{{ $certificate->fc }}}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('fr', 'FR') }}
                            {{{ $certificate->fr }}}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('t', 'T') }}
                            {{{ $certificate->t }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2"><span class="label label-primary">Organo</span></div>
                        <div class="form-group col-md-1"><span class="label label-primary">N</span></div>
                        <div class="form-group col-md-1"><span class="label label-primary">A</span></div>
                        <div class="form-group col-md-8"><span class="label label-primary">Hallazgos</span></div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n1', 'Cabeza') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n1', 'check', $certificate->n1, ['id' => 'n1', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a1', 'check', $certificate->a1, ['id' => 'a1', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo1 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n2', 'Ojos') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n2', 'check', $certificate->n2, ['id' => 'n2', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a2', 'check', $certificate->a2, ['id' => 'a2', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo2 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n3', 'Agudeza Visual') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n3', 'check', $certificate->n3, ['id' => 'n3', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a3', 'check', $certificate->a3, ['id' => 'a3', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo3 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n4', 'Nariz') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n4', 'check', $certificate->n4, ['id' => 'n4', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a4', 'check', $certificate->a4, ['id' => 'a4', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo4 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n5', 'Boca') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n5', 'check', $certificate->n5, ['id' => 'n5', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a5', 'check', $certificate->a5, ['id' => 'a5', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo5 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n6', 'Oidos') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n6', 'check', $certificate->n6, ['id' => 'n6', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a6', 'check', $certificate->a6, ['id' => 'a6', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo6 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n7', 'Torax') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n7', 'check', $certificate->n7, ['id' => 'n7', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a7', 'check', $certificate->a7, ['id' => 'a7', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo7 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n8', 'Corazon') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n8', 'check', $certificate->n8, ['id' => 'n8', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a8', 'check', $certificate->a8, ['id' => 'a8', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo8 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n9', 'Abdomen') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n9', 'check', $certificate->n9, ['id' => 'n9', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a9', 'check', $certificate->a9, ['id' => 'a9', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ in_array($certificate->hallazgo9, array_keys(Certificate::$abdomen)) ? Certificate::$abdomen[$certificate->hallazgo9] : $certificate->hallazgo9 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n10', 'Genitourinario') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n10', 'check', $certificate->n10, ['id' => 'n10', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a10', 'check', $certificate->a10, ['id' => 'a10', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo10 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n11', 'Columna') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n11', 'check', $certificate->n11, ['id' => 'n11', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a11', 'check', $certificate->a11, ['id' => 'a11', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ in_array($certificate->hallazgo11, array_keys(Certificate::$columna)) ? Certificate::$columna[$certificate->hallazgo11] : $certificate->hallazgo11 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n12', 'Extremidades') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n12', 'check', $certificate->n12, ['id' => 'n12', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a12', 'check', $certificate->a12, ['id' => 'a12', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ in_array($certificate->hallazgo12, array_keys(Certificate::$extremidades)) ? Certificate::$extremidades[$certificate->hallazgo12] : $certificate->hallazgo12 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n13', 'SNC') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n13', 'check', $certificate->n13, ['id' => 'n13', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a13', 'check', $certificate->a13, ['id' => 'a13', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo13 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n14', 'Piel y Faneas') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n14', 'check', $certificate->n14, ['id' => 'n14', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a14', 'check', $certificate->a14, ['id' => 'a14', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo14 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n15', 'Várices') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n15', 'check', $certificate->n15, ['id' => 'n15', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a15', 'check', $certificate->a15, ['id' => 'a15', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ in_array($certificate->hallazgo16, array_keys(Certificate::$varices)) ? Certificate::$varices[$certificate->hallazgo16] : $certificate->hallazgo16 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::label('hallazgo15', 'Observaciones complementarias') }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->hallazgo15 }}}
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
                        <div class="form-group col-md-2"><span class="label label-primary">Examen</span></div>
                        <div class="form-group col-md-1"><span class="label label-primary">SI</span></div>
                        <div class="form-group col-md-1"><span class="label label-primary">NO</span></div>
                        <div class="form-group col-md-8"><span class="label label-primary">Observaciones</span></div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('si3', 'Sist. Osteomuscular') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('si3', 'check', $certificate->si3, ['id' => 'si3', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('no3', 'check', $certificate->no3, ['id' => 'no3', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->observacion3 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('si4', 'Varicocele') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('si4', 'check', $certificate->si4, ['id' => 'si4', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('no4', 'check', $certificate->no4, ['id' => 'no4', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->observacion4 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('si5', 'Tunel del carpo') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('si5', 'check', $certificate->si5, ['id' => 'si5', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('no5', 'check', $certificate->no5, ['id' => 'no5', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->observacion5 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('si6', 'Hernias') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('si6', 'check', $certificate->si6, ['id' => 'si6', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('no6', 'check', $certificate->no6, ['id' => 'no6', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->observacion6 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('si7', 'Manguito Rotador') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('si7', 'check', $certificate->si7, ['id' => 'si7', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('no7', 'check', $certificate->no7, ['id' => 'no7', 'disabled' => 'disabled']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->observacion7 }}}
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
                            {{ Form::checkbox('apto1', 'check', $certificate->apto1, ['disabled' => 'disabled']) }}
                            {{ Form::label('apto1', 'APTO CON LIMITACIONES (Que NO interfieren en su trabajo)') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('apto2', 'check', $certificate->apto2, ['disabled' => 'disabled']) }}
                            {{ Form::label('apto2', 'APTO CON LIMITACIONES (Que interfieren en su trabajo)') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('apto3', 'check', $certificate->apto3, ['disabled' => 'disabled']) }}
                            {{ Form::label('apto3', 'APTO CON LIMITACIONES (NO APTO para realizar la labor especifica)') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('apto4', 'check', $certificate->apto4, ['disabled' => 'disabled']) }}
                            {{ Form::label('apto4', 'APTO SIN LIMITACIONES') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('apto5', 'check', $certificate->apto5, ['disabled' => 'disabled']) }}
                            {{ Form::label('apto5', 'APTO PARA LABORAR EN ALTURAS') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12"><span class="label label-primary">Segun examenes solicitados por la empresa remitente</span></div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('examen1', 'check', $certificate->examen1, ['disabled' => 'disabled']) }}
                            {{ Form::label('examen1', 'EXAMEN DE INGRESO') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('examen2', 'check', $certificate->examen2, ['disabled' => 'disabled']) }}
                            {{ Form::label('examen2', 'EXAMEN PERIODICO') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('examen3', 'check', $certificate->examen3, ['disabled' => 'disabled']) }}
                            {{ Form::label('examen3', 'EXAMEN DE EGRESO') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('aplazado', 'check', $certificate->aplazado, ['disabled' => 'disabled']) }}
                            {{ Form::label('aplazado', 'APLAZADO') }}
                        </div>
                        <div class="form-group col-md-8">
                            {{{ $certificate->razon }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('aplazado', 'IMPRESION DIAGNOSTICA') }}
                        </div>
                        <div class="form-group col-md-9">
                            {{{ $certificate->diagnostica1 }}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3"></div>
                        <div class="form-group col-md-9">
                            {{{ $certificate->diagnostica2 }}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3"></div>
                        <div class="form-group col-md-9">
                            {{{ $certificate->diagnostica3 }}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion1', 'check', $certificate->limitacion1, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion1', 'HIGIENE POSTURAL') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion2', 'check', $certificate->limitacion2, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion2', 'USO DE ELEMENTOS DE PROTECCION') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion3', 'check', $certificate->limitacion3, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion3', 'USA LENTES PERMANENTE') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion4', 'check', $certificate->limitacion4, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion4', 'VALORACION POR S.O. ANUAL') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion5', 'check', $certificate->limitacion5, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion5', 'CAPACITACION EN SU AREA DE TRABAJO') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion6', 'check', $certificate->limitacion6, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion6', 'REMISION ESPECIALISTA') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion7', 'check', $certificate->limitacion7, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion7', 'REALIZA PAUSAS EN SU LABOR') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion8', 'check', $certificate->limitacion8, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion8', 'REALIZAR EXAMENES COMPLEMENTARIOS') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion9', 'check', $certificate->limitacion9, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion9', 'ESQUEMA VACUNACION ADULTO') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion10', 'check', $certificate->limitacion10, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion10', 'RECOMENDACION CREMAS HUMECTANTES PARA LA PIEL') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion11', 'check', $certificate->limitacion11, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion11', 'HABITOS NUTRICIONALES ADECUADOS, REALIZAR ACTIVIDAD FISICA, CONTROL DE PESO, CONTROL MEDICO PERIODICO') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion12', 'check', $certificate->limitacion12, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion12', 'CONTROL DE COMORBILIDAD EPS') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion13', 'check', $certificate->limitacion13, ['disabled' => 'disabled']) }}
                            {{ Form::label('limitacion13', 'SEROLOGIA') }}
                        </div>
                        <div class="form-group col-md-4">
                            <div>{{{ in_array($certificate->embarazo, array_keys(Certificate::$embarazo)) ? Certificate::$embarazo[$certificate->embarazo] : Certificate::$embarazo['NA'] }}}</div>
                            {{ Form::label('embarazo', 'PRUEBA DE EMBARAZO') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if(@$permission->modifica)
    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('certificados.edit', $certificate->id) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
    @endif

    <script type="text/javascript">
        $(function() {
            window.Misc.setIMCEval('{{ $certificate->imc }}');
        });
    </script>
@stop 