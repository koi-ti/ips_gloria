<?php

class WorksheetPharmacy extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'farmacia';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    protected $fillable = ['nombre', 'valor'];

    public function isValid($data)
    {
        $rules = array(
            'nombre' => 'required|string|max:200',
            'valor' => 'required|min:1|regex:/^\d*(\.\d{2})?$/',
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
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('worksheetpharmacy'))->first();
    }

	public static function getData()
    {
        $query = WorksheetPharmacy::query();     
        if (Input::has("nombre")) {          
            $query->where('farmacia.nombre', 'like', '%'.Input::get("nombre").'%');
        }   
        $query->orderby('farmacia.nombre', 'ACS');
        return $query->paginate();
    }

    public function setNombreAttribute($name){
        $this->attributes['nombre'] = strtoupper($name);
    }
}