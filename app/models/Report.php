<?php

class Report {
    public static function getPermission($module)
    {
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule($module))->first();
    }

    
	public static function getAcumulados() 
	{
		$query = Certificate::query();  
        $query->select(
            DB::raw('COUNT(id) as certificados'),
        	DB::raw('sum(CASE WHEN fenfermedad1 THEN 1 ELSE 0 END) as fenfermedad1'),
        	DB::raw('sum(CASE WHEN fenfermedad2 THEN 1 ELSE 0 END) as fenfermedad2'),
        	DB::raw('sum(CASE WHEN fenfermedad3 THEN 1 ELSE 0 END) as fenfermedad3'),
        	DB::raw('sum(CASE WHEN fenfermedad4 THEN 1 ELSE 0 END) as fenfermedad4'),
        	DB::raw('sum(CASE WHEN fenfermedad5 THEN 1 ELSE 0 END) as fenfermedad5'),
        	DB::raw('sum(CASE WHEN fenfermedad6 THEN 1 ELSE 0 END) as fenfermedad6'),
        	DB::raw('sum(CASE WHEN fenfermedad7 THEN 1 ELSE 0 END) as fenfermedad7'),
        	DB::raw('sum(CASE WHEN fenfermedad8 THEN 1 ELSE 0 END) as fenfermedad8'),

        	DB::raw('sum(CASE WHEN penfermedad1 THEN 1 ELSE 0 END) as penfermedad1'),
        	DB::raw('sum(CASE WHEN penfermedad2 THEN 1 ELSE 0 END) as penfermedad2'),
        	DB::raw('sum(CASE WHEN penfermedad3 THEN 1 ELSE 0 END) as penfermedad3'),
        	DB::raw('sum(CASE WHEN penfermedad4 THEN 1 ELSE 0 END) as penfermedad4'),
        	DB::raw('sum(CASE WHEN penfermedad5 THEN 1 ELSE 0 END) as penfermedad5'),
        	DB::raw('sum(CASE WHEN penfermedad6 THEN 1 ELSE 0 END) as penfermedad6'),
        	DB::raw('sum(CASE WHEN penfermedad7 THEN 1 ELSE 0 END) as penfermedad7'),
        	DB::raw('sum(CASE WHEN penfermedad8 THEN 1 ELSE 0 END) as penfermedad8'),
        	DB::raw('sum(CASE WHEN penfermedad9 THEN 1 ELSE 0 END) as penfermedad9'),
        	DB::raw('sum(CASE WHEN penfermedad10 THEN 1 ELSE 0 END) as penfermedad10'),
        	DB::raw('sum(CASE WHEN penfermedad11 THEN 1 ELSE 0 END) as penfermedad11'),
        	DB::raw('sum(CASE WHEN penfermedad12 THEN 1 ELSE 0 END) as penfermedad12'),
        	DB::raw('sum(CASE WHEN penfermedad13 THEN 1 ELSE 0 END) as penfermedad13'),
        	DB::raw('sum(CASE WHEN penfermedad14 THEN 1 ELSE 0 END) as penfermedad14'),
        	DB::raw('sum(CASE WHEN penfermedad15 THEN 1 ELSE 0 END) as penfermedad15'),

        	DB::raw('sum(CASE WHEN n1 THEN 1 ELSE 0 END) as n1'),
        	DB::raw('sum(CASE WHEN n2 THEN 1 ELSE 0 END) as n2'),
        	DB::raw('sum(CASE WHEN n3 THEN 1 ELSE 0 END) as n3'),
        	DB::raw('sum(CASE WHEN n4 THEN 1 ELSE 0 END) as n4'),
        	DB::raw('sum(CASE WHEN n5 THEN 1 ELSE 0 END) as n5'),
        	DB::raw('sum(CASE WHEN n6 THEN 1 ELSE 0 END) as n6'),
        	DB::raw('sum(CASE WHEN n7 THEN 1 ELSE 0 END) as n7'),
        	DB::raw('sum(CASE WHEN n8 THEN 1 ELSE 0 END) as n8'),
        	DB::raw('sum(CASE WHEN n9 THEN 1 ELSE 0 END) as n9'),
        	DB::raw('sum(CASE WHEN n10 THEN 1 ELSE 0 END) as n10'),
        	DB::raw('sum(CASE WHEN n11 THEN 1 ELSE 0 END) as n11'),
        	DB::raw('sum(CASE WHEN n12 THEN 1 ELSE 0 END) as n12'),
        	DB::raw('sum(CASE WHEN n13 THEN 1 ELSE 0 END) as n13'),
        	DB::raw('sum(CASE WHEN n14 THEN 1 ELSE 0 END) as n14'),

        	DB::raw('sum(CASE WHEN a1 THEN 1 ELSE 0 END) as a1'),
        	DB::raw('sum(CASE WHEN a2 THEN 1 ELSE 0 END) as a2'),
        	DB::raw('sum(CASE WHEN a3 THEN 1 ELSE 0 END) as a3'),
        	DB::raw('sum(CASE WHEN a4 THEN 1 ELSE 0 END) as a4'),
        	DB::raw('sum(CASE WHEN a5 THEN 1 ELSE 0 END) as a5'),
        	DB::raw('sum(CASE WHEN a6 THEN 1 ELSE 0 END) as a6'),
        	DB::raw('sum(CASE WHEN a7 THEN 1 ELSE 0 END) as a7'),
        	DB::raw('sum(CASE WHEN a8 THEN 1 ELSE 0 END) as a8'),
        	DB::raw('sum(CASE WHEN a9 THEN 1 ELSE 0 END) as a9'),
        	DB::raw('sum(CASE WHEN a10 THEN 1 ELSE 0 END) as a10'),
        	DB::raw('sum(CASE WHEN a11 THEN 1 ELSE 0 END) as a11'),
        	DB::raw('sum(CASE WHEN a12 THEN 1 ELSE 0 END) as a12'),
        	DB::raw('sum(CASE WHEN a13 THEN 1 ELSE 0 END) as a13'),
        	DB::raw('sum(CASE WHEN a14 THEN 1 ELSE 0 END) as a14'),

        	DB::raw('sum(CASE WHEN si1 THEN 1 ELSE 0 END) as si1'),
        	DB::raw('sum(CASE WHEN si2 THEN 1 ELSE 0 END) as si2'),
        	DB::raw('sum(CASE WHEN si3 THEN 1 ELSE 0 END) as si3'),
        	DB::raw('sum(CASE WHEN si4 THEN 1 ELSE 0 END) as si4'),
        	DB::raw('sum(CASE WHEN si5 THEN 1 ELSE 0 END) as si5'),
        	DB::raw('sum(CASE WHEN si6 THEN 1 ELSE 0 END) as si6'),
        	DB::raw('sum(CASE WHEN si7 THEN 1 ELSE 0 END) as si7'),

			DB::raw('sum(CASE WHEN no1 THEN 1 ELSE 0 END) as no1'),
        	DB::raw('sum(CASE WHEN no2 THEN 1 ELSE 0 END) as no2'),
        	DB::raw('sum(CASE WHEN no3 THEN 1 ELSE 0 END) as no3'),
        	DB::raw('sum(CASE WHEN no4 THEN 1 ELSE 0 END) as no4'),
        	DB::raw('sum(CASE WHEN no5 THEN 1 ELSE 0 END) as no5'),
        	DB::raw('sum(CASE WHEN no6 THEN 1 ELSE 0 END) as no6'),
        	DB::raw('sum(CASE WHEN no7 THEN 1 ELSE 0 END) as no7'),

        	DB::raw('sum(CASE WHEN apto1 THEN 1 ELSE 0 END) as apto1'),       			
        	DB::raw('sum(CASE WHEN apto2 THEN 1 ELSE 0 END) as apto2'),       			
        	DB::raw('sum(CASE WHEN apto3 THEN 1 ELSE 0 END) as apto3'),       			
        	DB::raw('sum(CASE WHEN apto4 THEN 1 ELSE 0 END) as apto4'),       			
        	DB::raw('sum(CASE WHEN apto5 THEN 1 ELSE 0 END) as apto5'),

        	DB::raw('sum(CASE WHEN examen1 THEN 1 ELSE 0 END) as examen1'),
        	DB::raw('sum(CASE WHEN examen2 THEN 1 ELSE 0 END) as examen2'),
        	DB::raw('sum(CASE WHEN examen3 THEN 1 ELSE 0 END) as examen3'),

        	DB::raw('sum(CASE WHEN aplazado THEN 1 ELSE 0 END) as aplazado'),

        	DB::raw('sum(CASE WHEN limitacion1 THEN 1 ELSE 0 END) as limitacion1'),
        	DB::raw('sum(CASE WHEN limitacion2 THEN 1 ELSE 0 END) as limitacion2'),
        	DB::raw('sum(CASE WHEN limitacion3 THEN 1 ELSE 0 END) as limitacion3'),
        	DB::raw('sum(CASE WHEN limitacion4 THEN 1 ELSE 0 END) as limitacion4'),
        	DB::raw('sum(CASE WHEN limitacion5 THEN 1 ELSE 0 END) as limitacion5'),
        	DB::raw('sum(CASE WHEN limitacion6 THEN 1 ELSE 0 END) as limitacion6'),
        	DB::raw('sum(CASE WHEN limitacion7 THEN 1 ELSE 0 END) as limitacion7'),
        	DB::raw('sum(CASE WHEN limitacion8 THEN 1 ELSE 0 END) as limitacion8'),
        	DB::raw('sum(CASE WHEN limitacion9 THEN 1 ELSE 0 END) as limitacion9'),
            DB::raw('sum(CASE WHEN limitacion10 THEN 1 ELSE 0 END) as limitacion10'),
            DB::raw('sum(CASE WHEN limitacion11 THEN 1 ELSE 0 END) as limitacion11'),
            DB::raw('sum(CASE WHEN limitacion12 THEN 1 ELSE 0 END) as limitacion12'),
        	DB::raw('sum(CASE WHEN limitacion13 THEN 1 ELSE 0 END) as limitacion13')
        );
        
        // Filters
  		$query->where('certificado.fecha', '>=', Input::get('fecha_inicial_acumulados'));
  		$query->where('certificado.fecha', '<=', Input::get('fecha_final_acumulados'));

        if(Input::has('empresa_acumulados')) {
      		$query->where('certificado.empresa', Input::get('empresa_acumulados'));
		}
        return $query->first();
   	}

    public static function getAcumuladosHipertension() 
    {
        $query = Certificate::query();  
        $query->select('hipertension', DB::raw('COUNT(hipertension) as cantidad'));

        $query->whereNotNull('certificado.hipertension');
        $query->whereRaw("certificado.hipertension != ''");

        // Filters
        $query->where('certificado.fecha', '>=', Input::get('fecha_inicial_acumulados'));
        $query->where('certificado.fecha', '<=', Input::get('fecha_final_acumulados'));

        if(Input::has('empresa_acumulados')) {
            $query->where('certificado.empresa', Input::get('empresa_acumulados'));
        }
        $query->groupBy('certificado.hipertension');
        return $query->lists('cantidad', 'hipertension');   
    }

    public static function getAcumuladosLateridad() 
    {
        $query = Certificate::query();  
        $query->select('lateridad', DB::raw('COUNT(lateridad) as cantidad'));

        $query->whereNotNull('certificado.lateridad');
        $query->whereRaw("certificado.lateridad != ''");

        // Filters
        $query->where('certificado.fecha', '>=', Input::get('fecha_inicial_acumulados'));
        $query->where('certificado.fecha', '<=', Input::get('fecha_final_acumulados'));

        if(Input::has('empresa_acumulados')) {
            $query->where('certificado.empresa', Input::get('empresa_acumulados'));
        }
        $query->groupBy('lateridad');
        return $query->lists('cantidad', 'lateridad');   
    }

    public static function getAcumuladosGSanguineo() 
    {
        $query = Certificate::query();  
        $query->select(DB::raw('CONCAT(certificado.grupo, certificado.rh) as gs'), DB::raw('COUNT( CONCAT(certificado.grupo, certificado.rh) ) as cantidad'));

        $query->whereNotNull('certificado.grupo');
        $query->whereRaw("certificado.grupo != ''");

        $query->whereNotNull('certificado.rh');
        $query->whereRaw("certificado.rh != ''");

        // Filters
        $query->where('certificado.fecha', '>=', Input::get('fecha_inicial_acumulados'));
        $query->where('certificado.fecha', '<=', Input::get('fecha_final_acumulados'));

        if(Input::has('empresa_acumulados')) {
            $query->where('certificado.empresa', Input::get('empresa_acumulados'));
        }
        $query->groupBy('gs');
        return $query->lists('cantidad', 'gs');   
    }

    public static function getAcumuladosIMC() 
    {
        $query = Certificate::query();  
        $query->select(
            DB::raw("SUM(CASE WHEN imc < 18.5 THEN 1 ELSE 0 END) as '_18_5'"),
            DB::raw("SUM(CASE WHEN imc >= 18.5 and imc <= 24.9 THEN 1 ELSE 0 END) as '_24_9'"),
            DB::raw("SUM(CASE WHEN imc >= 25 and imc <= 26.9 THEN 1 ELSE 0 END) as '_26_9'"),
            DB::raw("SUM(CASE WHEN imc >= 27 and imc <= 29.9 THEN 1 ELSE 0 END) as '_29_9'"),
            DB::raw("SUM(CASE WHEN imc >= 30 and imc <= 34.9 THEN 1 ELSE 0 END) as '_34_9'"),
            DB::raw("SUM(CASE WHEN imc >= 35 and imc <= 39.9 THEN 1 ELSE 0 END) as '_39_9'"),
            DB::raw("SUM(CASE WHEN imc >= 40 and imc <= 49.9 THEN 1 ELSE 0 END) as '_49_9'"),
            DB::raw("SUM(CASE WHEN imc >= 50 THEN 1 ELSE 0 END) as '_50'")
        );

        $query->whereNotNull('certificado.imc');
        $query->whereRaw("certificado.imc != ''");

        // Filters
        $query->where('certificado.fecha', '>=', Input::get('fecha_inicial_acumulados'));
        $query->where('certificado.fecha', '<=', Input::get('fecha_final_acumulados'));

        if(Input::has('empresa_acumulados')) {
            $query->where('certificado.empresa', Input::get('empresa_acumulados'));
        }
        return $query->first();   
    } 

    public static function getDataUsers()
    {
        $data = [];

        // Sexo
        $query = Certificate::query();
        $query->select( DB::raw('count(cliente.id) as cantidad, sexo') );  
        $query->join('cliente', 'certificado.cliente', '=', 'cliente.id');
        
        // Filters
        $query->where('certificado.fecha', '>=', Input::get('fecha_inicial_acumulados'));
        $query->where('certificado.fecha', '<=', Input::get('fecha_final_acumulados'));

        if(Input::has('empresa_acumulados')) {
            $query->where('certificado.empresa', Input::get('empresa_acumulados'));
        }
        $query->groupBy('sexo');
        $data['sexo'] = $query->lists('cantidad', 'sexo');
        unset($query);

        // Edad
        $query = Certificate::query();
        $query->select( 
            DB::raw(
            'count(CASE 
                WHEN TIMESTAMPDIFF(YEAR, cliente.fecha_nacimiento, CURDATE()) < 18 THEN \'<18\' 
                WHEN TIMESTAMPDIFF(YEAR, cliente.fecha_nacimiento, CURDATE()) BETWEEN 18 AND 25 THEN \'18-25\' 
                WHEN TIMESTAMPDIFF(YEAR, cliente.fecha_nacimiento, CURDATE()) BETWEEN 26 AND 40 THEN \'26-40\' 
                WHEN TIMESTAMPDIFF(YEAR, cliente.fecha_nacimiento, CURDATE()) BETWEEN 41 AND 50 THEN \'41-50\'
                ELSE \'>50\' 
            END) as cantidad' ),
            DB::raw(
            '(CASE 
                WHEN TIMESTAMPDIFF(YEAR, cliente.fecha_nacimiento, CURDATE()) < 18 THEN \'<18\' 
                WHEN TIMESTAMPDIFF(YEAR, cliente.fecha_nacimiento, CURDATE()) BETWEEN 18 AND 25 THEN \'18-25\' 
                WHEN TIMESTAMPDIFF(YEAR, cliente.fecha_nacimiento, CURDATE()) BETWEEN 26 AND 40 THEN \'26-40\' 
                WHEN TIMESTAMPDIFF(YEAR, cliente.fecha_nacimiento, CURDATE()) BETWEEN 41 AND 50 THEN \'41-50\'
                ELSE \'>50\'
            END) as rango' ) 
        );  
        $query->join('cliente', 'certificado.cliente', '=', 'cliente.id');

        // Filters
        $query->where('certificado.fecha', '>=', Input::get('fecha_inicial_acumulados'));
        $query->where('certificado.fecha', '<=', Input::get('fecha_final_acumulados'));

        if(Input::has('empresa_acumulados')) {
            $query->where('certificado.empresa', Input::get('empresa_acumulados'));
        }
        $query->groupBy('rango');
        $data['edad'] = $query->lists('cantidad', 'rango');
        unset($query);

        // Estrato social
        $query = Certificate::query();
        $query->select( DB::raw('count(cliente.id) as cantidad, estrato') );  

        $query->join('cliente', 'certificado.cliente', '=', 'cliente.id');

        // Filters
        $query->where('certificado.fecha', '>=', Input::get('fecha_inicial_acumulados'));
        $query->where('certificado.fecha', '<=', Input::get('fecha_final_acumulados'));

        if(Input::has('empresa_acumulados')) {
            $query->where('certificado.empresa', Input::get('empresa_acumulados'));
        }
        $query->groupBy('estrato');
        $data['estrato'] = $query->lists('cantidad', 'estrato');

        return $data;
    }
}