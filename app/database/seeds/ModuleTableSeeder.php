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
       		'nombre' => 'Tecnicos',
       		'nivel1' =>  4
       	]);

       	Module::create([
       		'nombre' => 'Clientes',
       		'nivel1' =>  5
       	]);

       	Module::create([
       		'nombre' => 'Orden de servicio',
       		'nivel1' =>  6
       	]);

            Module::create([
                  'nombre' => 'Reporte Ordenes',
                  'nivel1' =>  7
            ]);

            Module::create([
                  'nombre' => 'Reporte Ordenes abiertas',
                  'nivel1' =>  8
            ]);

            Module::create([
                  'nombre' => 'Reporte Ordenes abiertas sin visitas',
                  'nivel1' =>  9
            ]);
    }
}