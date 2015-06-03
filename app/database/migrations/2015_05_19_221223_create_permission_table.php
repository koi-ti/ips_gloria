<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permiso',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('rol')->unsigned();
            $table->integer('modulo')->unsigned();
            $table->boolean('consulta')->default(false);
            $table->boolean('adiciona')->default(false);
            $table->boolean('modifica')->default(false);
            $table->boolean('borra')->default(false);
            $table->boolean('otrouno')->default(false);
            $table->boolean('otrodos')->default(false);

        	$table->foreign('rol')->references('id')->on('rol')->onDelete('restrict');        	      
        	$table->foreign('modulo')->references('id')->on('modulo')->onDelete('restrict');        	      
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permiso');
	}

}
