<?php

/**
* Agregamos permisos a la base de datos.
*/
class PermissionTableSeeder extends Seeder {
    public function run(){
       	Permission::create([
       		'rol' => 1,
       		'modulo' => 1,
       		'consulta' => true,
       		'adiciona' => true,
       		'modifica' => true,
       		'borra' => true,
       		'otrouno' => true,
       		'otrodos' => true
       	]);

       	Permission::create([
       		'rol' => 1,
       		'modulo' => 2,
       		'consulta' => true,
       		'adiciona' => true,
       		'modifica' => true,
       		'borra' => true,
       		'otrouno' => true,
       		'otrodos' => true
       	]);

       	Permission::create([
       		'rol' => 1,
       		'modulo' => 3,
       		'consulta' => true,
       		'adiciona' => true,
       		'modifica' => true,
       		'borra' => true,
       		'otrouno' => true,
       		'otrodos' => true
       	]);

       	Permission::create([
       		'rol' => 1,
       		'modulo' => 4,
       		'consulta' => true,
       		'adiciona' => true,
       		'modifica' => true,
       		'borra' => true,
       		'otrouno' => true,
       		'otrodos' => true
       	]);

              Permission::create([
                     'rol' => 1,
                     'modulo' => 5,
                     'consulta' => true,
                     'adiciona' => true,
                     'modifica' => true,
                     'borra' => true,
                     'otrouno' => true,
                     'otrodos' => true
              ]);

              Permission::create([
                     'rol' => 1,
                     'modulo' => 6,
                     'consulta' => true,
                     'adiciona' => true,
                     'modifica' => true,
                     'borra' => true,
                     'otrouno' => true,
                     'otrodos' => true
              ]);

              Permission::create([
                     'rol' => 1,
                     'modulo' => 7,
                     'consulta' => true,
                     'adiciona' => true,
                     'modifica' => true,
                     'borra' => true,
                     'otrouno' => true,
                     'otrodos' => true
              ]);
    }
}