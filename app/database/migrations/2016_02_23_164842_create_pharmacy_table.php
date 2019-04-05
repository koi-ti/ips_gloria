<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmacyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('farmacia',function($table){
			$table->engine = 'InnoDB';
            $table->increments('id');  
            $table->string('nombre',200);
            $table->double('valor')->default(0);	        
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('farmacia');
	}

}
