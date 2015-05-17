<?php

class Role extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rol';

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

	public static function getData()
    {
        $query = Role::query();     
     	if (Input::has("nombre")) {          
            $query->where('rol.nombre', 'like', '%'.Input::get("nombre").'%');
        }   
        $query->orderby('rol.nombre', 'ASC');
        return $query->paginate();
    }

    public function setNombreAttribute($name){
		$this->attributes['nombre'] = strtoupper($name);
	}
}