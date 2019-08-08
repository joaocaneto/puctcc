<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutoFornecedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produto_fornecedor', function(Blueprint $table)
		{
			$table->smallInteger('p_idProduto')->index('fk_p_f_produto_idx');
			$table->smallInteger('f_idFornecedor')->index('fk_p_f_fornecedor_idx');
			$table->primary(['p_idProduto','f_idFornecedor']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produto_fornecedor');
	}

}
