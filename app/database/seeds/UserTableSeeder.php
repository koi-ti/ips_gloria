<?php

/**
* Agregamos un usuario nuevo a la base de datos.
*/
class UserTableSeeder extends Seeder {
    public function run(){
        User::create(array(
            'email'    => 'dropecamargo@gmail.com',
            'nombre'   => 'Pedro Camargo',
            'password' => 'admin', 
			'activo' => True
        ));
    }
}