<?php

class Customer extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cliente';

	public $errors;

    protected $perPage = 1;

    public $timestamps = false;

    protected $fillable = array('nit', 'nombre', 'direccion', 'ciudad', 'telefono', 'email');

    public static $key_cart_address = 'key_cart_customer_address';

    public static $template_cart_address = 'core.customers.address';

    public static $layer_cart_address = 'customer-list-address';

    public function isValid($data)
    {
        $rules = array(            
            'nit' => 'required|min:5|max:15|regex:[^[0-9]*$]|unique:cliente',
            'nombre' => 'required|string|max:50',
            'direccion' => 'required|string|max:100',
            'ciudad' => 'required',
            'email' => 'email' 
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

	public static function getData()
    {
        $query = Customer::query();     
        if (Input::has("nit")) {          
            $query->where('cliente.nit', Input::get("nit"));
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