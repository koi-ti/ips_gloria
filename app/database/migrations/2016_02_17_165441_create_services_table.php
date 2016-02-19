<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servicio',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');  
            $table->string('nombre',200);
            $table->integer('porcentaje')->nullable();   
	        $table->float('valor')->nullable();
	        $table->float('descuento')->nullable();
            $table->boolean('examen')->default(false);
        });	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('servicio');
	}

}
