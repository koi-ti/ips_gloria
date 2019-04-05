<?php

class Certificate extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'certificado';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    public static $factores = ['F' => 'Fisico', 'Q' => 'Quimico', 'E' => 'Ergonomico', 'M' => 'Mecanicos', 'L' => 'Locativos',
        'P' => 'Psicolaborales', 'O' => 'Otros'];

    public static $embarazo = ['NA' => 'No Aplica', 'P' => 'Positivo', 'N' => 'Negativo'];

    public static $hipertension = ['NA' => 'Normal', 'HE' => 'Hipertenso', 'HO' => 'Hipotenso'];

    public static $lateralidad = ['IZ' => 'Izquierda', 'DE' => 'Derecha'];

    public static $abdomen = ['HU' => 'Hernia umbilical', 'HI' => 'Hernia inguinal', 'O' => 'Otros'];

    public static $columna = ['HL' => 'Hiperlordosis lumbar', 'EL' => 'Escoliosis lumbar', 'CD' =>'Cervicalgia, dorsalgia', 'L' => 'Lumbalgia', 'O' => 'Otros'];

    public static $extremidades = ['T' => 'Tendinitis', 'DE' => 'Dolor en extremidades', 'O' => 'Otros'];

    public static $varices = ['G' => 'Grado I', 'GII' => 'Grado II', 'GIII' => 'Grado III', 'GIV' => 'Grado IV'];

    protected $fillable = ['cliente', 'fecha', 'empresa',
        'oempresa1', 'oempresa2', 'oempresa3', 'oae1', 'oae2', 'oae3', 'otiempo1', 'otiempo2', 'otiempo3', 'ocargo1', 'ocargo2',
        'ocargo3', 'otipo1', 'otipo2', 'otipo3', 'oepp1', 'oepp2', 'oepp3',
        'lempresa1', 'lempresa2', 'lfecha1', 'lfecha2', 'lcausa1', 'lcausa2', 'ldiagnostico1', 'ldiagnostico2', 'lfactor1', 'lfactor2', 'lincapacidad1', 'lincapacidad2',
        'fenfermedad1', 'fenfermedad2', 'fenfermedad3', 'fenfermedad4', 'fenfermedad5', 'fenfermedad6', 'fenfermedad7', 'fenfermedad8',
        'fparentesco1', 'fparentesco2', 'fparentesco3', 'fparentesco4', 'fparentesco5', 'fparentesco6', 'fparentesco7', 'fparentesco8',
        'penfermedad1', 'penfermedad2', 'penfermedad3', 'penfermedad4', 'penfermedad5', 'penfermedad6', 'penfermedad7', 'penfermedad8', 'penfermedad9', 'penfermedad10',
        'penfermedad11', 'penfermedad12', 'penfermedad13', 'penfermedad14', 'penfermedad15', 'pfecha1', 'pfecha2', 'pfecha3', 'pfecha4', 'pfecha5', 'pfecha6', 'pfecha7',
        'pfecha8', 'pfecha9', 'pfecha10', 'pfecha11', 'pfecha12', 'pfecha13', 'pfecha14', 'pfecha15', 'ptratamiento1', 'ptratamiento2', 'ptratamiento3', 'ptratamiento4',
        'ptratamiento5', 'ptratamiento6', 'ptratamiento7', 'ptratamiento8', 'ptratamiento9', 'ptratamiento10', 'ptratamiento11', 'ptratamiento12', 'ptratamiento13',
        'ptratamiento14', 'ptratamiento15', 'grupo', 'rh', 'peso', 'estatura', 'imc', 'lateridad', 'ta', 'hipertension', 'fc', 'fr', 't', 'n1', 'n2', 'n3', 'n4', 'n5', 'n6', 'n7', 'n8', 'n9','n10', 'n11', 'n12', 'n13', 'n14', 'n15', 'a1', 'a2', 'a3', 'a4', 'a5', 'a6', 'a7', 'a8', 'a9', 'a10', 'a11', 'a12', 'a13', 'a14', 'a15', 'hallazgo1', 'hallazgo2', 'hallazgo3',
        'hallazgo4', 'hallazgo5', 'hallazgo6', 'hallazgo7', 'hallazgo8', 'hallazgo9', 'hallazgo10', 'hallazgo11', 'hallazgo12', 'hallazgo13', 'hallazgo14', 'hallazgo15', 'hallazgo16',
        'si1', 'si2', 'si3', 'si4', 'si5', 'si6', 'si7', 'no1', 'no2', 'no3', 'no4', 'no5', 'no6', 'no7', 'observacion1', 'observacion2', 'observacion3', 'observacion4',
        'observacion5', 'observacion6', 'observacion7', 'apto1', 'apto2', 'apto3', 'apto4', 'apto5', 'examen1', 'examen2', 'examen3', 'aplazado', 'razon',
        'diagnostica1', 'diagnostica2', 'diagnostica3', 'limitacion1', 'limitacion2', 'limitacion3', 'limitacion4', 'limitacion5', 'limitacion6', 'limitacion7',
        'limitacion8', 'limitacion9', 'limitacion10', 'limitacion11', 'limitacion12', 'limitacion13', 'embarazo'
    ];

    public function isValid($data)
    {
        $rules = array(
            'cliente' => 'required|numeric',
            'empresa' => 'required|numeric',
            'fecha' => 'required|date_format:Y-m-d',
            'hipertension' => 'required|string'
        );

        $messages = array(
            'hipertension.required'    => 'El campo hipertension de la sección Examen Fisico es obligatorio.'
        );

        // if ($this->exists){
        //     $rules['cedula'] .= ',cedula,' . $this->id;
        // }else{
        //     $rules['cedula'] .= '|required';
        // }

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public static function getPermission()
    {
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('certificate'))->first();
    }

	public static function getData()
    {
        $query = Certificate::query();
        $query->select('certificado.*', 'cliente.nombre as cliente_nombre');
        $query->join('cliente', 'certificado.cliente', '=', 'cliente.id');

        if (Input::has("fecha")) {
            $query->where('certificado.fecha', Input::get("fecha"));
        }

        if (Input::has("empresa")) {
            $query->where('certificado.empresa', Input::get("empresa"));
        }
        if (Input::has("cliente_nombre")) {
            $query->where('cliente.nombre', 'like', '%'.Input::get("cliente_nombre").'%');
        }
        if (Input::has("cliente_cedula")) {
            $query->where('cliente.cedula', 'like', '%'.Input::get("cliente_cedula").'%');
        }
        $query->orderby('certificado.fecha', 'DESC');
        return $query->paginate();
    }

    public static function getFactores() {
        $factores = Certificate::$factores;
        $string = 'Factores de riesgo: ';
        foreach ($factores as $key => $value) {
            $string.= " $key : $value ";
        }
        return $string;
    }

    public static function getEmbarazos() {
        $embarazos = Certificate::$embarazo;
        $string = '';
        foreach ($embarazos as $key => $value) {
            $string.= " $key : $value ";
        }
        return $string;
    }

    public function booleanStore()
    {
        // Boolean prepare
        if(Input::has('fenfermedad1')) $this->fenfermedad1 = true; else $this->fenfermedad1 = false;
        if(Input::has('fenfermedad2')) $this->fenfermedad2 = true; else $this->fenfermedad2 = false;
        if(Input::has('fenfermedad3')) $this->fenfermedad3 = true; else $this->fenfermedad3 = false;
        if(Input::has('fenfermedad4')) $this->fenfermedad4 = true; else $this->fenfermedad4 = false;
        if(Input::has('fenfermedad5')) $this->fenfermedad5 = true; else $this->fenfermedad5 = false;
        if(Input::has('fenfermedad6')) $this->fenfermedad6 = true; else $this->fenfermedad6 = false;
        if(Input::has('fenfermedad7')) $this->fenfermedad7 = true; else $this->fenfermedad7 = false;
        if(Input::has('fenfermedad8')) $this->fenfermedad8 = true; else $this->fenfermedad8 = false;

        if(Input::has('penfermedad1')) $this->penfermedad1 = true; else $this->penfermedad1 = false;
        if(Input::has('penfermedad2')) $this->penfermedad2 = true; else $this->penfermedad2 = false;
        if(Input::has('penfermedad3')) $this->penfermedad3 = true; else $this->penfermedad3 = false;
        if(Input::has('penfermedad4')) $this->penfermedad4 = true; else $this->penfermedad4 = false;
        if(Input::has('penfermedad5')) $this->penfermedad5 = true; else $this->penfermedad5 = false;
        if(Input::has('penfermedad6')) $this->penfermedad6 = true; else $this->penfermedad6 = false;
        if(Input::has('penfermedad7')) $this->penfermedad7 = true; else $this->penfermedad7 = false;
        if(Input::has('penfermedad8')) $this->penfermedad8 = true; else $this->penfermedad8 = false;
        if(Input::has('penfermedad9')) $this->penfermedad9 = true; else $this->penfermedad9 = false;
        if(Input::has('penfermedad10')) $this->penfermedad10 = true; else $this->penfermedad10 = false;
        if(Input::has('penfermedad11')) $this->penfermedad11 = true; else $this->penfermedad11 = false;
        if(Input::has('penfermedad12')) $this->penfermedad12 = true; else $this->penfermedad12 = false;
        if(Input::has('penfermedad13')) $this->penfermedad13 = true; else $this->penfermedad13 = false;
        if(Input::has('penfermedad14')) $this->penfermedad14 = true; else $this->penfermedad14 = false;
        if(Input::has('penfermedad15')) $this->penfermedad15 = true; else $this->penfermedad15 = false;

        if(Input::has('n1')) $this->n1 = true; else $this->n1 = false;
        if(Input::has('n2')) $this->n2 = true; else $this->n2 = false;
        if(Input::has('n3')) $this->n3 = true; else $this->n3 = false;
        if(Input::has('n4')) $this->n4 = true; else $this->n4 = false;
        if(Input::has('n5')) $this->n5 = true; else $this->n5 = false;
        if(Input::has('n6')) $this->n6 = true; else $this->n6 = false;
        if(Input::has('n7')) $this->n7 = true; else $this->n7 = false;
        if(Input::has('n8')) $this->n8 = true; else $this->n8 = false;
        if(Input::has('n9')) $this->n9 = true; else $this->n9 = false;
        if(Input::has('n10')) $this->n10 = true; else $this->n10 = false;
        if(Input::has('n11')) $this->n11 = true; else $this->n11 = false;
        if(Input::has('n12')) $this->n12 = true; else $this->n12 = false;
        if(Input::has('n13')) $this->n13 = true; else $this->n13 = false;
        if(Input::has('n14')) $this->n14 = true; else $this->n14 = false;
        if(Input::has('n15')) $this->n15 = true; else $this->n15 = false;

        if(Input::has('a1')) $this->a1 = true; else $this->a1 = false;
        if(Input::has('a2')) $this->a2 = true; else $this->a2 = false;
        if(Input::has('a3')) $this->a3 = true; else $this->a3 = false;
        if(Input::has('a4')) $this->a4 = true; else $this->a4 = false;
        if(Input::has('a5')) $this->a5 = true; else $this->a5 = false;
        if(Input::has('a6')) $this->a6 = true; else $this->a6 = false;
        if(Input::has('a7')) $this->a7 = true; else $this->a7 = false;
        if(Input::has('a8')) $this->a8 = true; else $this->a8 = false;
        if(Input::has('a9')) $this->a9 = true; else $this->a9 = false;
        if(Input::has('a10')) $this->a10 = true; else $this->a10 = false;
        if(Input::has('a11')) $this->a11 = true; else $this->a11 = false;
        if(Input::has('a12')) $this->a12 = true; else $this->a12 = false;
        if(Input::has('a13')) $this->a13 = true; else $this->a13 = false;
        if(Input::has('a14')) $this->a14 = true; else $this->a14 = false;
        if(Input::has('a15')) $this->a15 = true; else $this->a15 = false;

        if(Input::has('si1')) $this->si1 = true; else $this->si1 = false;
        if(Input::has('si2')) $this->si2 = true; else $this->si2 = false;
        if(Input::has('si3')) $this->si3 = true; else $this->si3 = false;
        if(Input::has('si4')) $this->si4 = true; else $this->si4 = false;
        if(Input::has('si5')) $this->si5 = true; else $this->si5 = false;
        if(Input::has('si6')) $this->si6 = true; else $this->si6 = false;
        if(Input::has('si7')) $this->si7 = true; else $this->si7 = false;

        if(Input::has('no1')) $this->no1 = true; else $this->no1 = false;
        if(Input::has('no2')) $this->no2 = true; else $this->no2 = false;
        if(Input::has('no3')) $this->no3 = true; else $this->no3 = false;
        if(Input::has('no4')) $this->no4 = true; else $this->no4 = false;
        if(Input::has('no5')) $this->no5 = true; else $this->no5 = false;
        if(Input::has('no6')) $this->no6 = true; else $this->no6 = false;
        if(Input::has('no7')) $this->no7 = true; else $this->no7 = false;

        if(Input::has('apto1')) $this->apto1 = true; else $this->apto1 = false;
        if(Input::has('apto2')) $this->apto2 = true; else $this->apto2 = false;
        if(Input::has('apto3')) $this->apto3 = true; else $this->apto3 = false;
        if(Input::has('apto4')) $this->apto4 = true; else $this->apto4 = false;
        if(Input::has('apto5')) $this->apto5 = true; else $this->apto5 = false;

        if(Input::has('examen1')) $this->examen1 = true; else $this->examen1 = false;
        if(Input::has('examen2')) $this->examen2 = true; else $this->examen2 = false;
        if(Input::has('examen3')) $this->examen3 = true; else $this->examen3 = false;
        if(Input::has('aplazado')) $this->aplazado = true; else $this->aplazado = false;

        if(Input::has('limitacion1')) $this->limitacion1 = true; else $this->limitacion1 = false;
        if(Input::has('limitacion2')) $this->limitacion2 = true; else $this->limitacion2 = false;
        if(Input::has('limitacion3')) $this->limitacion3 = true; else $this->limitacion3 = false;
        if(Input::has('limitacion4')) $this->limitacion4 = true; else $this->limitacion4 = false;
        if(Input::has('limitacion5')) $this->limitacion5 = true; else $this->limitacion5 = false;
        if(Input::has('limitacion6')) $this->limitacion6 = true; else $this->limitacion6 = false;
        if(Input::has('limitacion7')) $this->limitacion7 = true; else $this->limitacion7 = false;
        if(Input::has('limitacion8')) $this->limitacion8 = true; else $this->limitacion8 = false;
        if(Input::has('limitacion9')) $this->limitacion9 = true; else $this->limitacion9 = false;
        if(Input::has('limitacion10')) $this->limitacion10 = true; else $this->limitacion10 = false;
        if(Input::has('limitacion11')) $this->limitacion11 = true; else $this->limitacion11 = false;
        if(Input::has('limitacion12')) $this->limitacion12 = true; else $this->limitacion12 = false;
        if(Input::has('limitacion13')) $this->limitacion13 = true; else $this->limitacion13 = false;
    }

    public function multipleStore()
    {
        $this->ofactor1 = '';
        if(Input::get('ofactor1')) {
            $this->ofactor1 = implode(',', Input::get('ofactor1'));
        }

        $this->ofactor2 = '';
        if(Input::get('ofactor2')) {
            $this->ofactor2 = implode(',', Input::get('ofactor2'));
        }

        $this->ofactor3 = '';
        if(Input::get('ofactor3')) {
            $this->ofactor3 = implode(',', Input::get('ofactor3'));
        }
    }

    public static function report($certificate)
    {
        $customer = Customer::find($certificate->cliente);
        $city = City::find($customer->ciudad);
        $company = Company::find($certificate->empresa);
        $imagen = sprintf('%s%s', public_path(), $customer->imagen ? $customer->imagen : '/images/default-avatar.jpg');
        $firma = sprintf('%s%s', public_path(), '/images/firma.jpg');
        $output = '
            <style>
                .span_check { vertical-align: middle;border: 1px solid black;display: block;height: 15px;text-align: center; font-size: 13px;}
                .span_firma { display: block; width: 80%; border-bottom: 1px solid black; }
                .span_huella { display: block; width: 80%; border: 1px solid black;height: 90px; }

                .title { color: #06068F;font-family:\'comic sans ms\';font-size: 18px; }
                .sub_title { color: #06068F;font-family:\'comic sans ms\';font-size: 16px; }
                .sub_indice { font-size: 11px; }
            </style>';

        $output .= '
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th align="center" colspan="2" class="title">'.
                            utf8_decode('Gloria Esmeralda Rincón Izquierdo Medica Especialista en Salud Ocupacional').' 
                        </th>
                    </tr>
                    <tr>
                        <td align="center" width="50%" class="sub_indice">Calle 6 D Bis A  # 3-16 este</td>
                        <td align="center" width="50%" class="sub_indice">Celular 312 - 569 53 86</td>
                    </tr>
                    <tr>
                        <th align="center" colspan="2" class="sub_title">Certificado De Salud Ocupacional Con Enfasis Osteomuscular</th>
                    </tr>
                </thead>
            </table><br/>';

        $output .= '
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th align="left" width="20%" style="font-size: 13px;">Fecha</th>
                        <th align="left" width="20%" style="font-size: 13px;">Documento</th>
                        <th align="left" width="50%" style="font-size: 13px;">Nombre</th>
                        <td align="left" rowspan="6"><img src="'.$imagen.'" width="100" height="auto"></td>
                    </tr>
                    <tr>
                        <td align="left" style="font-size: 13px;">'.$certificate->fecha.'</td>
                        <td align="left" style="font-size: 13px;">'.$customer->cedula.'</td>
                        <td align="left" style="font-size: 13px;">'.utf8_decode($customer->nombre).'</td>
                    </tr>
                    <tr>
                        <th align="left" width="20%" style="font-size: 13px;" nowrap>Sexo</th>
                        <th align="left" width="20%" style="font-size: 13px;" nowrap>Nacionalidad</th>
                        <th align="left" width="50%" style="font-size: 13px;" nowrap>Ciudad</th>
                    </tr>
                    <tr>
                        <td align="left" style="font-size: 13px;">'.Customer::$sex[$customer->sexo].'</td>
                        <td align="left" style="font-size: 13px;">'.$customer->nacionalidad.'</td>
                        <td align="left" style="font-size: 13px;">'.$city->nombre.'</td>
                    </tr>
                    <tr>
                        <th align="left" width="20%" style="font-size: 13px;" nowrap>Fecha nacimiento</th>
                        <th align="left" width="20%" style="font-size: 13px;" nowrap>Edad</th>
                        <th align="left" width="50%" style="font-size: 13px;" nowrap>Lugar nacimiento</th>
                    </tr>
                    <tr>
                        <td align="left" style="font-size: 13px;">'.$customer->fecha_nacimiento.'</td>
                        <td align="left" style="font-size: 13px;">'.utf8_decode(Customer::getAge($customer->fecha_nacimiento)).'</td>
                        <td align="left" style="font-size: 13px;">'.$customer->lugar_nacimiento.'</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table style="width: 100%;border-top: 1px solid black;border-bottom: 1px solid black;">
                                <thead>
                                    <tr>
                                        <th align="left" width="25%" style="font-size: 13px;">Estado civil</th>
                                        <th align="left" width="25%" style="font-size: 13px;">Telefono</th>
                                        <th align="left" width="25%" style="font-size: 13px;">Direccion</th>
                                        <th align="left" width="25%" style="font-size: 13px;">Empresa</th>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size: 13px;">'.Customer::$maritalstatus[$customer->estadocivil].'</td>
                                        <td align="left" style="font-size: 13px;">'.$customer->telefono.'</td>
                                        <td align="left" style="font-size: 13px;">'.$customer->direccion.'</td>
                                        <td align="left" style="font-size: 13px;">'.$company->nombre.'</td>
                                    </tr>
                                    <tr>

                                        <th align="left" width="25%" style="font-size: 13px;">Escolaridad</th>
                                        <th align="left" width="25%" style="font-size: 13px;">Profesion</th>
                                        <th align="left" width="25%" style="font-size: 13px;">Oficio</th>
                                        <th align="left" width="25%" style="font-size: 13px;">Nit</th>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size: 13px;">'.$customer->escolaridad.'</td>
                                        <td align="left" style="font-size: 13px;">'.$customer->profesion.'</td>
                                        <td align="left" style="font-size: 13px;">'.$customer->oficio.'</td>
                                        <td align="left" style="font-size: 13px;">'.$company->nit.'</td>
                                    </tr>
                                </thead>
                            </table><br/>
                        </td>
                    </tr>
                </thead>
            </table>';

        $output .= '
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th align="center" colspan="7" class="sub_title">ANTECEDENTES OCUPACIONALES</th>
                    </tr>
                    <tr>
                        <th align="left" width="20%" style="font-size: 13px;">Empresa</th>
                        <!-- <th align="left" width="10%" style="font-size: 13px;">A E</th> -->
                        <th align="left" width="10%" style="font-size: 13px;">Tiempo</th>
                        <th align="left" width="20%" style="font-size: 13px;">Cargo</th>
                        <th align="left" width="20%" style="font-size: 13px;">Factores de riesgo</th>
                        <th align="left" width="15%" style="font-size: 13px;">Tipo de Riesgo</th>
                        <th align="left" width="15%" style="font-size: 13px;">Epp</th>
                    </tr>
                    <tr>
                        <td align="left" style="font-size: 13px;">'.$certificate->oempresa1.'</td>
                        <!-- <td align="left" style="font-size: 13px;">'.$certificate->oae1.'</td> -->
                        <td align="left" style="font-size: 13px;">'.utf8_decode($certificate->otiempo1).'</td>
                        <td align="left" style="font-size: 13px;">'.$certificate->ocargo1.'</td>
                        <td align="left" style="font-size: 13px;">'.($certificate->ofactor1 ? $certificate->ofactor1 : '').'</td>
                        <td align="left" style="font-size: 13px;">'.$certificate->otipo1.'</td>
                        <td align="left" style="font-size: 13px;">'.$certificate->oepp1.'</td>
                    </tr>
                    <tr>
                        <td align="left" style="font-size: 13px;">'.$certificate->oempresa2.'</td>
                        <!-- <td align="left" style="font-size: 13px;">'.$certificate->oae2.'</td> -->
                        <td align="left" style="font-size: 13px;">'.utf8_decode($certificate->otiempo2).'</td>
                        <td align="left" style="font-size: 13px;">'.$certificate->ocargo2.'</td>
                        <td align="left" style="font-size: 13px;">'.($certificate->ofactor2 ? $certificate->ofactor2 : '').'</td>
                        <td align="left" style="font-size: 13px;">'.$certificate->otipo2.'</td>
                        <td align="left" style="font-size: 13px;">'.$certificate->oepp2.'</td>
                    </tr>
                    <tr>
                        <td align="left" style="font-size: 13px;">'.$certificate->oempresa3.'</td>
                        <!-- <td align="left" style="font-size: 13px;">'.$certificate->oae3.'</td> -->
                        <td align="left" style="font-size: 13px;">'.utf8_decode($certificate->otiempo3).'</td>
                        <td align="left" style="font-size: 13px;">'.$certificate->ocargo3.'</td>
                        <td align="left" style="font-size: 13px;">'.($certificate->ofactor3 ? $certificate->ofactor3 : '').'</td>
                        <td align="left" style="font-size: 13px;">'.$certificate->otipo3.'</td>
                        <td align="left" style="font-size: 13px;">'.$certificate->oepp3.'</td>
                    </tr>
                    <tr>
                        <td align="left" style="font-size: 10px;" colspan="7">'.Certificate::getFactores().'</td>
                    </tr>
                </thead>
            </table>';

        $output .= '
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th align="center" colspan="6" class="sub_title">APTITUD</th>
                    </tr>
                    <tr>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->apto1 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">APTO CON PATOLOGIA (Que NO interfieren en su trabajo)</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->apto2 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">APTO CON LIMITACIONES (Que interfieren en su trabajo)</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->apto3 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">APTO CON LIMITACIONES (NO APTO para realizar la labor especifica)</td>
                    </tr>
                    <tr>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->apto4 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">APTO SIN LIMITACIONES</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->apto5 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">APTO PARA LABORAR EN ALTURAS</td>
                    </tr>
                    <tr>
                        <th align="left" colspan="6" style="color: #06068F;font-family:\'comic sans ms\';font-size: 13px;">Segun examenes solicitados por la empresa remitente</th>
                    </tr>
                    <tr>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->examen1 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">EXAMEN DE INGRESO</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->examen2 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">EXAMEN PERIODICO</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->examen3 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">EXAMEN DE EGRESO</td>
                    </tr>
                    <tr>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->aplazado ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">APLAZADO</td>
                        <td align="left" colspan="4" style="font-size: 11px;">RAZON: '.$certificate->razon.'</td>
                    </tr>
                    <tr>
                        <td align="left" colspan="2" style="font-size: 11px;">IMPRESION DIAGNOSTICA</td>
                        <td align="left" colspan="4" style="font-size: 11px;">'.$certificate->diagnostica1.'</td>
                    </tr>
                    <tr>
                        <th align="left" colspan="2" style="font-size: 13px;"></th>
                        <td align="left" colspan="4" style="font-size: 11px;">'.$certificate->diagnostica2.'</td>
                    </tr>
                    <tr>
                        <th align="left" colspan="2" style="font-size: 13px;"></th>
                        <td align="left" colspan="4" style="font-size: 11px;">'.$certificate->diagnostica3.'</td>
                    </tr>
                    <tr>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion1 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">HIGIENE POSTURAL</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion2 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">USO DE ELEMENTOS DE PROTECCION</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion3 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">USA LENTES PERMANENTE</td>
                    </tr>
                    <tr>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion4 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">VALORACION POR S.O. ANUAL</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion5 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">CAPACITACION EN SU AREA DE TRABAJO</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion6 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">REMISION ESPECIALISTA</td>
                    </tr>
                    <tr>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion7 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">REALIZA PAUSAS EN SU LABOR</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion8 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">REALIZAR EXAMENES COMPLEMENTARIOS</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion9 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">ESQUEMA VACUNACION ADULTO</td>
                    </tr>
                    <tr>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion10 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">RECOMENDACION CREMAS HUMECTANTES PARA LA PIEL</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion11 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">HABITOS NUTRICIONALES ADECUADOS, REALIZAR ACTIVIDAD FISICA, CONTROL DE PESO, CONTROL MEDICO PERIODICO</td>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion12 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">CONTROL DE COMORBILIDAD EPS</td>
                    </tr>
                    <tr>
                        <td align="left" width="3%"><span class="span_check">'.($certificate->limitacion13 ? 'X' : '').'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">SEROLOGIA</td>
                        <!-- <td align="left" width="3%"><span class="span_check">'.($certificate->embarazo).'</span></td>
                        <td align="left" width="30%" style="font-size: 11px;">PRUEBA DE EMBARAZO</td>
                        <td align="left" width="3%"></td>
                        <td align="left" width="30%" style="font-size: 10px;">'.Certificate::getEmbarazos().'</td> -->
                    </tr>
                </thead>
            </table>';

        // $output .= '
        //     <table style="width: 100%;">
        //         <thead>
        //             <tr>
        //                 <th align="center" colspan="7" style="color: #06068F;font-family:\'comic sans ms\';font-size: 18px;">ACCIDENTES LABORALES Y ENFERMEDAD PROFESIONAL</th>
        //             </tr>
        //             <tr>
        //                 <th align="left" width="20%">Empresa</th>
        //                 <th align="left" width="10%">Fecha</th>
        //                 <th align="left" width="10%">Causa</th>
        //                 <th align="left" width="20%">Diagnostico</th>
        //                 <th align="left" width="20%">Factores de riesgo</th>
        //                 <th align="left" width="20%">Incapacidad / Secuelas</th>
        //             </tr>
        //             <tr>
        //                 <td align="left">'.$certificate->lempresa1.'</td>
        //                 <td align="left">'.$certificate->lfecha1.'</td>
        //                 <td align="left">'.$certificate->lcausa1.'</td>
        //                 <td align="left">'.$certificate->ldiagnostico1.'</td>
        //                 <td align="left">'.$certificate->lfactor1.'</td>
        //                 <td align="left">'.$certificate->lincapacidad1.'</td>
        //             </tr>
        //             <tr>
        //                 <td align="left">'.$certificate->lempresa2.'</td>
        //                 <td align="left">'.$certificate->lfecha2.'</td>
        //                 <td align="left">'.$certificate->lcausa2.'</td>
        //                 <td align="left">'.$certificate->ldiagnostico2.'</td>
        //                 <td align="left">'.$certificate->lfactor2.'</td>
        //                 <td align="left">'.$certificate->lincapacidad2.'</td>
        //             </tr>
        //         </thead>
        //     </table><br/>';

        // $output .= '
        //     <table style="width: 100%;">
        //         <thead>
        //             <tr>
        //                 <th align="center" colspan="7" style="color: #06068F;font-family:\'comic sans ms\';font-size: 18px;">ANTECEDENTES FAMILIARES</th>
        //             </tr>
        //             <tr>
        //                 <th align="left" width="20%">Enfermedad</th>
        //                 <th align="left" width="10%">SI</th>
        //                 <th align="left" width="20%">Parentesco</th>
        //                 <th align="left" width="20%">Enfermedad</th>
        //                 <th align="left" width="10%">SI</th>
        //                 <th align="left" width="20%">Parentesco</th>
        //             </tr>
        //             <tr>
        //                 <td align="left">HTA</td>
        //                 <td align="left">'.($certificate->fenfermedad1 ? 'X' : '').'</td>
        //                 <td align="left">'.$certificate->fparentesco1.'</td>
        //                 <td align="left">ACV</td>
        //                 <td align="left">'.($certificate->fenfermedad2 ? 'X' : '').'</td>
        //                 <td align="left">'.$certificate->fparentesco2.'</td>
        //             </tr>
        //             <tr>
        //                 <td align="left">Diabetis</td>
        //                 <td align="left">'.($certificate->fenfermedad3 ? 'X' : '').'</td>
        //                 <td align="left">'.$certificate->fparentesco3.'</td>
        //                 <td align="left">Cancer</td>
        //                 <td align="left">'.($certificate->fenfermedad4 ? 'X' : '').'</td>
        //                 <td align="left">'.$certificate->fparentesco4.'</td>
        //             </tr>
        //             <tr>
        //                 <td align="left">Coronaria</td>
        //                 <td align="left">'.($certificate->fenfermedad5 ? 'X' : '').'</td>
        //                 <td align="left">'.$certificate->fparentesco5.'</td>
        //                 <td align="left">Artritis</td>
        //                 <td align="left">'.($certificate->fenfermedad6 ? 'X' : '').'</td>
        //                 <td align="left">'.$certificate->fparentesco6.'</td>
        //             </tr>
        //             <tr>
        //                 <td align="left">Alergias</td>
        //                 <td align="left">'.($certificate->fenfermedad7 ? 'X' : '').'</td>
        //                 <td align="left">'.$certificate->fparentesco7.'</td>
        //                 <td align="left">Otra</td>
        //                 <td align="left">'.($certificate->fenfermedad8 ? 'X' : '').'</td>
        //                 <td align="left">'.$certificate->fparentesco8.'</td>
        //             </tr>
        //         </thead>
        //     </table><br/>';

        $output .= '
            <table style="width: 100%;font-size: 13px;">
                <thead>
                    <tr>
                        <td align="left">YO '.utf8_decode(ucwords(strtolower($customer->nombre))).utf8_decode(' identificado con cédula de ciudadania ').$customer->cedula.'</td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3">Declaro que no he omitido ni alterado la informacion aportada por mi,
                            la cual es veraz y se ajusta a mi condicion actual y real de la salud al ingreso de la empresa.
                        </td>
                    </tr>
                </thead>
            </table>';

        $output .= '
            <table style="width: 100%;font-size: 13px;" border="0">
                <tr>
                    <td align="center" rowspan="2" style="width: 40%;">
                        <img src="'.$firma.'" width="100" height="auto">
                    </td>
                    <td align="left" style="width: 40%;">&nbsp;</td>
                    <td align="left" rowspan="3" style="width: 20%;">
                        <span class="span_huella">&nbsp;</span>
                    </td>
                </tr>
                <tr>
                    <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table style="width: 100%;">
                            <tr>
                                <td align="left">
                                    <span class="span_firma">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">'.(Auth::user()->firma ? 'Dr. '.utf8_decode(ucwords(strtolower(Auth::user()->nombre))) : '&nbsp;').'</td>
                            </tr>
                            <tr>
                                <td align="left">'.(Auth::user()->firma ? utf8_decode('Cédula: ').Auth::user()->cedula.' Registro: '.Auth::user()->registro : '&nbsp;').'</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table style="width: 100%;">
                            <tr>
                                <td align="left">
                                    <span class="span_firma">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">Paciente: '.utf8_decode(ucwords(strtolower($customer->nombre))).'</td>
                            </tr>
                            <tr>
                                <td align="left">'.utf8_decode('Cédula: ').$customer->cedula.'</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>';
        return $output;
    }
}