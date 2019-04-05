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
		    case 'customer': return 4;
		    case 'company': return 5;
		    case 'certificate': return 6;
		    case 'reportacumulate': return 7;
		    case 'worksheetcustomer': return 8;
		    case 'worksheetservice': return 9;
		    case 'worksheetexam': return 10;
		    case 'worksheetexpense': return 11;
		    case 'worksheet': return 12;
		    case 'worksheetpharmacy': return 13;
		    case 'worksheetreportdaily': return 14;
		    case 'worksheetreportpharmacy': return 15;
		    case 'worksheetreportexams': return 16;
			default: return 'Not state identified';
		endswitch;
    }
}