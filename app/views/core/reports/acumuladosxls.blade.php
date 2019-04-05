<table>
    <tr>
		<td colspan="8">IPS :: Software Reportes / Acumulados {{ isset($company) ? 'Empresa: '.$company->nombre : ''}} Periodo({{ $fecha_inicial }}  - {{ $fecha_final }}) a {{ date("Y-m-d H:i:s") }} </td>
    </tr>

	<tr><td></td></tr>
	<tr>
		<td>Numero de certificados</td>
		<td>{{ $certificate->certificados }}</td>
	</tr>
	<tr><td></td></tr>

	<tr><td></td></tr>
	<tr><td>Sexo</td></tr>
	@if(isset($users['sexo']) && is_array($users['sexo']))
        @foreach($users['sexo'] as $key => $value)
        	<tr>
        		<td>{{ in_array($key, array_keys(Customer::$sex)) ? Customer::$sex[$key] : $key }}</td>
        		<td>{{ $value }}</td>
            </tr>
        @endforeach
    @endif
	<tr><td></td></tr>

	<tr><td></td></tr>
	<tr><td>Rango de edad</td></tr>
	@if(isset($users['edad']) && is_array($users['edad']))
        @foreach($users['edad'] as $key => $value)
        	<tr>
        		<td>{{ $key }}</td>
        		<td>{{ $value }}</td>
            </tr>
        @endforeach
    @endif
	<tr><td></td></tr>

	<tr><td></td></tr>
	<tr><td>Estrato social</td></tr>
	@if(isset($users['estrato']) && is_array($users['estrato']))
        @foreach($users['estrato'] as $key => $value)
            @if($key != 0)
	        	<tr>
	        		<td>{{ in_array($key, array_keys(Customer::$estrato)) ? Customer::$estrato[$key] : $key }}</td>
	        		<td>{{ $value }}</td>
	            </tr>
	      	@endif
        @endforeach
    @endif
	<tr><td></td></tr>

	<tr><td></td></tr>
	<tr><td>Lateralidad</td></tr>
	@if(isset($lateridad) && is_array($lateridad))
        @foreach($lateridad as $key => $value)
        	<tr>
        		<td>{{ in_array($key, array_keys(Certificate::$lateralidad)) ? Certificate::$lateralidad[$key] : $key }}</td>
        		<td>{{ $value }}</td>
            </tr>
        @endforeach
    @endif
	<tr><td></td></tr>

	<tr><th colspan="2">Antecedentes Familiares</th></tr>
    <tr><th aling="left">Enfermedad</th></tr>
	<tr>
		<td>{{ Form::label('fenfermedad1', 'HTA') }}</td>
		<td>{{ $certificate->fenfermedad1 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('fenfermedad2', 'ACV') }}</td>
		<td>{{ $certificate->fenfermedad2 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('fenfermedad3', 'Diabetes') }}</td>
		<td>{{ $certificate->fenfermedad3 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('fenfermedad4', 'Cancer') }}</td>
		<td>{{ $certificate->fenfermedad4 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('fenfermedad5', 'Coronaria') }}</td>
		<td>{{ $certificate->fenfermedad5 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('fenfermedad6', 'Artritis') }}</td>
		<td>{{ $certificate->fenfermedad6 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('fenfermedad7', 'Alergias') }}</td>
		<td>{{ $certificate->fenfermedad7 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('fenfermedad8', 'Otra') }}</td>
		<td>{{ $certificate->fenfermedad8 }}</td>
    </tr>


	<tr><th colspan="2">Antecedentes Personales</th></tr>
	<tr>
		<td>{{ Form::label('penfermedad1', 'Enfermedad') }}</td>           
		<td>{{ $certificate->penfermedad1 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad2', 'Traumas Esguinces Fracturas') }}</td>	            
		<td>{{ $certificate->penfermedad2 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad3', 'Quirurgicos') }}</td>
		<td>{{ $certificate->penfermedad3 }}</td>		
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad4', 'Intoxicaciones / Alergias') }}</td>
		<td>{{ $certificate->penfermedad4 }}</td>		
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad5', 'Hospitalizaciones') }}</td>
		<td>{{ $certificate->penfermedad5 }}</td>		
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad6', 'Transfusiones') }}</td>
		<td>{{ $certificate->penfermedad6 }}</td>		
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad7', 'Transtornos mentales') }}</td>
		<td>{{ $certificate->penfermedad7 }}</td>		
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad8', 'Farmacologicos') }}</td>
		<td>{{ $certificate->penfermedad8 }}</td>		
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad9', 'Ginecoobstetrio') }}</td>
		<td>{{ $certificate->penfermedad9 }}</td>		
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad10', 'Tetanos') }}</td>
		<td>{{ $certificate->penfermedad10 }}</td>
	</tr>	            
	<tr>
		<td>{{ Form::label('penfermedad11', 'Vacuna fiebre amarilla') }}</td>
		<td>{{ $certificate->penfermedad11 }}</td>
	</tr>            
	<tr>
		<td>{{ Form::label('penfermedad12', 'Otras vacunas') }}</td>
		<td>{{ $certificate->penfermedad12 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad13', 'Fuma') }}</td>
		<td>{{ $certificate->penfermedad13 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad14', 'Toma') }}</td>
		<td>{{ $certificate->penfermedad14 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('penfermedad15', 'Deporte') }}</td>
		<td>{{ $certificate->penfermedad15 }}</td>
    </tr>      
	
    <tr><th colspan="3">Examen Fisico</th></tr>

    <tr>
		<td>Peso insuficiente</td>
        <td>{{ $imc->_18_5 }}</td>
	</tr>
	<tr>
		<td>Normopeso</td>
        <td>{{ $imc->_24_9 }}</td>
	</tr>
	<tr>
		<td>Sobrepeso grado I</td>
        <td>{{ $imc->_26_9 }}</td>
	</tr>
	<tr>
		<td>Sobrepeso grado II (preobesidad)/td>
        <td>{{ $imc->_29_9 }}</td>
	</tr>
	<tr>
		<td>Obesidad de tipo I</td>
        <td>{{ $imc->_34_9 }}</td>
	</tr>
	<tr>
		<td>Obesidad de tipo II</td>
        <td>{{ $imc->_39_9 }}</td>
	</tr>
	<tr>
		<td>Obesidad de tipo III (morbida)</td>
        <td>{{ $imc->_49_9 }}</td>
	</tr>
	<tr>
		<td>Obesidad de tipo IV (extrema)</td>
        <td>{{ $imc->_50 }}</td>
	</tr>
    <tr><td></td></tr>
    @if(isset($hipertension) && is_array($hipertension))
        @foreach($hipertension as $key => $value)
            <tr>
				<td>{{ Certificate::$hipertension[$key] }}</td>
		        <td>{{ $value }}</td>
			</tr>
        @endforeach
        <tr><td></td></tr>
    @endif
    
	<tr><th></th><th>N</th><th>A</th></tr>
	<tr>
		<td>{{ Form::label('n1', 'Cabeza') }}</td>
        <td>{{ $certificate->n1 }}</td>
        <td>{{ $certificate->a1 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n2', 'Ojos') }}</td>
		<td>{{ $certificate->n2 }}</td> 
		<td>{{ $certificate->a2 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n3', 'Agudeza Visual') }}</td>
		<td>{{ $certificate->n3 }}</td>
		<td>{{ $certificate->a3 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n4', 'Nariz') }}</td>
		<td>{{ $certificate->n4 }}</td>	   
		<td>{{ $certificate->a4 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n5', 'Boca') }}</td>
		<td>{{ $certificate->n5 }}</td>
	   	<td>{{ $certificate->a5 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n6', 'Oidos') }}</td>
		<td>{{ $certificate->n6 }}</td>
	   <td>{{ $certificate->a6 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n7', 'Torax') }}</td>
		<td>{{ $certificate->n7 }}</td>
	   	<td>{{ $certificate->a7 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n8', 'Corazon') }}</td>
		<td>{{ $certificate->n8 }}</td>
	   	<td>{{ $certificate->a8 }}</td>
	</tr>
	<tr>
		<th>{{ Form::label('n9', 'Abdomen') }}</th>
		<td>{{ $certificate->n9 }}</td>
	   	<td>{{ $certificate->a9 }}</td>
	</tr>
	@if(isset($abdomen) && is_array($abdomen) && count($abdomen) > 0)
		<tr><td></td></tr>
        @foreach($abdomen as $key => $value)
        	<tr>
				<td>{{ in_array($key, array_keys(Certificate::$abdomen)) ? Certificate::$abdomen[$key] : $key }}</td>
				<td>{{ $value }}</td>
			</tr>
        @endforeach
        <tr><td></td></tr>
    @endif

	<tr>
		<td>{{ Form::label('n10', 'Genitourinario') }}</td>
		<td>{{ $certificate->n10 }}</td>
		<td>{{ $certificate->a10 }}</td>
	</tr>
	
	<tr>
		<th>{{ Form::label('n11', 'Columna') }}</th>
		<td>{{ $certificate->n11 }}</td>
		<td>{{ $certificate->a11 }}</td>
	</tr>
	@if(isset($columna) && is_array($columna) && count($columna) > 0)
		<tr><td></td></tr>
        @foreach($columna as $key => $value)
        	<tr>
				<td>{{ in_array($key, array_keys(Certificate::$columna)) ? Certificate::$columna[$key] : $key }}</td>
				<td>{{ $value }}</td>
			</tr>
        @endforeach
        <tr><td></td></tr>
    @endif

	<tr>
		<th>{{ Form::label('n12', 'Extremidades') }}</th>
		<td>{{ $certificate->n12 }}</td>
		<td>{{ $certificate->a12 }}</td>
	</tr>
	@if(isset($extremidades) && is_array($extremidades) && count($extremidades) > 0)
		<tr><td></td></tr>
        @foreach($extremidades as $key => $value)
        	<tr>
				<td>{{ in_array($key, array_keys(Certificate::$extremidades)) ? Certificate::$extremidades[$key] : $key }}</td>
				<td>{{ $value }}</td>
			</tr>
        @endforeach
        <tr><td></td></tr>
    @endif

	<tr>
		<td>{{ Form::label('n13', 'SNC') }}</td>
		<td>{{ $certificate->n13 }}</td>
		<td>{{ $certificate->a13 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n14', 'Piel y Faneas') }}</td>
		<td>{{ $certificate->n14 }}</td>
		<td>{{ $certificate->a14 }}</td>
	</tr>

	<tr>
		<th>{{ Form::label('n15', 'Várices') }}</th>
		<td>{{ $certificate->n15 }}</td>
	   	<td>{{ $certificate->a15 }}</td>
	</tr>
	@if(isset($varices) && is_array($varices) && count($varices) > 0)
		<tr><td></td></tr>varices
        @foreach($varices as $key => $value)
        	<tr>
				<td>{{ in_array($key, array_keys(Certificate::$varices)) ? Certificate::$varices[$key] : $key }}</td>
				<td>{{ $value }}</td>
			</tr>
        @endforeach
        <tr><td></td></tr>
    @endif

	<tr><th colspan="3">Informe Examenes Adicionales</th></tr>
	<tr><th>Examen</th><th>SI</th><th>NO</th></tr>
    <tr>
    	<td>{{ Form::label('si3', 'Sist. Osteomuscular') }}</td>
        <td>{{ $certificate->si3 }}</td>
        <td>{{ $certificate->no3 }}</td>
	</tr>
    <tr>
    	<td>{{ Form::label('si4', 'Varicocele') }}</td>
        <td>{{ $certificate->si4 }}</td>
        <td>{{ $certificate->no4 }}</td>
	</tr>
    <tr>
    	<td>{{ Form::label('si5', 'Tunel del carpo') }}</td>
        <td>{{ $certificate->si5 }}</td>
        <td>{{ $certificate->no5 }}</td>
	</tr>
    <tr>
    	<td>{{ Form::label('si6', 'Hernias') }}</td>
        <td>{{ $certificate->si6 }}</td>
        <td>{{ $certificate->no6 }}</td>
	</tr>
    <tr>
    	<td>{{ Form::label('si7', 'Manguito Rotador') }}</td>
        <td>{{ $certificate->si7 }}</td>
        <td>{{ $certificate->no7 }}</td>
	</tr>

    <tr><th colspan="2">Aptitud</th></tr>
	<tr>
		<td>{{ Form::label('apto1', 'APTO CON LIMITACIONES (Que NO interfieren en su trabajo)') }}</td>
		<td>{{ $certificate->apto1 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('apto2', 'APTO CON LIMITACIONES (Que interfieren en su trabajo)') }}</td>
		<td>{{ $certificate->apto2 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('apto3', 'APTO CON LIMITACIONES (NO APTO para realizar la labor especifica)') }}</td>
		<td>{{ $certificate->apto3 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('apto4', 'APTO SIN LIMITACIONES') }}</td>
		<td>{{ $certificate->apto4 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('apto5', 'APTO PARA LABORAR EN ALTURAS') }}</td>
		<td>{{ $certificate->apto5 }}</td>
	</tr>

	<tr><td></td></tr>
	<tr><th aling="left">Segun examenes solicitados por la empresa remitente</th></tr>
	<tr><td></td></tr>
	<tr>
		<td>{{ Form::label('examen1', 'EXAMEN DE INGRESO') }}</td>
		<td>{{ $certificate->examen1 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('examen2', 'EXAMEN PERIODICO') }}</td>
		<td>{{ $certificate->examen2 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('examen3', 'EXAMEN DE EGRESO') }}</td>
		<td>{{ $certificate->examen3 }}</td>
	</tr>
	<tr>        
		<td>{{ Form::label('aplazado', 'APLAZADO') }}</td>
		<td>{{ $certificate->aplazado }}</td>
	</tr>
	<tr>        
		<td>{{ Form::label('limitacion1', 'HIGIENE POSTURAL') }}</td>
		<td>{{ $certificate->limitacion1 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('limitacion2', 'USO DE ELEMENTOS DE PROTECCION') }}</td>
		<td>{{ $certificate->limitacion2 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('limitacion3', 'USA LENTES PERMANENTE') }}</td>
		<td>{{ $certificate->limitacion3 }}</td>
	</tr>
	<tr>        
		<td>{{ Form::label('limitacion4', 'VALORACION POR S.O. ANUAL') }}</td>
		<td>{{ $certificate->limitacion4 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('limitacion5', 'CAPACITACION EN SU AREA DE TRABAJO') }}</td>
		<td>{{ $certificate->limitacion5 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('limitacion6', 'REMISION ESPECIALISTA') }}</td>
		<td>{{ $certificate->limitacion6 }}</td>
	</tr>
	<tr>        
		<td>{{ Form::label('limitacion7', 'REALIZA PAUSAS EN SU LABOR') }}</td>
		<td>{{ $certificate->limitacion7 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('limitacion8', 'REALIZAR EXAMENES COMPLEMENTARIOS') }}</td>
		<td>{{ $certificate->limitacion8 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('limitacion9', 'ESQUEMA VACUNACION ADULTO') }}</td>
		<td>{{ $certificate->limitacion9 }}</td>
	</tr>
    <tr>
    	<td>{{ Form::label('limitacion10', 'RECOMENDACION CREMAS HUMECTANTES PARA LA PIEL') }}</td>
		<td>{{ $certificate->limitacion10 }}</td>
    </tr>
    <tr>
        <td>{{ Form::label('limitacion11', 'HABITOS NUTRICIONALES ADECUADOS, REALIZAR ACTIVIDAD FISICA, CONTROL DE PESO, CONTROL MEDICO PERIODICO') }}</td>
		<td>{{ $certificate->limitacion11 }}</td>
    </tr>
    <tr>
        <td>{{ Form::label('limitacion12', 'CONTROL DE COMORBILIDAD EPS') }}</td>
		<td>{{ $certificate->limitacion12 }}</td>
    </tr>
    <tr>
        <td>{{ Form::label('limitacion13', 'SEROLOGIA') }}</td>
		<td>{{ $certificate->limitacion13 }}</td>
    </tr>
</table>