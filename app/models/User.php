<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuario';

	protected $perPage = 6;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $fillable = ['email', 'nombre', 'password', 'perfil', 'activo', 'rol', 'cedula', 'firma', 'registro'];

	public $errors;

	public $states = ['0' => 'Inactivo', '1' => 'Activo'];

	public function isValid($data)
    {
        $rules = array(            
            'email'     => 'required|email|unique:usuario',
            'cedula'     => 'unique:usuario',
            'nombre' => 'required|min:4|max:40',
            'rol' => 'required',
            'password'  => 'min:8|confirmed',
        );
        
        if ($this->exists){
            $rules['email'] .= ',email,' . $this->id;
            $rules['cedula'] .= ',cedula,' . $this->id;
        }else{
            $rules['password'] .= '|required';
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
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule('user'))->first();
    }
    
    public function validAndSave($data)
    {
        if ($this->isValid($data))
        {
            $this->fill($data);

            // Medico
            if(Input::has('medico')) {
                $this->medico = true; 
            }else{
                $this->medico = false;                
            }
            
            $this->save();            
            return true;
        }        
        return false;
    }

    public function setNombreAttribute($name){
		$this->attributes['nombre'] = strtoupper($name);
	}

    public function setPasswordAttribute($pass){
    	if (!empty($pass)){
            $this->attributes['password'] = Hash::make($pass);
        }		
	}
}
