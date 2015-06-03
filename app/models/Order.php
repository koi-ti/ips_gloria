<?php

class Order extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orden';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    protected $fillable = array('cliente', 'cliente_direccion', 'tecnico', 'factura', 'dano', 'llamo');

    public static $key_cart_visits = 'key_cart_order_visits';

    public static $template_cart_visits = 'core.orders.visits';

    public static $layer_cart_visits = 'orders-list-visits';

    public function isValid($data)
    {
        $rules = array(            
            'cliente' => 'required|numeric',
            'cliente_direccion' => 'required',
            'tecnico' => 'required',
            'factura' => 'required',
            'llamo' => 'required',
            'dano' => 'required'
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
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('order'))->first();
    }

    public static function getData()
    {
        $query = Order::query();    
        $query->select('orden.id as orden_id', 'cliente.nombre as cliente_nombre', 'orden.cerrada as cerrada', 'tecnico.nombre as tecnico_nombre', 'cliente_direccion.nombre as cliente_direccion_nombre'); 
        $query->join('cliente', 'orden.cliente', '=', 'cliente.id');
        $query->join('cliente_direccion', 'orden.cliente_direccion', '=', 'cliente_direccion.id');
        $query->join('tecnico', 'orden.tecnico', '=', 'tecnico.id');
        if (Input::has("cliente_direccion")) {
            $query->where('cliente_direccion.id', Input::get("cliente_direccion"));
        }
        if (Input::has("cliente_nit")) {         
            $query->where('cliente.nit', Input::get("cliente_nit")); 
        } 
        if (Input::has("cliente_nombre")) {          
            $query->where('cliente.nombre', 'like', '%'.Input::get("cliente_nombre").'%');
        }  
        $query->orderby('orden.id', 'DESC');
        return $query->paginate();
    }
}