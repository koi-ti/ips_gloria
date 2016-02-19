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

    protected $fillable = ['cliente', 'servicio', 'fecha', 'valor'];

    public function isValid($data)
    {
        $rules = array(
            'cliente' => 'required|numeric',
            'fecha' => 'required|date_format:Y-m-d',    
            'servicio' => 'required|numeric',
            'valor' => 'required|min:1|regex:[^[0-9]*$]'
      	);
        
        $validator = Validator::make($data, $rules);        
        if ($validator->passes()) {
            return true;
        }        
        $this->errors = $validator->errors();        
        return false;
    }

    public static function getPermission()
    {
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('worksheet'))->first();
    }

    public static function getData($date)
    {
        $query = Worksheet::query();  
        $query->select('planilla.id', 'planilla.hora', 'planilla.valor', DB::raw('cliente.nombre as cliente'), DB::raw('servicio.nombre as servicio'), DB::raw('examen.nombre as examen'));
        $query->join('cliente', 'planilla.cliente', '=', 'cliente.id');
        $query->join('servicio', 'planilla.servicio', '=', 'servicio.id');
        $query->leftJoin('examen', 'planilla.examen', '=', 'examen.id');
     
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