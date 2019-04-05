<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gasto',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');  
            $table->string('nombre',255);
            $table->integer('servicio')->unsigned()->nullable();
     		$table->date('fecha');
            $table->double('valor')->default(0);

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
		Schema::drop('gasto');
	}

}
