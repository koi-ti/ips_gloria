<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modulo',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre',100);  
            $table->integer('nivel1')->default(0);
            $table->integer('nivel2')->default(0);
            $table->integer('nivel3')->default(0);
            $table->integer('nivel4')->default(0);
            $table->integer('nivel5')->default(0);
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('modulo');
	}

}
