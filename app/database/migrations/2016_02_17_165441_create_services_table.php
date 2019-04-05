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
            $table->integer('porcentaje')->default(0);   
	        $table->double('valor')->default(0);
	        $table->double('descuento')->default(0);
            $table->boolean('examen')->default(false);
            $table->boolean('farmacia')->default(false);
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
