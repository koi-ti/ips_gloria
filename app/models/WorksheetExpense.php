<?php

class WorksheetExpense extends BaseModel {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'gasto';

	public $errors;

    protected $perPage = 10;

    public $timestamps = false;

    protected $fillable = ['nombre', 'servicio', 'valor'];
    
    protected $nullable = ['servicio'];

    public function isValid($data)
    {
        $rules = array(
            'nombre' => 'required|string|max:200',
            'servicio' => 'numeric',
            'valor' => 'required|min:1|regex:/^\d*(\.\d{2})?$/',
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
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('worksheetexpense'))->first();
    }

	public static function getData($date)
    {
        $query = WorksheetExpense::query(); 
        $query->select('gasto.id', 'gasto.valor', DB::raw('gasto.nombre as gasto'), DB::raw('servicio.nombre as servicio'));
 
        $query->leftJoin('servicio', 'gasto.servicio', '=', 'servicio.id');
        $query->where('gasto.fecha', '=', $date);
        $query->orderby('gasto.id', 'DESC');
        return $query->paginate();
    }

    public static function getDataDaily()
    {
        $query = WorksheetExpense::query();  
        $query->select(DB::raw('DISTINCT(fecha) as fecha'));

        if (Input::has("fecha")) {          
            $query->where('gasto.fecha', '=', Input::get("fecha"));
        } 
        $query->orderby('gasto.fecha', 'DESC');
        return $query->paginate();
    }

    public function setNombreAttribute($name){
        $this->attributes['nombre'] = strtoupper($name);
    }
}