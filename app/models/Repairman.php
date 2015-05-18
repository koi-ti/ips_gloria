<?php

class Repairman extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tecnico';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    protected $fillable = array('cedula', 'nombre', 'direccion', 'ciudad', 'telefono', 'email');

    public function isValid($data)
    {
        $rules = array(            
            'cedula' => 'required|min:5|max:15|regex:[^[0-9]*$]|unique:tecnico',
            'nombre' => 'required|string|max:50',
            'direccion' => 'required|string|max:100',
            'ciudad' => 'required',
            'email' => 'email' 
        );
        
        if ($this->exists){
            $rules['cedula'] .= ',cedula,' . $this->id;
        }else{
            $rules['cedula'] .= '|required';
        }

        $validator = Validator::make($data, $rules);        
        if ($validator->passes()) {
            return true;
        }        
        $this->errors = $validator->errors();        
        return false;
    }

	public static function getData()
    {
        $query = Repairman::query();     
        if (Input::has("cedula")) {          
            $query->where('tecnico.cedula', Input::get("cedula"));
        }
        if (Input::has("nombre")) {          
            $query->where('tecnico.nombre', 'like', '%'.Input::get("nombre").'%');
        }   
        $query->orderby('tecnico.nombre', 'ASC');
        return $query->paginate();
    }

    public function setNombreAttribute($name){
		$this->attributes['nombre'] = strtoupper($name);
	}
}