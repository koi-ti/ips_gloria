<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksheetExamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planilla_examen',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('planilla')->unsigned();
            $table->integer('examen')->unsigned();
	        $table->double('valor')->default(0);

        	$table->foreign('planilla')->references('id')->on('planilla')->onDelete('restrict');        	           	
        	$table->foreign('examen')->references('id')->on('examen')->onDelete('restrict'); 

            $table->unique(['planilla', 'examen']);	           	
       	});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('planilla_examen');
	}

}
