<?php

class CustomerAddress extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cliente_direccion';

    public $timestamps = false;

	public static $states = array('0' => 'Inactivo', '1' => 'Activo');
}