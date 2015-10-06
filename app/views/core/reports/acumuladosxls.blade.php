<table>
    <tr>
		<td colspan="8">IPS :: Software Reportes / Acumulados {{ isset($company) ? 'Empresa: '.$company->nombre : ''}} Periodo({{ $fecha_inicial }}  - {{ $fecha_final }}) a {{ date("Y-m-d H:i:s") }} </td>
    </tr>

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
		<td>{{ Form::label('fenfermedad3', 'Diabetis') }}</td>
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
		<td>{{ Form::label('n9', 'Abdomen') }}</td>
		<td>{{ $certificate->n9 }}</td>
	   	<td>{{ $certificate->a9 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n10', 'Genitourinario') }}</td>
		<td>{{ $certificate->n10 }}</td>
		<td>{{ $certificate->a10 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n11', 'Columna') }}</td>
		<td>{{ $certificate->n11 }}</td>
		<td>{{ $certificate->a11 }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('n12', 'Extremidades') }}</td>
		<td>{{ $certificate->n12 }}</td>
		<td>{{ $certificate->a12 }}</td>
	</tr>
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

	<tr><th colspan="3">Informe Examenes Adicionales</th></tr>
	<tr><th>Examen</th><th>SI</th><th>NO</th></tr>
    <tr>
    	<td>{{ Form::label('si1', 'PA') }}</td>
        <td>{{ $certificate->si1 }}</td>
        <td>{{ $certificate->no1 }}</td>
	</tr>
    <tr>
    	<td>{{ Form::label('si2', 'SE') }}</td>
        <td>{{ $certificate->si2 }}</td>
        <td>{{ $certificate->no2 }}</td>
	</tr>
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
</table>