<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDirectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente_direccion',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('cliente')->unsigned();
            $table->boolean('activo');
            $table->string('nombre',100);   
            $table->string('persona',100);
            $table->string('direccion',100);
            $table->integer('ciudad')->unsigned();  
            $table->string('telefono',50)->nullable();
            $table->string('email',50)->nullable();
            $table->integer('cupos')->nullable();
            $table->integer('disponibles')->nullable();
            $table->text('horarios')->nullable();
            $table->text('tarifas')->nullable();
            $table->double('latitud')->nullable();
            $table->double('logintud')->nullable();

        	$table->foreign('ciudad')->references('codigo')->on('ciudad')->onDelete('restrict');        	           	
        	$table->foreign('cliente')->references('id')->on('cliente')->onDelete('restrict');        	           	
        });		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cliente_direccion');
	}

}
