<?php

class City extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ciudad';

    protected $primaryKey = 'codigo';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    protected $fillable = array('nombre');

    public function isValid($data)
    {
        $rules = array(            
            'nombre' => 'required|string|max:50'
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
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('city'))->first();
    }
    
	public static function getData()
    {
        $query = City::query();     
         if (Input::has("nombre")) {          
            $query->where('ciudad.nombre', 'like', '%'.Input::get("nombre").'%');
        }   
        $query->orderby('ciudad.nombre', 'ASC');
        return $query->paginate();
    }

    public function setNombreAttribute($name){
		$this->attributes['nombre'] = strtoupper($name);
	}
}