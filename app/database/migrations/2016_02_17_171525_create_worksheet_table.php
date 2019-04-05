<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksheetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planilla',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');  
            $table->integer('cliente')->unsigned();
            $table->integer('servicio')->unsigned();
     		$table->date('fecha');
     		$table->time('hora');
            $table->integer('porcentaje')->nullable();              
            $table->double('valor')->nullable();
            $table->double('descuento')->nullable();
            $table->boolean('factura')->default(false);
     		$table->time('hora_atencion');

        	$table->foreign('cliente')->references('id')->on('cliente')->onDelete('restrict');        	      
        	$table->foreign('servicio')->references('id')->on('servicio')->onDelete('restrict');        	      
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('planilla');
	}

}
