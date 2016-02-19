<?php

class WorksheetCustomer extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cliente';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    protected $fillable = ['cedula', 'nombre', 'fecha_nacimiento', 'direccion', 'telefono'];

    public function isValid($data)
    {
        $rules = array(            
            'cedula' => 'required|min:5|max:15|regex:[^[0-9]*$]|unique:cliente',
            'nombre' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date_format:Y-m-d',
            'direccion' => 'required|string|max:100',
            'telefono' => 'required' 
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

    public static function getPermission()
    {
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('worksheetcustomer'))->first();
    }
    
	public static function getData()
    {
        $query = WorksheetCustomer::query(); 
        if (Input::has("cedula")) {          
            $query->where('cliente.cedula', Input::get("cedula"));
        }
        if (Input::has("nombre")) {          
            $query->where('cliente.nombre', 'like', '%'.Input::get("nombre").'%');
        }   
        $query->orderby('cliente.nombre', 'ASC');
        return $query->paginate();
    }

    public function setNombreAttribute($name){
		$this->attributes['nombre'] = strtoupper($name);
	}
}