<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visita',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('orden')->unsigned();  
            $table->integer('tecnico')->unsigned();  
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_final');
            $table->text('observaciones');
            $table->text('pendientes');
            $table->boolean('finorden');
            $table->integer('usuario_elaboro')->unsigned();
            $table->datetime('fecha_elaboro');

        	$table->foreign('orden')->references('id')->on('orden')->onDelete('restrict');        	           	
        	$table->foreign('tecnico')->references('id')->on('tecnico')->onDelete('restrict');   
        	$table->foreign('usuario_elaboro')->references('id')->on('usuario')->onDelete('restrict');       	
        });	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('visita');
	}

}
