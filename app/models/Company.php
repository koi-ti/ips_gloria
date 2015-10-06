<?php

class Company extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'empresa';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    protected $fillable = ['nit', 'nombre', 'activo'];

	public static $states = array('' => 'Seleccione', '0' => 'Inactivo', '1' => 'Activo');

    public function isValid($data)
    {
        $rules = array(
        	'nit' => 'required|min:5|max:15|regex:[^[0-9]*$]|unique:empresa',
            'nombre' => 'required|string|max:200',
	        'activo' => 'required',
        );
        
        if ($this->exists){
            $rules['nit'] .= ',nit,' . $this->id;
        }else{
            $rules['nit'] .= '|required';
        }

        $validator = Validator::make($data, $rules);        
        if ($validator->passes()) {
            return true;
        }        
        $this->errors = $validator->errors();        
        return false;
    }

    public static function getPermission()
    {
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('company'))->first();
    }

	public static function getData()
    {
        $query = Company::query();     
        if (Input::has("nit")) {          
            $query->where('empresa.nit', Input::get("nit"));
        }
        if (Input::has("nombre")) {          
            $query->where('empresa.nombre', 'like', '%'.Input::get("nombre").'%');
        }   
        $query->orderby('empresa.nombre', 'ACS');
        return $query->paginate();
    }

    public function setNombreAttribute($name){
        $this->attributes['nombre'] = strtoupper($name);
    }
}