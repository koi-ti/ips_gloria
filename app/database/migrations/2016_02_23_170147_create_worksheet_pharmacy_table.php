<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksheetPharmacyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{			
		Schema::create('planilla_farmacia',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('planilla')->unsigned();
            $table->integer('farmacia')->unsigned();
            $table->integer('unidades')->default(0);
	        $table->double('valor')->default(0);

        	$table->foreign('planilla')->references('id')->on('planilla')->onDelete('restrict');        	           	
        	$table->foreign('farmacia')->references('id')->on('farmacia')->onDelete('restrict'); 

            $table->unique(['planilla', 'farmacia']);	           	
       	});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('planilla_farmacia');
	}

}
