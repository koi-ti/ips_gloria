<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificado',function($table){
		$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('cliente')->unsigned();              
            $table->integer('empresa')->unsigned();  
 		$table->date('fecha');

            $table->string('oempresa1');
            $table->string('oempresa2');
            $table->string('oempresa3');
            $table->string('oae1');
            $table->string('oae2');
            $table->string('oae3');
            $table->string('otiempo1');
            $table->string('otiempo2');
            $table->string('otiempo3');
            $table->string('ocargo1');
            $table->string('ocargo2');
            $table->string('ocargo3');
            $table->string('ofactor1')->nullable();
            $table->string('ofactor2')->nullable(); 
            $table->string('ofactor3')->nullable(); 
            $table->string('otipo1');
            $table->string('otipo2');
            $table->string('otipo3');
            $table->string('oepp1');
            $table->string('oepp2');
            $table->string('oepp3');

            $table->string('lempresa1');
            $table->string('lempresa2');
            $table->string('lfecha1');
            $table->string('lfecha2');
            $table->string('lcausa1');
            $table->string('lcausa2');
            $table->string('ldiagnostico1');
            $table->string('ldiagnostico2');
            $table->string('lfactor1');
            $table->string('lfactor2');
            $table->string('lincapacidad1');
            $table->string('lincapacidad2');

            $table->boolean('fenfermedad1')->default(false);
            $table->boolean('fenfermedad2')->default(false);
            $table->boolean('fenfermedad3')->default(false);
            $table->boolean('fenfermedad4')->default(false);
            $table->boolean('fenfermedad5')->default(false);
            $table->boolean('fenfermedad6')->default(false);
            $table->boolean('fenfermedad7')->default(false);
            $table->boolean('fenfermedad8')->default(false);
            $table->string('fparentesco1');
            $table->string('fparentesco2');
            $table->string('fparentesco3');
            $table->string('fparentesco4');
            $table->string('fparentesco5');
            $table->string('fparentesco6');
            $table->string('fparentesco7');
            $table->string('fparentesco8');

            $table->boolean('penfermedad1')->default(false);
            $table->boolean('penfermedad2')->default(false);
            $table->boolean('penfermedad3')->default(false);
            $table->boolean('penfermedad4')->default(false);
            $table->boolean('penfermedad5')->default(false);
            $table->boolean('penfermedad6')->default(false);
            $table->boolean('penfermedad7')->default(false);
            $table->boolean('penfermedad8')->default(false);
            $table->boolean('penfermedad9')->default(false);
            $table->boolean('penfermedad10')->default(false);
            $table->boolean('penfermedad11')->default(false);
            $table->boolean('penfermedad12')->default(false);
            $table->boolean('penfermedad13')->default(false);
            $table->boolean('penfermedad14')->default(false);
            $table->boolean('penfermedad15')->default(false);
            $table->date('pfecha1');
            $table->date('pfecha2');
            $table->date('pfecha3');
            $table->date('pfecha4');
            $table->date('pfecha5');
            $table->date('pfecha6');
            $table->date('pfecha7');
            $table->date('pfecha8');
            $table->date('pfecha9');
            $table->date('pfecha10');
            $table->date('pfecha11');
            $table->date('pfecha12');
            $table->date('pfecha13');
            $table->date('pfecha14');
            $table->date('pfecha15');
            $table->string('ptratamiento1');
            $table->string('ptratamiento2');
            $table->string('ptratamiento3');
            $table->string('ptratamiento4');
            $table->string('ptratamiento5');
            $table->string('ptratamiento6');
            $table->string('ptratamiento7');
            $table->string('ptratamiento8');
            $table->string('ptratamiento9');
            $table->string('ptratamiento10');
            $table->string('ptratamiento11');
            $table->string('ptratamiento12');
            $table->string('ptratamiento13');
            $table->string('ptratamiento14');
            $table->string('ptratamiento15');

            $table->string('grupo',5);
            $table->string('rh',5);

            $table->string('peso',30);
            $table->string('estatura',30);
            $table->string('imc',30);
            $table->string('lateridad',2);
            $table->string('ta',30);
            $table->string('hipertension',2);
            $table->string('fc',30);
            $table->string('fr',30);
            $table->string('t',30);

            $table->boolean('n1')->default(false);
            $table->boolean('n2')->default(false);
            $table->boolean('n3')->default(false);
            $table->boolean('n4')->default(false);
            $table->boolean('n5')->default(false);
            $table->boolean('n6')->default(false);
            $table->boolean('n7')->default(false);
            $table->boolean('n8')->default(false);
            $table->boolean('n9')->default(false);
            $table->boolean('n10')->default(false);
            $table->boolean('n11')->default(false);
            $table->boolean('n12')->default(false);
            $table->boolean('n13')->default(false);
            $table->boolean('n14')->default(false);
            $table->boolean('a1')->default(false);
            $table->boolean('a2')->default(false);
            $table->boolean('a3')->default(false);
            $table->boolean('a4')->default(false);
            $table->boolean('a5')->default(false);
            $table->boolean('a6')->default(false);
            $table->boolean('a7')->default(false);
            $table->boolean('a8')->default(false);
            $table->boolean('a9')->default(false);
            $table->boolean('a10')->default(false);
            $table->boolean('a11')->default(false);
            $table->boolean('a12')->default(false);
            $table->boolean('a13')->default(false);
            $table->boolean('a14')->default(false);
            $table->string('hallazgo1');
            $table->string('hallazgo2');
            $table->string('hallazgo3');
            $table->string('hallazgo4');
            $table->string('hallazgo5');
            $table->string('hallazgo6');
            $table->string('hallazgo7');
            $table->string('hallazgo8');
            $table->string('hallazgo9');
            $table->string('hallazgo10');
            $table->string('hallazgo11');
            $table->string('hallazgo12');
            $table->string('hallazgo13');
            $table->string('hallazgo14');
            $table->string('hallazgo15');
    
            $table->boolean('si1')->default(false);
            $table->boolean('si2')->default(false);
            $table->boolean('si3')->default(false);
            $table->boolean('si4')->default(false);
            $table->boolean('si5')->default(false);
            $table->boolean('si6')->default(false);
            $table->boolean('si7')->default(false);
            $table->boolean('no1')->default(false);
            $table->boolean('no2')->default(false);
            $table->boolean('no3')->default(false);
            $table->boolean('no4')->default(false);
            $table->boolean('no5')->default(false);
            $table->boolean('no6')->default(false);
            $table->boolean('no7')->default(false);
            $table->string('observacion1');
            $table->string('observacion2');
            $table->string('observacion3');
            $table->string('observacion4');
            $table->string('observacion5');
            $table->string('observacion6');
            $table->string('observacion7');

            $table->boolean('apto1')->default(false);
            $table->boolean('apto2')->default(false);
            $table->boolean('apto3')->default(false);
            $table->boolean('apto4')->default(false);
            $table->boolean('apto5')->default(false);
            $table->boolean('examen1')->default(false);
            $table->boolean('examen2')->default(false);
            $table->boolean('examen3')->default(false);
            $table->boolean('aplazado')->default(false);
            $table->string('razon');

            $table->string('diagnostica1');
            $table->string('diagnostica2');
            $table->string('diagnostica3');

            $table->boolean('limitacion1')->default(false);
            $table->boolean('limitacion2')->default(false);
            $table->boolean('limitacion3')->default(false);
            $table->boolean('limitacion4')->default(false);
            $table->boolean('limitacion5')->default(false);
            $table->boolean('limitacion6')->default(false);
            $table->boolean('limitacion7')->default(false);
            $table->boolean('limitacion8')->default(false);
            $table->boolean('limitacion9')->default(false);
            $table->boolean('limitacion10')->default(false);
            $table->boolean('limitacion11')->default(false);
            $table->boolean('limitacion12')->default(false);
            $table->boolean('limitacion13')->default(false);
            $table->string('embarazo',2);

        	$table->foreign('cliente')->references('id')->on('cliente')->onDelete('restrict');        	      
        	$table->foreign('empresa')->references('id')->on('empresa')->onDelete('restrict');   

            $table->unique(['cliente', 'empresa', 'fecha']);	           	
        });	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('certificado');
	}

}
