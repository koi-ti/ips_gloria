@extends ('core/layout')

<?php
    if ($certificate->exists):
        $form_data = array('route' => array('certificados.update', $certificate->id), 'method' => 'PATCH', 'id' => 'form-add-certificate');
        $action    = 'Editar';
        $method = 'PATCH';
    else:
        $form_data = array('route' => 'certificados.store', 'method' => 'POST', 'id' => 'form-add-certificate');
        $action    = 'Crear';
        $method = 'POST';
    endif;
?>

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Certificados</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('certificados.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  
  	<div id="validation-errors-certificate" style="display: none"></div>

    <div align="center">
        {{ Form::button($action . ' certificado', array('type' => 'button','class' => 'btn btn-success', 'id' => 'btn-submit-certificate' )) }}        
    </div>
 	{{ Form::model($certificate, $form_data, array('role' => 'form')) }}
    
    <br/>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-9">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group col-md-3">
                    {{ Form::label('fecha', 'Fecha') }}
                    <div class="input-append date"> 
                        {{ Form::text('fecha', null, array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
                    </div>
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('cliente_cedula', 'Cliente') }}
                    {{ Form::text('cliente_cedula', isset($customer) ? $customer->cedula : '', array('placeholder' => 'Ingrese paciente', 'class' => 'form-control')) }}        
                    {{ Form::hidden('cliente', null, array('id' => 'cliente')) }}
                </div>
                <div class="form-group col-md-6">           
                    {{ Form::label('cliente_nombre', 'Nombre') }}
                    <span class="glyphicon glyphicon-search" id="icon-search-customers-nombre" style="cursor: pointer;"></span>
                    {{ Form::text('cliente_nombre', isset($customer) ? $customer->nombre : '', array('placeholder' => 'Nombre paciente', 'class' => 'form-control')) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group col-md-12">
                    {{ Form::label('empresa', 'Empresa') }}
                    {{ Form::select('empresa', array('' => 'Seleccione') + $companys ,null, array('class' => 'form-control')) }}
                </div> 
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                <img src="{{ isset($customer) && $customer->imagen ? URL::asset($customer->imagen) : URL::asset('images/default-avatar.png') }}" name="cliente_imagen" id="cliente_imagen"  class="img-responsive" width="100" height="auto"> 
            </div>
        </div>
    </div>
    <div id="customers" class="row" align="center"></div>


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
                            {{ Form::text('oempresa1', null, array('placeholder' => 'Empresa', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        {{-- <div class="form-group col-md-1">
                            {{ Form::text('oae1', null, array('placeholder' => 'A E', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div> --}}

                        <div class="form-group col-md-2">
                            {{ Form::text('otiempo1', null, array('placeholder' => 'Tiempo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('ocargo1', null, array('placeholder' => 'Cargo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{-- {{ Form::text('ofactor1', null, array('placeholder' => 'Factores de riesgo', 'class' => 'form-control', 'maxlength' => 255)) }} --}}
                            {{ Form::select('ofactor1', Certificate::$factores, ($certificate->ofactor1 ? explode(',',$certificate->ofactor1) : null),['name' => 'ofactor1[]', 'multiple'=>'multiple', 'class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('otipo1', null, array('placeholder' => 'Tipo de Riesgo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>
                        
                        <div class="form-group col-md-2">
                            {{ Form::text('oepp1', null, array('placeholder' => 'Epp', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>   
                    </div> 

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::text('oempresa2', null, array('placeholder' => 'Empresa', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        {{-- <div class="form-group col-md-1">
                            {{ Form::text('oae2', null, array('placeholder' => 'A E', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div> --}}

                        <div class="form-group col-md-2">
                            {{ Form::text('otiempo2', null, array('placeholder' => 'Tiempo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('ocargo2', null, array('placeholder' => 'Cargo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{-- {{ Form::text('ofactor2', null, array('placeholder' => 'Factores de riesgo', 'class' => 'form-control', 'maxlength' => 255)) }} --}}
                            {{ Form::select('ofactor2', Certificate::$factores, ($certificate->ofactor3 ? explode(',',$certificate->ofactor3) : null), ['name' => 'ofactor2[]', 'multiple'=>'multiple', 'class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('otipo2', null, array('placeholder' => 'Tipo de Riesgo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>
                        
                        <div class="form-group col-md-2">
                            {{ Form::text('oepp2', null, array('placeholder' => 'Epp', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>   
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::text('oempresa3', null, array('placeholder' => 'Empresa', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        {{-- <div class="form-group col-md-1">
                            {{ Form::text('oae3', null, array('placeholder' => 'A E', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div> --}}

                        <div class="form-group col-md-2">
                            {{ Form::text('otiempo3', null, array('placeholder' => 'Tiempo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('ocargo3', null, array('placeholder' => 'Cargo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{-- {{ Form::text('ofactor3', null, array('placeholder' => 'Factores de riesgo', 'class' => 'form-control', 'maxlength' => 255)) }} --}}
                            {{ Form::select('ofactor3', Certificate::$factores, ($certificate->ofactor3 ? explode(',',$certificate->ofactor3) : null), ['name' => 'ofactor3[]', 'multiple'=>'multiple', 'class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('otipo3', null, array('placeholder' => 'Tipo de Riesgo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>
                        
                        <div class="form-group col-md-2">
                            {{ Form::text('oepp3', null, array('placeholder' => 'Epp', 'class' => 'form-control', 'maxlength' => 255)) }}
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
                            {{ Form::text('lempresa1', null, array('placeholder' => 'Empresa', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('lfecha1', null, ['id' => 'lfecha1', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('lcausa1', null, array('placeholder' => 'Causa', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('ldiagnostico1', null, array('placeholder' => 'Diagnostico', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('lfactor1', null, array('placeholder' => 'Factores de riesgo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('lincapacidad1', null, array('placeholder' => 'Incapacidad / Secuelas', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>  
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::text('lempresa2', null, array('placeholder' => 'Empresa', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('lfecha2', null, ['id' => 'lfecha2', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('lcausa2', null, array('placeholder' => 'Causa', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('ldiagnostico2', null, array('placeholder' => 'Diagnostico', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('lfactor2', null, array('placeholder' => 'Factores de riesgo', 'class' => 'form-control', 'maxlength' => 255)) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::text('lincapacidad2', null, array('placeholder' => 'Incapacidad / Secuelas', 'class' => 'form-control', 'maxlength' => 255)) }}
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
                            {{ Form::checkbox('fenfermedad1', 'check', null) }}
                            {{ Form::label('fenfermedad1', 'HTA') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::text('fparentesco1', null, array('class' => 'form-control', 'maxlength' => 100)) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad2', 'check', null) }}
                            {{ Form::label('fenfermedad2', 'ACV') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::text('fparentesco2', null, array('class' => 'form-control', 'maxlength' => 100)) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad3', 'check', null) }}
                            {{ Form::label('fenfermedad3', 'Diabetes') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::text('fparentesco3', null, array('class' => 'form-control', 'maxlength' => 100)) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad4', 'check', null) }}
                            {{ Form::label('fenfermedad4', 'Cancer') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::text('fparentesco4', null, array('class' => 'form-control', 'maxlength' => 100)) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad5', 'check', null) }}
                            {{ Form::label('fenfermedad5', 'Coronaria') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::text('fparentesco5', null, array('class' => 'form-control', 'maxlength' => 100)) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad6', 'check', null) }}
                            {{ Form::label('fenfermedad6', 'Artritis') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::text('fparentesco6', null, array('class' => 'form-control', 'maxlength' => 100)) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad7', 'check', null) }}
                            {{ Form::label('fenfermedad7', 'Alergias') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::text('fparentesco7', null, array('class' => 'form-control', 'maxlength' => 100)) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('fenfermedad8', 'check', null) }}
                            {{ Form::label('fenfermedad8', 'Otra') }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::text('fparentesco8', null, array('class' => 'form-control', 'maxlength' => 100)) }}
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
                            {{ Form::checkbox('penfermedad1', 'check', null) }}
                            {{ Form::label('penfermedad1', 'Enfermedad') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha1', null, ['id' => 'pfecha1', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento1', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad2', 'check', null) }}
                            {{ Form::label('penfermedad2', 'Traumas Esguinces Fracturas') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha2', null, ['id' => 'pfecha2', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento2', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad3', 'check', null) }}
                            {{ Form::label('penfermedad3', 'Quirurgicos') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha3', null, ['id' => 'pfecha3', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento3', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad4', 'check', null) }}
                            {{ Form::label('penfermedad4', 'Intoxicaciones / Alergias') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha4', null, ['id' => 'pfecha4', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento4', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad5', 'check', null) }}
                            {{ Form::label('penfermedad5', 'Hospitalizaciones') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha5', null, ['id' => 'pfecha5', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento5', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad6', 'check', null) }}
                            {{ Form::label('penfermedad6', 'Transfusiones') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha6', null, ['id' => 'pfecha6', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento6', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad7', 'check', null) }}
                            {{ Form::label('penfermedad7', 'Transtornos mentales') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha7', null, ['id' => 'pfecha7', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento7', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad8', 'check', null) }}
                            {{ Form::label('penfermedad8', 'Farmacologicos') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha8', null, ['id' => 'pfecha8', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento8', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad9', 'check', null) }}
                            {{ Form::label('penfermedad9', 'Ginecoobstetrio') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha9', null, ['id' => 'pfecha9', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento9', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad10', 'check', null) }}
                            {{ Form::label('penfermedad10', 'Tetanos') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha10', null, ['id' => 'pfecha10', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento10', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad11', 'check', null) }}
                            {{ Form::label('penfermedad11', 'Vacuna fiebre amarilla') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha11', null, ['id' => 'pfecha11', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento11', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad12', 'check', $certificate->exists ? null : true) }}
                            {{ Form::label('penfermedad12', 'Otras vacunas') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha12', null, ['id' => 'pfecha12', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento12', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad13', 'check', null) }}
                            {{ Form::label('penfermedad13', 'Fuma') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha13', null, ['id' => 'pfecha13', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento13', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad14', 'check', null) }}
                            {{ Form::label('penfermedad14', 'Toma') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha14', null, ['id' => 'pfecha14', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento14', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::checkbox('penfermedad15', 'check', null) }}
                            {{ Form::label('penfermedad15', 'Deporte') }}
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input-append date"> 
                                {{ Form::text('pfecha15', null, ['id' => 'pfecha15', 'placeholder' => 'yyyy-mm-dd', 'class' => 'form-control', 'maxlength' => 10]) }}        
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            {{ Form::text('ptratamiento15', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3"></div>
                        <div class="form-group col-md-2">
                            <span>HEMOCLASIFICACION</span>
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('grupo', 'Grupo Sanguineo') }}
                            {{ Form::text('grupo', null, ['class' => 'form-control', 'maxlength' => 5]) }}        
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('rh', 'RH') }}
                            {{ Form::text('rh', null, ['class' => 'form-control', 'maxlength' => 5]) }}
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
                            {{ Form::text('peso', null, array('class' => 'form-control', 'maxlength' => 30)) }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('estatura', 'Estatura (cm)') }}
                            {{ Form::text('estatura', null, array('class' => 'form-control', 'maxlength' => 30)) }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('imc', 'IMC') }}
                            {{ Form::text('imc', null, array('class' => 'form-control', 'maxlength' => 20, 'readonly' => 'readonly')) }}
                            <span class="label label-warning" id="imc_text"></span>
                        </div>
                        
                        <div class="form-group col-md-2">
                            {{ Form::label('lateridad', 'Lateralidad') }}
                            {{ Form::select('lateridad', ['' => 'Seleccione'] + Certificate::$lateralidad ,null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::label('ta', 'TA') }}
                            {{ Form::text('ta', null, array('class' => 'form-control', 'maxlength' => 30)) }}
                        </div>
                         <div class="form-group col-md-2">
                            <label>&nbsp;</label>
                            {{ Form::select('hipertension', ['' => 'Seleccione'] + Certificate::$hipertension ,null, array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('fc', 'FC') }}
                            {{ Form::text('fc', null, array('class' => 'form-control', 'maxlength' => 30)) }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('fr', 'FR') }}
                            {{ Form::text('fr', null, array('class' => 'form-control', 'maxlength' => 30)) }}
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('t', 'T') }}
                            {{ Form::text('t', null, array('class' => 'form-control', 'maxlength' => 30)) }}
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
                            {{ Form::checkbox('n1', 'check', $certificate->exists ? null : true, ['id' => 'n1']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a1', 'check', null, ['id' => 'a1']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo1', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n2', 'Ojos') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n2', 'check', $certificate->exists ? null : true, ['id' => 'n2']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a2', 'check', null, ['id' => 'a2']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo2', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n3', 'Agudeza Visual') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n3', 'check', $certificate->exists ? null : true, ['id' => 'n3']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a3', 'check', null, ['id' => 'a3']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo3', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n4', 'Nariz') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n4', 'check', $certificate->exists ? null : true, ['id' => 'n4']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a4', 'check', null, ['id' => 'a4']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo4', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n5', 'Boca') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n5', 'check', $certificate->exists ? null : true, ['id' => 'n5']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a5', 'check', null, ['id' => 'a5']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo5', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n6', 'Oidos') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n6', 'check', $certificate->exists ? null : true, ['id' => 'n6']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a6', 'check', null, ['id' => 'a6']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo6', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n7', 'Torax') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n7', 'check', $certificate->exists ? null : true, ['id' => 'n7']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a7', 'check', null, ['id' => 'a7']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo7', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n8', 'Corazon') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n8', 'check', $certificate->exists ? null : true, ['id' => 'n8']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a8', 'check', null, ['id' => 'a8']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo8', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n9', 'Abdomen') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n9', 'check', $certificate->exists ? null : true, ['id' => 'n9']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a9', 'check', null, ['id' => 'a9']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::select('hallazgo9', array('' => 'Seleccione') + Certificate::$abdomen, null, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n10', 'Genitourinario') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n10', 'check', $certificate->exists ? null : true, ['id' => 'n10']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a10', 'check', null, ['id' => 'a10']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo10', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n11', 'Columna') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n11', 'check', $certificate->exists ? null : true, ['id' => 'n11']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a11', 'check', null, ['id' => 'a11']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::select('hallazgo11', array('' => 'Seleccione') + Certificate::$columna, null, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n12', 'Extremidades') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n12', 'check', $certificate->exists ? null : true, ['id' => 'n12']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a12', 'check', null, ['id' => 'a12']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::select('hallazgo12', array('' => 'Seleccione') + Certificate::$extremidades, null, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n13', 'SNC') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n13', 'check', $certificate->exists ? null : true, ['id' => 'n13']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a13', 'check', null, ['id' => 'a13']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo13', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n14', 'Piel y Faneas') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n14', 'check', $certificate->exists ? null : true, ['id' => 'n14']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a14', 'check', null, ['id' => 'a14']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo14', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('n15', 'Várices ') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('n15', 'check', $certificate->exists ? null : true, ['id' => 'n15']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('a15', 'check', null, ['id' => 'a15']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::select('hallazgo16', array('' => 'Seleccione') + Certificate::$varices, null, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::label('hallazgo15', 'Observaciones complementarias') }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('hallazgo15', null, array('class' => 'form-control', 'maxlength' => 200)) }}
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
                            {{ Form::checkbox('si3', 'check', $certificate->exists ? null : true, ['id' => 'si3']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('no3', 'check', null, ['id' => 'no3']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('observacion3', $certificate->exists ? null : 'Negativo', array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('si4', 'Varicocele') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('si4', 'check', null, ['id' => 'si4']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('no4', 'check', $certificate->exists ? null : true, ['id' => 'no4']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('observacion4', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('si5', 'Tunel del carpo') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('si5', 'check', $certificate->exists ? null : true, ['id' => 'si5']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('no5', 'check', null, ['id' => 'no5']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('observacion5', $certificate->exists ? null : 'Negativo', array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('si6', 'Hernias') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('si6', 'check', $certificate->exists ? null : true, ['id' => 'si6']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('no6', 'check', null, ['id' => 'no6']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('observacion6', $certificate->exists ? null : 'Negativo', array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            {{ Form::label('si7', 'Manguito Rotador') }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('si7', 'check', $certificate->exists ? null : true, ['id' => 'si7']) }}
                        </div>
                        <div class="form-group col-md-1">
                            {{ Form::checkbox('no7', 'check', null, ['id' => 'no7']) }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('observacion7', $certificate->exists ? null : 'Negativo', array('class' => 'form-control', 'maxlength' => 200)) }}
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
                            {{ Form::checkbox('apto1', 'check', null) }}
                            {{ Form::label('apto1', 'APTO CON LIMITACIONES (Que NO interfieren en su trabajo)') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('apto2', 'check', null) }}
                            {{ Form::label('apto2', 'APTO CON LIMITACIONES (Que interfieren en su trabajo)') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('apto3', 'check', null) }}
                            {{ Form::label('apto3', 'APTO CON LIMITACIONES (NO APTO para realizar la labor especifica)') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('apto4', 'check', null) }}
                            {{ Form::label('apto4', 'APTO SIN LIMITACIONES') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('apto5', 'check', null) }}
                            {{ Form::label('apto5', 'APTO PARA LABORAR EN ALTURAS') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12"><span class="label label-primary">Segun examenes solicitados por la empresa remitente</span></div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('examen1', 'check', null) }}
                            {{ Form::label('examen1', 'EXAMEN DE INGRESO') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('examen2', 'check', null) }}
                            {{ Form::label('examen2', 'EXAMEN PERIODICO') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('examen3', 'check', null) }}
                            {{ Form::label('examen3', 'EXAMEN DE EGRESO') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('aplazado', 'check', null) }}
                            {{ Form::label('aplazado', 'APLAZADO') }}
                        </div>
                        <div class="form-group col-md-8">
                            {{ Form::text('razon', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('diagnostica1', 'IMPRESION DIAGNOSTICA') }}
                        </div>
                        <div class="form-group col-md-9">
                            {{ Form::text('diagnostica1', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3"></div>
                        <div class="form-group col-md-9">
                            {{ Form::text('diagnostica2', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3"></div>
                        <div class="form-group col-md-9">
                            {{ Form::text('diagnostica3', null, array('class' => 'form-control', 'maxlength' => 200)) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion1', 'check', null) }}
                            {{ Form::label('limitacion1', 'HIGIENE POSTURAL') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion2', 'check', null) }}
                            {{ Form::label('limitacion2', 'USO DE ELEMENTOS DE PROTECCION') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion3', 'check', null) }}
                            {{ Form::label('limitacion3', 'USA LENTES PERMANENTE') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion4', 'check', null) }}
                            {{ Form::label('limitacion4', 'VALORACION POR S.O. ANUAL') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion5', 'check', null) }}
                            {{ Form::label('limitacion5', 'CAPACITACION EN SU AREA DE TRABAJO') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion6', 'check', null) }}
                            {{ Form::label('limitacion6', 'REMISION ESPECIALISTA') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion7', 'check', null) }}
                            {{ Form::label('limitacion7', 'REALIZA PAUSAS EN SU LABOR') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion8', 'check', null) }}
                            {{ Form::label('limitacion8', 'REALIZAR EXAMENES COMPLEMENTARIOS') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion9', 'check', null) }}
                            {{ Form::label('limitacion9', 'ESQUEMA VACUNACION ADULTO') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion10', 'check', null) }}
                            {{ Form::label('limitacion10', 'RECOMENDACION CREMAS HUMECTANTES PARA LA PIEL') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion11', 'check', null) }}
                            {{ Form::label('limitacion11', 'HABITOS NUTRICIONALES ADECUADOS, REALIZAR ACTIVIDAD FISICA, CONTROL DE PESO, CONTROL MEDICO PERIODICO') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion12', 'check', null) }}
                            {{ Form::label('limitacion12', 'CONTROL DE COMORBILIDAD EPS') }}
                        </div>
                    </div>

                     <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::checkbox('limitacion13', 'check', null) }}
                            {{ Form::label('limitacion13', 'SEROLOGIA') }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::select('embarazo', Certificate::$embarazo, null, ['class' => 'form-control']) }}
                            {{ Form::label('embarazo', 'PRUEBA DE EMBARAZO') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	{{ Form::close() }}
    
    <script type="text/javascript">
        $(function() {
            $("#cliente_cedula").change(function() {
                window.Misc.searchCustomer(); 
            });

            $("#icon-search-customers-nombre").click(function( event ) {  
                window.Misc.searchCustomers($("#cliente_cedula").val(),$("#cliente_nombre").val()); 
            })

            $("#fecha").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            
            $("#lfecha1").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#lfecha2").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
                        
            $("#pfecha1").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha2").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha3").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha4").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha5").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha6").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha7").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha8").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha9").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha10").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha11").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha12").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha13").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha14").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            $("#pfecha15").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });

            $("#n1").on('click', function() { if ($('#n1').is(":checked")) { $("#a1").prop("checked", false); } });
            $("#a1").on('click', function() { if ($('#a1').is(":checked")) { $("#n1").prop("checked", false); } });
            $("#n2").on('click', function() { if ($('#n2').is(":checked")) { $("#a2").prop("checked", false); } });
            $("#a2").on('click', function() { if ($('#a2').is(":checked")) { $("#n2").prop("checked", false); } });
            $("#n3").on('click', function() { if ($('#n3').is(":checked")) { $("#a3").prop("checked", false); } });
            $("#a3").on('click', function() { if ($('#a3').is(":checked")) { $("#n3").prop("checked", false); } });
            $("#n4").on('click', function() { if ($('#n4').is(":checked")) { $("#a4").prop("checked", false); } });
            $("#a4").on('click', function() { if ($('#a4').is(":checked")) { $("#n4").prop("checked", false); } });
            $("#n5").on('click', function() { if ($('#n5').is(":checked")) { $("#a5").prop("checked", false); } });
            $("#a5").on('click', function() { if ($('#a5').is(":checked")) { $("#n5").prop("checked", false); } });
            $("#n6").on('click', function() { if ($('#n6').is(":checked")) { $("#a6").prop("checked", false); } });
            $("#a6").on('click', function() { if ($('#a6').is(":checked")) { $("#n6").prop("checked", false); } });
            $("#n7").on('click', function() { if ($('#n7').is(":checked")) { $("#a7").prop("checked", false); } });
            $("#a7").on('click', function() { if ($('#a7').is(":checked")) { $("#n7").prop("checked", false); } });
            $("#n8").on('click', function() { if ($('#n8').is(":checked")) { $("#a8").prop("checked", false); } });
            $("#a8").on('click', function() { if ($('#a8').is(":checked")) { $("#n8").prop("checked", false); } });
            $("#n9").on('click', function() { if ($('#n9').is(":checked")) { $("#a9").prop("checked", false); } });
            $("#a9").on('click', function() { if ($('#a9').is(":checked")) { $("#n9").prop("checked", false); } });
            $("#n10").on('click', function() { if ($('#n10').is(":checked")) { $("#a10").prop("checked", false); } });
            $("#a10").on('click', function() { if ($('#a10').is(":checked")) { $("#n10").prop("checked", false); } });
            $("#n11").on('click', function() { if ($('#n11').is(":checked")) { $("#a11").prop("checked", false); } });
            $("#a11").on('click', function() { if ($('#a11').is(":checked")) { $("#n11").prop("checked", false); } });
            $("#n12").on('click', function() { if ($('#n12').is(":checked")) { $("#a12").prop("checked", false); } });
            $("#a12").on('click', function() { if ($('#a12').is(":checked")) { $("#n12").prop("checked", false); } });
            $("#n13").on('click', function() { if ($('#n13').is(":checked")) { $("#a13").prop("checked", false); } });
            $("#a13").on('click', function() { if ($('#a13').is(":checked")) { $("#n13").prop("checked", false); } });
            $("#n14").on('click', function() { if ($('#n14').is(":checked")) { $("#a14").prop("checked", false); } });
            $("#a14").on('click', function() { if ($('#a14').is(":checked")) { $("#n14").prop("checked", false); } });
            $("#n15").on('click', function() { if ($('#n15').is(":checked")) { $("#a15").prop("checked", false); } });
            $("#a15").on('click', function() { if ($('#a15').is(":checked")) { $("#n15").prop("checked", false); } });

            $("#si1").on('click', function() { if ($('#si1').is(":checked")) { $("#no1").prop("checked", false); } });
            $("#no1").on('click', function() { if ($('#no1').is(":checked")) { $("#si1").prop("checked", false); } });
            $("#si2").on('click', function() { if ($('#si2').is(":checked")) { $("#no2").prop("checked", false); } });
            $("#no2").on('click', function() { if ($('#no2').is(":checked")) { $("#si2").prop("checked", false); } });
            $("#si3").on('click', function() { if ($('#si3').is(":checked")) { $("#no3").prop("checked", false); } });
            $("#no3").on('click', function() { if ($('#no3').is(":checked")) { $("#si3").prop("checked", false); } });
            $("#si4").on('click', function() { if ($('#si4').is(":checked")) { $("#no4").prop("checked", false); } });
            $("#no4").on('click', function() { if ($('#no4').is(":checked")) { $("#si4").prop("checked", false); } });
            $("#si5").on('click', function() { if ($('#si5').is(":checked")) { $("#no5").prop("checked", false); } });
            $("#no5").on('click', function() { if ($('#no5').is(":checked")) { $("#si5").prop("checked", false); } });
            $("#si6").on('click', function() { if ($('#si6').is(":checked")) { $("#no6").prop("checked", false); } });
            $("#no6").on('click', function() { if ($('#no6').is(":checked")) { $("#si6").prop("checked", false); } });
            $("#si7").on('click', function() { if ($('#si7').is(":checked")) { $("#no7").prop("checked", false); } });
            $("#no7").on('click', function() { if ($('#no7').is(":checked")) { $("#si7").prop("checked", false); } });

            $( "#peso" ).change(function() {
                window.Misc.setIMC($("#peso").val(), $("#estatura").val()); 
            });

            $( "#estatura" ).change(function() {
                window.Misc.setIMC($("#peso").val(), $("#estatura").val()); 
            });
            window.Misc.setIMC($("#peso").val(), $("#estatura").val()); 

            $("#btn-submit-certificate").click(function() {
                $("#form-add-certificate").submit();
            });

            $('#form-add-certificate').on('submit', function(event){                             
                var url = $(this).attr('action');
                var method = "<?php echo $method; ?>";
                event.preventDefault();

                $.ajax({
                    type: method,
                    cache: false,
                    dataType: 'json',
                    data:  $('#form-add-certificate').serialize(),
                    url : url,
                    beforeSend: function() { 
                        $("#validation-errors-certificate").hide().empty();                                     
                    },
                    success: function(data) {
                        if(data.success == false) {
                            $("#validation-errors-certificate").append(data.errors);
                            $("#validation-errors-certificate").show();
                        }else{
                            window.location="{{URL::to('certificados/"+data.certificate.id+"')}}";
                        }
                    },
                    error: function(xhr, textStatus, thrownError) {
                        $('#error-app').modal('show');                      
                        $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
                    }
                });
                return false;
            });     
        });
    </script>
@stop