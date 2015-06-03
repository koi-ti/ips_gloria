<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Visit extends Eloquent {
	
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'visita';

	public $timestamps = false;
}