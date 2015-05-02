<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairmanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tecnico',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('cedula',15)->unique();  
            $table->string('nombre',100);   
            $table->integer('ciudad');  
            $table->string('direccion',100);
            $table->string('telefono',50);
            $table->string('email',50);

        	$table->foreign('ciudad')->references('codigo')->on('ciudad')->onDelete('restrict');        	           	
        });	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tecnico');
	}

}
