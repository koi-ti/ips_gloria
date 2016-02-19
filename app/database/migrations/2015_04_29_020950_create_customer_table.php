<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('cedula',15)->unique();  
            $table->string('nombre');   
            $table->text('imagen');   

            $table->date('fecha_nacimiento')->nullable();
            $table->string('lugar_nacimiento',100);
            $table->string('nacionalidad');
            $table->string('sexo',1);
            $table->integer('estrato');  
            $table->string('estadocivil',2);

            $table->string('direccion');
            $table->string('telefono',50)->nullable();
            $table->integer('ciudad')->unsigned();  

            $table->string('escolaridad');
            $table->string('profesion');
            $table->string('oficio');

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
		Schema::drop('cliente');
	}

}