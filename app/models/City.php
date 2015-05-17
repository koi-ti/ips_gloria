<?php

class City extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ciudad';

	public static function getData()
    {
        $query = City::query();    
        // $query->select('orden.id as orden_id', 'cliente.nombre as cliente_nombre', 'tecnico.nombre as tecnico_nombre', 'cliente_direccion.nombre as cliente_direccion_nombre'); 
        // $query->join('cliente', 'orden.cliente', '=', 'cliente.id');
        // $query->join('cliente_direccion', 'orden.cliente_direccion', '=', 'cliente_direccion.id');
        // $query->join('tecnico', 'orden.tecnico', '=', 'tecnico.id');
        // if (Input::has("cliente_direccion")) {
        //     $query->where('cliente_direccion.id', Input::get("cliente_direccion"));
        // }
        // if (Input::has("cliente_nit")) {         
        //     $query->where('cliente.nit', Input::get("cliente_nit")); 
        // }  
        $query->orderby('ciudad.nombre', 'ASC');
        return $query->paginate();
    }
}