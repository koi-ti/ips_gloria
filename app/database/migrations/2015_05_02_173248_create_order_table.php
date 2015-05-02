<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orden',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('numero')->unique();  
            $table->integer('cliente')->unsigned();              
			$table->integer('cliente_direccion')->unsigned();
            $table->integer('tecnico')->unsigned();  
            $table->string('llamo',100);
            $table->text('dano');
            $table->boolean('factura');
            $table->integer('usuario_elaboro')->unsigned();
            $table->datetime('fecha_elaboro');
            $table->boolean('cerrada');
            $table->integer('usuario_cierra')->unsigned();
            $table->datetime('fecha_cierra');

        	$table->foreign('cliente')->references('id')->on('cliente')->onDelete('restrict');        	      
        	$table->foreign('cliente_direccion')->references('id')->on('cliente_direccion')->onDelete('restrict');        	           	
        	$table->foreign('tecnico')->references('id')->on('tecnico')->onDelete('restrict');        	           	
        	$table->foreign('usuario_elaboro')->references('id')->on('usuario')->onDelete('restrict');        	           	
        	$table->foreign('usuario_cierra')->references('id')->on('usuario')->onDelete('restrict');  
        });	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orden');
	}

}
