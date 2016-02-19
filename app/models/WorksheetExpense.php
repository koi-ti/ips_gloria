<?php

class WorksheetExpense extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'gasto';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    protected $fillable = ['nombre', 'fecha', 'valor'];

    public function isValid($data)
    {
        $rules = array(
            'nombre' => 'required|string|max:200',
	        'fecha' => 'required|date_format:Y-m-d',
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
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('worksheetexpense'))->first();
    }

	public static function getData()
    {
        $query = WorksheetExpense::query();     
        if (Input::has("nombre")) {          
            $query->where('gasto.nombre', 'like', '%'.Input::get("nombre").'%');
        }
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