<?php

class WorksheetService extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'servicio';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    protected $fillable = ['nombre', 'porcentaje', 'valor', 'descuento'];

    public function isValid($data)
    {
        $rules = array(
            'nombre' => 'required|string|max:200',
	        'porcentaje' => 'required|numeric|min:1|max:100',
            'valor' => 'required|min:1|regex:[^[0-9]*$]',
            'descuento' => 'required|min:1|regex:[^[0-9]*$]'        
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
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('worksheetservice'))->first();
    }

	public static function getData()
    {
        $query = WorksheetService::query();     
        if (Input::has("nombre")) {          
            $query->where('servicio.nombre', 'like', '%'.Input::get("nombre").'%');
        }   
        $query->orderby('servicio.nombre', 'ACS');
        return $query->paginate();
    }

    public function setNombreAttribute($name){
        $this->attributes['nombre'] = strtoupper($name);
    }
}