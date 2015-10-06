<?php

/**
* Agregamos modulos a la base de datos.
*/
class ModuleTableSeeder extends Seeder {
    public function run(){
       	Module::create([
       		'nombre' => 'Usuarios',
       		'nivel1' =>  1
       	]);

       	Module::create([
       		'nombre' => 'Roles',
       		'nivel1' =>  2
       	]);

        Module::create([
          'nombre' => 'Ciudades',
          'nivel1' =>  3
        ]);

       	Module::create([
       		'nombre' => 'Pacientes',
       		'nivel1' =>  4
       	]);

        Module::create([
          'nombre' => 'Empresas',
          'nivel1' =>  5
        ]);

       	Module::create([
       		'nombre' => 'Certificados',
       		'nivel1' =>  6
       	]);

        Module::create([
          'nombre' => 'Reporte Acumulados',
          'nivel1' =>  7
        ]);
    }
}