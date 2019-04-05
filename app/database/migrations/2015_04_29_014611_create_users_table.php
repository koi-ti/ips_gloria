<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre',100);
            $table->integer('rol')->unsigned();  
            $table->string('email',100)->unique();
            $table->string('password');
            $table->string("remember_token")->nullable();            
            $table->boolean('activo');
            $table->boolean('medico');
        	$table->string('registro');
            $table->string('cedula',15)->nullable();  
            $table->boolean('firma');
            $table->timestamps();

        	$table->foreign('rol')->references('id')->on('rol')->onDelete('restrict');        	           	
        });	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario');
	}

}
