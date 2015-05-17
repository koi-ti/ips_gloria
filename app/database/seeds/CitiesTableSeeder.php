<?php

/**
* Agregamos ciudad a la base de datos.
*/
class CitiesTableSeeder extends Seeder {
    public function run(){
        City::create(array('nombre' => 'BOGOTA'));
        City::create(array('nombre' => 'MEDELLIN'));
    }
}