<?php

class Module extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'modulo';

    public $timestamps = false;

    public static function getModule($module) {
    	switch ($module) :
		    case 'user': return 1;
		    case 'role': return 2;
		    case 'city': return 3;
		    case 'repairman': return 4;
		    case 'customer': return 5;
		    case 'order': return 6;
		    case 'reportorder': return 7;
		    case 'reportopenorder': return 8;
		    case 'reportoutvisit': return 9;
			default: return 'Not state identified';
		endswitch;
    }
}