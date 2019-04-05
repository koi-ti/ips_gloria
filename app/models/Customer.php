<?php

class Customer extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cliente';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    protected $fillable = ['cedula', 'nombre', 'fecha_nacimiento', 'lugar_nacimiento', 'nacionalidad', 'sexo', 'estrato', 'estadocivil', 'direccion', 
        'ciudad', 'telefono', 'escolaridad', 'profesion', 'oficio'];

    public static $sex = ['' => 'Seleccione', 'M' => 'Masculino', 'F' => 'Femenino'];

    public static $maritalstatus = ['' => 'Seleccione', 'S' => 'Soltero', 'C' => 'Casado', 'D' => 'Divorciado', 'V' => 'Viudo', 'U' => 'Union libre'];
    
    public static $estrato = ['' => 'Seleccione', '1' => 'Estrato 1', '2' => 'Estrato 2', '3' => 'Estrato 3', '4' => 'Estrato 4', '5' => 'Estrato 5', '6' => 'Estrato 6'];

    public function isValid($data)
    {
        $rules = array(            
            'cedula' => 'required|min:5|max:15|regex:[^[0-9]*$]|unique:cliente',
            'nombre' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date_format:Y-m-d',
            'lugar_nacimiento' => 'required|string|max:200',
            'sexo' => 'required',
            'estrato' => 'required',
            'estadocivil' => 'required',
            'direccion' => 'required|string|max:100',
            'ciudad' => 'required',
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
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('customer'))->first();
    }
    
	public static function getData()
    {
        $query = Customer::query(); 
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

    public static function getAge($date) 
    {
        $from = new DateTime($date);
        $to   = new DateTime('today');

        $interval = $from->diff($to);
        return $interval->format('%y años, %m meses y %d días');
    }
}