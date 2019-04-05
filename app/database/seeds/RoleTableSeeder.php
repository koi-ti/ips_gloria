<?php

/**
* Agregamos ciudad a la base de datos.
*/
class RoleTableSeeder extends Seeder {
    public function run(){
       	Role::create(array('nombre' => 'ADMINISTRADOR'));
    }
}