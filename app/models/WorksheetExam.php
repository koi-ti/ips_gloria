<?php

class WorksheetExam extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'examen';

	public $errors;

    protected $perPage = 6;

    public $timestamps = false;

    protected $fillable = ['nombre', 'valor'];

    public function isValid($data)
    {
        $rules = array(
            'nombre' => 'required|string|max:200',
            'valor' => 'required|min:1|regex:[^[0-9]*$]'
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
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('worksheetexam'))->first();
    }

	public static function getData()
    {
        $query = WorksheetExam::query();     
        if (Input::has("nombre")) {          
            $query->where('examen.nombre', 'like', '%'.Input::get("nombre").'%');
        }   
        $query->orderby('examen.nombre', 'ACS');
        return $query->paginate();
    }

    public function setNombreAttribute($name){
        $this->attributes['nombre'] = strtoupper($name);
    }
}