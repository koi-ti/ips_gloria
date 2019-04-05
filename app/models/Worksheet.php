<?php

class Worksheet extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'planilla';

	public $errors;

    protected $perPage = 10;
    
    public $timestamps = false;

    public static $key_cart_exams = 'key_cart_worksheet_exams';

    public static $template_cart_exams = 'core/worksheet/worksheets/exams';

    public static $key_cart_pharmacies = 'key_cart_worksheet_pharmacies';

    public static $template_cart_pharmacies = 'core/worksheet/worksheets/pharmacies';
    
    protected $fillable = ['cliente', 'servicio', 'fecha', 'valor'];

    public function isValid($data)
    {
        $rules = array(
            'cliente' => 'required|numeric',
            'fecha' => 'required|date_format:Y-m-d',    
            'servicio' => 'required|numeric',
            'valor' => 'required|min:1|regex:/^\d*(\.\d{2})?$/',
      	);
        
        $validator = Validator::make($data, $rules);        
        if ($validator->passes()) {
            return true;
        }        
        $this->errors = $validator->errors();        
        return false;
    }

    public function isValidExams()
    {
        $exams = Session::get(Worksheet::$key_cart_exams);   
        if(isset($exams) && is_array($exams) && $exams >0) {
            $arExis = [];
            foreach ($exams as $exam) {                         
                $exam = (object) $exam;

                if( in_array($exam->examen, $arExis) ) {
                    return "No pueden existir exámenes duplicados, por favor verificar item $exam->examen_nombre.";

                }
                $arExis[] = $exam->examen;
            }
            return 'OK';
        }
        return "Por favor ingrese exámenes asociados al servicio.";
    }

    public function isValidPharmacies()
    {
        $pharmacies = Session::get(Worksheet::$key_cart_pharmacies);   
        if(isset($pharmacies) && is_array($pharmacies) && $pharmacies >0) {
            $arExis = [];
            foreach ($pharmacies as $pharmacy) {                            
                $pharmacy = (object) $pharmacy;

                if( in_array($pharmacy->farmacia, $arExis) ) {
                    return "No pueden existir items de farmacia duplicados, por favor verificar item $pharmacy->farmacia_nombre.";
                }
                $arExis[] = $pharmacy->farmacia;
            }
            return 'OK';
        }
        return "Por favor ingrese items de farmacia asociados al servicio.";
    }
    
    public static function getPermission()
    {
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('worksheet'))->first();
    }

    public static function getData($date)
    {
        $query = Worksheet::query();  
        $query->select('planilla.id', 'planilla.fecha', 'planilla.hora', 'planilla.valor', DB::raw('cliente.nombre as cliente'), DB::raw('servicio.nombre as servicio'));
        $query->join('cliente', 'planilla.cliente', '=', 'cliente.id');
        $query->join('servicio', 'planilla.servicio', '=', 'servicio.id');
     
        $query->where('planilla.fecha', '=', $date);
        $query->orderby('planilla.hora', 'DESC');
        return $query->paginate();
    }

    public static function getDataDaily()
    {
        $query = Worksheet::query();  
        $query->select(DB::raw('DISTINCT(fecha) as fecha'));

        if (Input::has("fecha")) {          
            $query->where('planilla.fecha', '=', Input::get("fecha"));
        } 
        $query->orderby('planilla.fecha', 'DESC');
        return $query->paginate();
    }
}