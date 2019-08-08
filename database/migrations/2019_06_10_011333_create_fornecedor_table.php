<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFornecedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fornecedor', function(Blueprint $table)
		{
			$table->smallInteger('idFornecedor', true);
			$table->string('nomeFornecedor', 100);
			$table->string('descFornecedor', 200);
			$table->char('situacao', 1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fornecedor');
	}

}
