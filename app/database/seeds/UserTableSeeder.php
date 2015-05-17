<?php

/**
* Agregamos un usuario nuevo a la base de datos.
*/
class UserTableSeeder extends Seeder {
    public function run(){
        User::create(array(
            'email'    => 'admin@koi-ti.com',
            'nombre'   => 'Administrador',
            'password' => '1280almas', 
            'rol'    => 1,
			'activo' => True
        ));
    }
}